<?php
$servername = "localhost";
$username = "root";
$password = "12345";
$dbname = "salong";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Ühenduse ebaõnnestumine: " . $conn->connect_error);
}

$name = $_POST['name'];
$email = $_POST['email'];
$teenus = $_POST['teenus'];
$date = $_POST['date'];
$time = $_POST['time'];
$additional_info = $_POST['additional_info'];

$sql = "INSERT INTO bookings (name, email, teenus, date, time, additional_info) 
        VALUES ('$name', '$email', '$teenus', '$date', '$time', '$additional_info')";

if ($conn->query($sql) === TRUE) {

    echo "<script>
        alert('Broneering edukalt salvestatud! Aitäh!');
        setTimeout(function() {
            window.location.href = 'index.html';
        }, 2000); // Suunamine 3 sekundi pärast
    </script>";
} else {
    echo "Viga: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
