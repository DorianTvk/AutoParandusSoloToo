<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Broneeringud | Juuksurisalong OLRA </title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f3ff;
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 20px;
            background: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        h1 {
            text-align: center;
            color: #aa4ff3;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            text-align: left;
            padding: 10px;
            border: 1px solid #ccc;
        }

        th {
            background-color: #aa4ff3;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f3ff;
        }

        tr:hover {
            background-color: #f1e4ff;
        }

        .action-btn {
            padding: 5px 10px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 0.9rem;
            margin-right: 5px;
        }

        .delete-btn {
            background-color: #ff4d4d;
            color: white;
        }

        .complete-btn {
            background-color: #4caf50;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Broneeringud</h1>
        <a href="admin_page.php" class="btn">Tagasi</a>
        <a href="lisateenus.php" class="btn">Lisa uus teenus</a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nimi</th>
                    <th>Email</th>
                    <th>Teenus</th>
                    <th>Kuupäev</th>
                    <th>Aeg</th>
                    <th>Lisainfo</th>
                    <th>Tegevused</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "salong";

                $conn = new mysqli($servername, $username, $password, $dbname);

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
                    header('Location: broneeringud.php');
                    exit();
                }

                // Kustutamine
                if (isset($_GET['delete'])) {
                    $id = intval($_GET['delete']);
                    $delete_sql = "DELETE FROM bookings WHERE id = ?";
                    $stmt = $conn->prepare($delete_sql);
                    $stmt->bind_param("i", $id);
                    $stmt->execute();
                    header('Location: admin_manage_bookings.php');
                    exit();
                }

                // Kõik broneeringud
                $sql = "SELECT * FROM bookings";
                $result = $conn->query($sql);

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
                            <td>
                                <a href='?complete=" . htmlspecialchars($row['id']) . "' class='action-btn complete-btn'>Täidetud</a>
                                <a href='?delete=" . htmlspecialchars($row['id']) . "' class='action-btn delete-btn'>Kustuta</a>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>Ühtegi broneeringut ei leitud.</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
