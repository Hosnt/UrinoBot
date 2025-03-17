<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $sex = $_POST['sex'];
    $age = $_POST['age'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $query = "INSERT INTO users (fullname, sex, age, contact, email, password) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssisss", $fullname, $sex, $age, $contact, $email, $password);
    
    if ($stmt->execute()) {
        echo "<script>
            alert('User created successfully! Welcome, $fullname!');
            window.location.href = 'dashboard.php';
        </script>";
    } else {
        echo "<script>
            alert('Error: Could not create user.');
            window.location.href = 'signup.html';
        </script>";
    }
}
?>
