<?php

$servername = "d125330_olra";
$username = "d125330_admin";
$password = "DoraAdmin123";
$dbname = "OLRA";

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

    $stmt = $conn->prepare("INSERT INTO bookings (username, email, date, time, service) VALUES (?, ?, ?, ?, ?)");
    
    $stmt->bind_param("sssss", $username, $email, $date, $time, $service);

    if ($stmt->execute()) {
        echo "Broneering edukalt salvestatud!";
    } else {
        echo "Viga broneeringu salvestamisel: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
