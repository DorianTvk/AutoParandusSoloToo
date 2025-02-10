<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aja Broneerimine | Juuksurisalong OLRA</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header class="header">
        <div class="container">
            <h1 class="logo">Juuksurisalong Elegants</h1>
            <nav class="nav">
                <ul>
                    <li><a href="index.html">Esileht</a></li>
                    <li><a href="teenused.php" class="active">Teenused</a></li>
                    <li><a href="broneerimine.php" class="active">Broneeri Aeg</a></li>                                                                               
                    <li><a href="logout.php" class="btn">Logi Välja</a></li>
                </ul>
            </nav>
            <a href="index.html">Tagasi</a>
        </div>
    </header>

    <main>
    <section class="form-container">
        <form action="booking.php" method="post">
            <h3>Broneeri aeg</h3>
            
            <label for="name">Nimi:</label>
            <input type="text" id="name" name="name" placeholder="Sinu nimi" required>
        
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Sinu email" required>
        
            <label for="teenus">Teenused:</label>
            <select id="teenus" name="teenus" required>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "12345";
                $dbname = "salong";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Ühenduse ebaõnnestumine: " . $conn->connect_error);
                }

                $sql = "SELECT name FROM services";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . htmlspecialchars($row['name']) . "'>" . htmlspecialchars($row['name']) . "</option>";
                    }
                } else {
                    echo "<option disabled>Teenuseid pole saadaval</option>";
                }

                $conn->close();
                ?>
            </select>
        
            <label for="date">Kuupäev:</label>
            <input type="date" id="date" name="date" required>
        
            <label for="time">Aeg:</label>
            <input type="time" id="time" name="time" required>
        
            <label for="additional-info">Lisainfo:</label>
            <textarea id="additional-info" name="additional_info" rows="5" placeholder="Lisa siia oma erisoovid või lisainfo (valikuline)"></textarea>
        
            <button type="submit" class="form-btn">Broneeri</button>
        </form>
    </section>
</main>


    <footer class="footer">
        <p>&copy; 2025 Juuksurisalong OLRA. Kõik õigused kaitstud.</p>
    </footer>
</body>
</html>
