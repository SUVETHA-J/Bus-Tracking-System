<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sign";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Form data
$email = $_POST['email'];
$password = $_POST['password'];

// Check if user exists
$sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    // User authenticated, redirect to dashboard or any other page
    $_SESSION['email'] = $email;
    header("Location: home.html");
} else {
    // Authentication failed, redirect back to login page with error message
    $_SESSION['login_error'] = "Invalid email or password";
    header("Location: login.html");
}

$conn->close();
?>
