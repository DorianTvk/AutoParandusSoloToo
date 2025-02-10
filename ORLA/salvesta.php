<?php
$servername = "localhost";
$username = "root";
$password = "12345";
$dbname = "salong";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Ühenduse ebaõnnestumine: " . $conn->connect_error);
}

$service_name = $_POST['service_name'];
$service_description = $_POST['service_description'];
$service_price = $_POST['service_price'];

$sql = "INSERT INTO services (name, description, price) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssd", $service_name, $service_description, $service_price);

if ($stmt->execute()) {
    echo "<script>
        alert('Teenus edukalt lisatud!');
        window.location.href = 'admin_page.php';
    </script>";
} else {
    echo "<script>
        alert('Teenuse lisamine ebaõnnestus. Proovi uuesti.');
        window.location.href = 'add_service.php';
    </script>";
}

$stmt->close();
$conn->close();
?>
