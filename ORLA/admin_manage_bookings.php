<?php
session_start();



// Andmebaasi ühendus
$servername = "localhost";
$username = "root";
$password = "12345";
$dbname = "salong";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kontrollime andmebaasi ühendust
if ($conn->connect_error) {
    die("Ühenduse ebaõnnestumine: " . $conn->connect_error);
}

// Märkimine täidetuks
if (isset($_GET['complete'])) {
    $id = intval($_GET['complete']);
    $update_sql = "UPDATE bookings SET status = 'Täidetud' WHERE id = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header('Location: admin_manage_bookings.php');
    exit();
}

// Kustutamine
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $delete_sql = "DELETE FROM bookings WHERE id = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo "<script>
            alert('Broneering edukalt kustutatud.');
            window.location.href = 'admin_manage_bookings.php';
        </script>";
    } else {
        echo "<script>
            alert('Broneeringu kustutamine ebaõnnestus.');
            window.location.href = 'admin_manage_bookings.php';
        </script>";
    }
    exit();
}

// Kuvame kõik broneeringud
$sql = "SELECT * FROM bookings";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Broneeringute Haldamine</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f9f3ff;
        }
        .container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #aa4ff3;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ccc;
        }
        th {
            background-color: #aa4ff3;
            color: white;
        }
        .action-btn {
            padding: 5px 10px;
            border-radius: 5px;
            text-decoration: none;
            color: white;
            margin-right: 5px;
        }
        .complete-btn {
            background-color: #4caf50;
        }
        .delete-btn {
            background-color: #ff4d4d;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Broneeringute Haldamine</h1>
        <table>
        <a href="admin_page.php" class="btn">Tagasi</a>

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nimi</th>
                    <th>Email</th>
                    <th>Teenus</th>
                    <th>Kuupäev</th>
                    <th>Aeg</th>
                    <th>Lisainfo</th>
                    <th>Staatus</th>
                    <th>Tegevused</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>" . htmlspecialchars($row['id']) . "</td>
                            <td>" . htmlspecialchars($row['name']) . "</td>
                            <td>" . htmlspecialchars($row['email']) . "</td>
                            <td>" . htmlspecialchars($row['teenus']) . "</td>
                            <td>" . htmlspecialchars($row['date']) . "</td>
                            <td>" . htmlspecialchars($row['time']) . "</td>
                            <td>" . htmlspecialchars($row['additional_info']) . "</td>
                            <td>" . htmlspecialchars($row['status']) . "</td>
                            <td>";
                        if ($row['status'] !== 'Täidetud') {
                            echo "<a href='?complete=" . htmlspecialchars($row['id']) . "' class='action-btn complete-btn'>Tehtud</a>";
                        }
                        echo "<a href='?delete=" . htmlspecialchars($row['id']) . "' class='action-btn delete-btn' onclick='return confirm(\"Kas olete kindel, et soovite selle broneeringu kustutada?\");'>Kustuta</a>";
                        echo "</td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='9'>Ühtegi broneeringut ei leitud.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
