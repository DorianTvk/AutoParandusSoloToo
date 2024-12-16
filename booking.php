<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "auto_hooldus";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Ühenduse loomine ebaõnnestus: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $service = $_POST['service'];


    $sql = "INSERT INTO bookings (username, email, date, time, service) VALUES ('$username', '$email', '$date', '$time', '$service')";

    if ($conn->query($sql) === TRUE) {
        echo "Broneering edukalt salvestatud!";
    } else {
        echo "Viga broneeringu salvestamisel: " . $conn->error;
    }
}


$conn->close();
?>
