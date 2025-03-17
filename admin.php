<?php
error_reporting(E_ALL); ini_set('display_errors', 1);
if (session_status() === PHP_SESSION_NONE) session_start();
include 'db.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) exit("<script>alert('You must log in first.'); window.location.href='login.php';</script>");
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT fullname, role, created_at, last_login FROM users WHERE id = ?");
$stmt->bind_param('i', $user_id); 
$stmt->execute(); 
$result = $stmt->get_result();
if ($result->num_rows > 0) { 
    $user = $result->fetch_assoc(); 
    $_SESSION = array_merge($_SESSION, $user); 
} else exit("<script>alert('User  not found. Please sign up.'); window.location.href='signup.php';</script>");

// Check if the user is an admin
if ($_SESSION['role'] !== 'admin') exit("<script>alert('Access denied! Admins only.'); window.location.href='login.php';</script>");

// Handle lock/unlock functionality
if (isset($_POST['toggle_lock'])) {
    $_SESSION['site_locked'] = !isset($_SESSION['site_locked']) || !$_SESSION['site_locked'];
    $message = $_SESSION['site_locked'] ? "Website is now locked." : "Website is now unlocked.";
    echo "<script>alert('$message'); window.location.href='admin.php';</script>";
}

// Handle user deletion
if (isset($_POST['delete_user'])) { 
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?"); 
    $stmt->bind_param('i', $_POST['delete_id']);
    echo $stmt->execute() ? "<script>alert('User  deleted successfully.'); window.location.href='admin.php';</script>" : "<script>alert('Error deleting user.');</script>";
}

// Handle user addition
if (isset($_POST['add_user'])) { 
    $stmt = $conn->prepare("INSERT INTO users (fullname, sex, contact, email, password, role, created_at, last_login) VALUES (?, ?, ?, ?, ?, ?, NOW(), NULL)");
    $stmt->bind_param('ssssss', $_POST['fullname'], $_POST['sex'], $_POST['contact'], $_POST['email'], password_hash($_POST['password'], PASSWORD_DEFAULT), $_POST['role']);
    echo $stmt->execute() ? "<script>alert('User  added successfully.'); window.location.href='admin.php';</script>" : "<script>alert('Error adding user.');</script>";
}

$users = $conn->query("SELECT id, fullname, sex, contact, email, role, created_at, last_login FROM users");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f8f9fa; margin: 0; padding: 0; }
        .container { width: 90%; max-width: 1200px; margin: 30px auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        h2 { text-align: center; color: #007bff; font-weight: bold; }
        .card { padding: 15px; border-radius: 8px; background: #fff; margin-bottom: 15px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: center; }
        th { background: #007bff; color: #fff; }
        .btn { display: inline-block; padding: 8px 12px; border: none; border-radius: 4px; text-decoration: none; color: white; cursor: pointer; text-align: center; }
        .btn-primary { background-color: #007bff; }
        .btn-danger { background-color: #dc3545; }
        .btn-sm { padding: 5px 10px; font-size: 14px; }
        .input-group { display: flex; gap: 10px; flex-wrap: wrap; }
        .input-group input, .input-group select { padding: 8px; border: 1px solid #ccc; border-radius: 4px; width: 100%; max-width: 200px; }
    </style>
</head>
<body>
<div class="container">
    <h2>Admin Dashboard</h2>
    <div class="card">
        <h4>Welcome, <?= htmlspecialchars($_SESSION['fullname']) ?></h4>
        <p><strong>Created At:</strong> <?= htmlspecialchars($_SESSION['created_at']) ?></p>
        <p><strong>Last Login:</strong> <?= htmlspecialchars($_SESSION['last_login']) ?></p>
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
    <div class="card">
        <h4>Add User</h4>
        <form method="POST" class="input-group">
            <input type="text" name="fullname" placeholder="Full Name" required>
            <select name="sex" required><option>Male</option><option>Female</option></select>
            <input type="text" name="contact" placeholder="Contact" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <select name="role" required><option>user</option><option>admin</option></select>
            <button type="submit" name="add_user" class="btn btn-primary">Add User</button>
        </form>
    </div>

    <!-- Lock/Unlock Section -->
    <div class="card">
        <h4>Lock/Unlock Website</h4>
        <form method="POST">
            <button type="submit" name="toggle_lock" class="btn btn-danger">
                <?= isset($_SESSION['site_locked']) && $_SESSION['site_locked'] ? 'Unlock Website' : 'Lock Website' ?>
            </button>
        </form>
    </div>

    <h4>All Users</h4>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Sex</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Role</th>
                <th>Created At</th>
                <th>Last Login</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $users->fetch_assoc()) { ?>
            <tr>
                <td><?= htmlspecialchars($row['id']) ?></td>
                <td><?= htmlspecialchars($row['fullname']) ?></td>
                <td><?= htmlspecialchars($row['sex']) ?></td>
                <td><?= htmlspecialchars($row['contact']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><?= htmlspecialchars($row['role']) ?></td>
                <td><?= htmlspecialchars($row['created_at']) ?></td>
                <td><?= htmlspecialchars($row['last_login']) ?></td>
                <td>
                    <form method="POST" onsubmit="return confirm('Are you sure?');">
                        <input type="hidden" name="delete_id" value="<?= $row['id'] ?>">
                        <button type="submit" name="delete_user" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            <?php } ?>
        </tbody>
 </table>
    </div>
</div>
</body>
</html>