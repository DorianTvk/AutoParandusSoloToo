<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teenused | Juuksurisalong OLRA</title>
    
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
            margin-bottom: 20px;
        }

        .service {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background: #fff;
        }

        .service h2 {
            margin: 0;
            font-size: 1.5rem;
            color: #aa4ff3;
        }

        .service p {
            margin: 10px 0 0;
            font-size: 1rem;
        }

        .service .price {
            margin-top: 10px;
            font-weight: bold;
            color: #555;
        }
    </style>
</head>
<body>
    
    <div class="container">
        <h1>Meie Teenused</h1>
        

        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "salong";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Ühenduse ebaõnnestumine: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM services";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='service'>
                    <h2>" . htmlspecialchars($row['name']) . "</h2>
                    <p>" . htmlspecialchars($row['description']) . "</p>
                    <p class='price'>Hind: " . htmlspecialchars($row['price']) . " €</p>
                </div>";
            }
        } else {
            echo "<p>Ühtegi teenust pole veel lisatud.</p>";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>
