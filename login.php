<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['fullname'] = $user['fullname'];
            $_SESSION['sex'] = $user['sex'];
            $_SESSION['age'] = $user['age'];
            $_SESSION['contact'] = $user['contact'];
            $_SESSION['email'] = $user['email'];

            echo "<script>
                alert('Welcome, " . $_SESSION['fullname'] . "!');
                window.location.href = 'dashboard.php';
            </script>";
        } else {
            echo "<script>
                alert('Incorrect password. Try again.');
                window.location.href = 'signin.html';
            </script>";
        }
    } else {
        echo "<script>
            alert('No user found! Please create an account.');
            window.location.href = 'signup.html';
        </script>";
    }
}
?>
