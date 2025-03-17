<?php
session_start();
include 'db.php';
if (isset($_SESSION['site_locked']) && $_SESSION['site_locked']) {
    header('Location: datas.php'); // Redirect to a locked page
    exit();
}

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('No user found. Please sign up.'); window.location.href='signup.php';</script>";
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user data from the database
$query = "SELECT fullname, sex, age, contact, email FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "<script>alert('User not found. Please sign up.'); window.location.href='signup.php';</script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UrinoBot Dashboard</title>
    <link rel="stylesheet" href="style.css"> 
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #E6F7F7;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .dashboard-container {
            width: 95%;
            max-width: 1400px;
            min-height: 800px;
            height: 90vh;
            display: flex;
            flex-direction: row;
            border: 3px solid #58B6C0;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.2);
        }
        .sidebar {
            width: 25%;
            height: 100%;
            background: #D3D3D3;
            padding: 15px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            position: relative;
        }
        .sidebar img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-bottom: 10px;
        }
        .sidebar .info-box {
            width: 100%;
            background: #B0B0B0;
            padding: 12px;
            border-radius: 8px;
            margin-top: 10px;
            text-align: center;
            position: relative;
            font-size: 14px;
        }
        .logout {
            width: 100%;
            background: #E74C3C;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            font-size: 16px;
            margin-top: auto;
            margin-bottom: 10px;
        }
        .content {
            width: 75%;
            height: 100%;
            padding: 20px;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
            position: relative;
            overflow-y: auto;
        }
        .navbar {
            width: 100%;
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 15px;
        }
        .navbar button {
            background: #58B6C0;
            border: none;
            padding: 8px 15px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            color: white;
            font-size: 14px;
        }
        .content h2 {
            font-size: 3.5rem;
            color: #58B6C0;
            margin-top: 0.5px;
            border-bottom: 2px solid #58B6C0;
            padding-bottom: 5px;
        }
        .content h2 span {
            color: #E74C3C;
        }
        .content h1 {
            font-size: 2rem;
            color: #58B6C0;
            margin-top: 0.2px;
            margin-bottom: 20px;
        }
        .content h1 span {
            color: #E74C3C;
            font-weight: bold;
        }
        .button-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
            align-items: center;
            justify-content: center;
            width: 100%;
            max-width: 500px;
        }
        .button-container button {
            width: 100%;
            padding: 20px;
            border: 1px solid black;
            border-radius: 8px;
            cursor: pointer;
            font-size: 18px;
            font-weight: bold;
            background: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        
        /* Added responsive styles */
        @media (max-width: 992px) {
            .dashboard-container {
                flex-direction: column;
                height: auto;
            }
            .sidebar, .content {
                width: 100%;
            }
            .sidebar {
                padding: 10px;
            }
            .content h2 {
                font-size: 2.5rem;
            }
            .content h1 {
                font-size: 1.5rem;
            }
        }
        
        @media (max-width: 576px) {
            .navbar {
                flex-wrap: wrap;
            }
            .navbar button {
                padding: 6px 10px;
                font-size: 12px;
            }
            .button-container button {
                padding: 15px;
                font-size: 16px;
            }
            .content h2 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <div class="sidebar">
            <img src="https://i.ibb.co/zT2zKcj4/avatar-png.png" alt="User Avatar">
            <div class="info-box">
                <p><strong>Patient's Information:</strong></p>
                <p><strong>Full Name:</strong> <?php echo htmlspecialchars($user['fullname'] ?? 'Unknown'); ?></p>
                <p><strong>Sex:</strong> <?php echo htmlspecialchars($user['sex'] ?? 'Unknown'); ?></p>
                <p><strong>Age:</strong> <?php echo htmlspecialchars($user['age'] ?? 'Unknown'); ?></p>
                <p><strong>Contact:</strong> <?php echo htmlspecialchars($user['contact'] ?? 'Unknown'); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email'] ?? 'Unknown'); ?></p>
                <button class="logout" onclick="location.href='logout.php'">Sign Out</button>
            </div>
        </div>
        <div class="content">
            <div class="navbar">
                <button>About</button>
                <button>Functions</button>
                <button>Reliability</button>
                <button>Contacts</button>
            </div>
            <h2>Urino<span>Bot</span></h2>
            <h1>Welcome, <span><?php echo htmlspecialchars($user['fullname']); ?>!</span></h1>
            <div class="button-container">
                <button onclick="location.href='chat.html'">
                    <img src="https://i.ibb.co/PzZTBfkm/chat-icon-png.png" alt="Chat"> Chat with AI Doctor
                </button>
                <button onclick="location.href='urine.php'">
                    <img src="https://i.ibb.co/sJFsQkQW/analyze-icon-png.png" alt="Analyze"> Analyze Urine Sample
                </button>
            </div>
        </div>
    </div>
</body>
</html>