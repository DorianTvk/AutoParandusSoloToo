<?php
session_start();


$servername = "localhost";
$username = "root";
$password = "12345";
$dbname = "user_form";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Ühenduse ebaõnnestumine: " . $conn->connect_error);
}

if (isset($_POST['update_user'])) {
    $user_id = intval($_POST['user_id']);
    $new_name = mysqli_real_escape_string($conn, $_POST['name']);
    $new_role = $_POST['user_type'];

    $update_sql = "UPDATE user_form SET name = ?, user_type = ? WHERE id = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("ssi", $new_name, $new_role, $user_id);

    if ($stmt->execute()) {
        echo "<script>
            alert('Kasutaja andmete uuendamine õnnestus.');
            window.location.href = 'admin_manage_users.php';
        </script>";
    } else {
        echo "<script>
            alert('Kasutaja andmete uuendamine ebaõnnestus.');
            window.location.href = 'admin_manage_users.php';
        </script>";
    }
}

if (isset($_GET['delete_user'])) {
    $user_id = intval($_GET['delete_user']);
    $delete_sql = "DELETE FROM user_form WHERE id = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $user_id);

    if ($stmt->execute()) {
        echo "<script>
            alert('Kasutaja kustutamine õnnestus.');
            window.location.href = 'admin_manage_users.php';
        </script>";
    } else {
        echo "<script>
            alert('Kasutaja kustutamine ebaõnnestus.');
            window.location.href = 'admin_manage_users.php';
        </script>";
    }
}

$sql = "SELECT id, name, email, user_type FROM user_form";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasutajate Haldamine</title>
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
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        h1 {
            text-align: center;
            color: #aa4ff3;
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
        }

        .edit-btn {
            background-color: #4caf50;
            color: white;
        }

        .delete-btn {
            background-color: #ff4d4d;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Kasutajate Haldamine</h1>
        <a href="admin_page.php" class="btn">Tagasi</a>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nimi</th>
                    <th>Email</th>
                    <th>Roll</th>
                    <th>-</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>" . htmlspecialchars($row['id']) . "</td>
                            <td>
                                <form action='' method='post' style='display:inline;'>
                                    <input type='hidden' name='user_id' value='" . htmlspecialchars($row['id']) . "'>
                                    <input type='text' name='name' value='" . htmlspecialchars($row['name']) . "' required>
                            </td>
                            <td>" . htmlspecialchars($row['email']) . "</td>
                            <td>
                                    <select name='user_type'>
                                        <option value='admin' " . ($row['user_type'] === 'admin' ? 'selected' : '') . ">Admin</option>
                                        <option value='user' " . ($row['user_type'] === 'user' ? 'selected' : '') . ">Kasutaja</option>
                                    </select>
                            </td>
                            <td>
                                    <button type='submit' name='update_user' class='action-btn edit-btn'>Uuenda</button>
                                    <a href='?delete_user=" . htmlspecialchars($row['id']) . "' class='action-btn delete-btn'>Kustuta</a>
                                </form>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Ühtegi kasutajat ei leitud.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<?php
$conn->close();
?>
