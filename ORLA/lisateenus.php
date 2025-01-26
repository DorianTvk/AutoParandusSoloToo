<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lisa Teenus | Juuksurisalong ORLA </title>
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
            max-width: 600px;
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

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-top: 15px;
            font-size: 1rem;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
        }

        button {
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 1rem;
            background-color: #aa4ff3;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #933ce3;
        }
    </style>
</head>
<body>
    
    <div class="container">
        <h1>Lisa Teenus</h1>
        

        <form action="salvesta.php" method="post">
            <label for="service_name">Teenuse nimi:</label>
            <input type="text" id="service_name" name="service_name" placeholder="Sisesta teenuse nimi" required>

            <label for="service_description">Teenuse kirjeldus:</label>
            <textarea id="service_description" name="service_description" rows="4" placeholder="Sisesta teenuse kirjeldus" required></textarea>

            <label for="service_price">Teenuse hind (€):</label>
            <input type="number" id="service_price" name="service_price" placeholder="Sisesta teenuse hind" step="0.01" min="0" required>

            <button type="submit">Lisa Teenus</button>
        </form>
    </div>
</body>
</html>
