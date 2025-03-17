<?php
session_start();
include 'db.php';

// Check if user is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    echo "<script>alert('Access denied. Admins only.'); window.location.href='index.php';</script>";
    exit();
}

// Check if user ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<script>alert('Invalid request.'); window.location.href='admin.php';</script>";
    exit();
}

$user_id = $_GET['id'];

// Prevent admin from deleting themselves
if ($user_id == $_SESSION['user_id']) {
    echo "<script>alert('You cannot delete your own account.'); window.location.href='admin.php';</script>";
    exit();
}

// Delete user
$stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
if ($stmt->execute()) {
    echo "<script>alert('User deleted successfully.'); window.location.href='admin.php';</script>";
} else {
    echo "<script>alert('Error deleting user.'); window.location.href='admin.php';</script>";
}
?>
