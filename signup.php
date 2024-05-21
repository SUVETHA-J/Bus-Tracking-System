<?php
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
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

// Insert data into database
$sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";

if ($conn->query($sql) === TRUE) {
    header("Location: home.html");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
