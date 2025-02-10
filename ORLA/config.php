<?php
$servername = "localhost";
$username = "root"; 
$password = "12345"; 
$dbname = "user_form";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Ühenduse ebaõnnestumine: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");

?>
