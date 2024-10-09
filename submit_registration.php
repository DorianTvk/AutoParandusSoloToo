<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Andmebaasi ühendus
$servername = "localhost"; // või teie serveri IP
$username = "DorianAdmin";
$password = "onnelikudautod";
$dbname = "autohooldus";

// Looge ühendus
$conn = new mysqli($servername, $username, $password, $dbname);

// Kontrollige ühendust
if ($conn->connect_error) {
    die("Ühenduse loomine ebaõnnestus: " . $conn->connect_error);
}

// Kontrollige, kas andmed on edastatud
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $pnumber = $conn->real_escape_string($_POST['pnumber']);
    $vehicleType = $conn->real_escape_string($_POST['vehicleType']);
    $service = $conn->real_escape_string($_POST['service']);
    $price = $conn->real_escape_string($_POST['price']);
    $date = $conn->real_escape_string($_POST['date']);
    $time = $conn->real_escape_string($_POST['time']);

    // SQL päring andmete sisestamiseks
    $sql = "INSERT INTO registrations (name, email, pnumber, vehicleType, service, price, date, time) VALUES ('$name', '$email', '$pnumber', '$vehicleType', '$service', '$price', '$date', '$time')";

    if ($conn->query($sql) === TRUE) {
        echo "Uus rekord on lisatud!";
    } else {
        echo "Viga: " . $sql . "<br>" . $conn->error;
    }
}

// Sulge ühendus
$conn->close();
?>
