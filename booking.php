<?php
// Andmebaasi ühenduse seaded
$servername = "localhost";
$username = "root"; // Muuda oma kasutajanime
$password = ""; // Muuda oma parooli
$dbname = "auto_hooldus";

// Loome ühenduse
$conn = new mysqli($servername, $username, $password, $dbname);

// Kontrollime ühendust
if ($conn->connect_error) {
    die("Ühenduse loomine ebaõnnestus: " . $conn->connect_error);
}

// Kontrollime, kas vorm on saadetud
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $service = $_POST['service'];

    // Sisestame broneeringu andmebaasi
    $sql = "INSERT INTO bookings (username, email, date, time, service) VALUES ('$username', '$email', '$date', '$time', '$service')";

    if ($conn->query($sql) === TRUE) {
        echo "Broneering edukalt salvestatud!";
    } else {
        echo "Viga broneeringu salvestamisel: " . $conn->error;
    }
}

// Sulgeme ühenduse
$conn->close();
?>
