const express = require('express');
const bodyParser = require('body-parser');
const mysql = require('mysql2');
const path = require('path');

const app = express();
app.use(bodyParser.urlencoded({ extended: true }));

// Ühenda andmebaasiga
const db = mysql.createConnection({
    host: 'localhost',
    user: 'Dorian',
    password: 'Dorian2005',
    database: 'broneeringud'
});

db.connect(err => {
    if (err) {
        console.error('Andmebaasiga ühendamine ebaõnnestus:', err);
    } else {
        console.log('Ühendus andmebaasiga õnnestus');
    }
});

// Serveeri HTML-faili
app.use(express.static(path.join(__dirname, 'public')));

// Vormilt andmete vastuvõtmine ja salvestamine broneeringuteks
app.post('/salvesta-broneering', (req, res) => {
    const { name, email, phone, date } = req.body;

    const sql = `INSERT INTO broneeringud (name, email, phone, date) VALUES (?, ?, ?, ?)`;
    db.query(sql, [name, email, phone, date], (err, result) => {
        if (err) {
            console.error('Andmete salvestamine ebaõnnestus:', err);
            res.send('Andmete salvestamine ebaõnnestus');
        } else {
            res.send('Broneering salvestatud edukalt!');
        }
    });
});

// Admin-leht broneeringute vaatamiseks
app.get('/admin', (req, res) => {
    const sql = `SELECT * FROM broneeringud`;
    db.query(sql, (err, results) => {
        if (err) {
            console.error('Andmete kuvamine ebaõnnestus:', err);
            res.send('Andmete kuvamine ebaõnnestus');
        } else {
            let html = '<h1>Admin paneel</h1><table border="1"><tr><th>ID</th><th>Nimi</th><th>Email</th><th>Telefon</th><th>Kuupäev</th></tr>';
            results.forEach(row => {
                html += `<tr><td>${row.id}</td><td>${row.name}</td><td>${row.email}</td><td>${row.phone}</td><td>${row.date}</td></tr>`;
            });
            html += '</table>';
            html += `<a href="/admin/teenused">Lisa teenus</a>`; // Link teenuse lisamise vormile
            res.send(html);
        }
    });
});

// Admin-leht teenuste vaatamiseks ja lisamiseks
app.get('/admin/teenused', (req, res) => {
    const sql = `SELECT * FROM teenused`;
    db.query(sql, (err, results) => {
        if (err) {
            console.error('Teenuste kuvamine ebaõnnestus:', err);
            res.send('Teenuste kuvamine ebaõnnestus');
        } else {
            let html = '<h1>Teenuste haldamine</h1><table border="1"><tr><th>ID</th><th>Teenuse nimi</th><th>Hind</th></tr>';
            results.forEach(row => {
                html += `<tr><td>${row.id}</td><td>${row.teenus}</td><td>${row.hind}</td></tr>`;
            });
            html += '</table>';
            html += `<h2>Lisa teenus</h2>
                     <form action="/admin/teenused" method="POST">
                         <label for="teenus">Teenuse nimi:</label><br>
                         <input type="text" id="teenus" name="teenus" required><br><br>
                         <label for="hind">Hind:</label><br>
                         <input type="number" id="hind" name="hind" required><br><br>
                         <button type="submit">Lisa teenus</button>
                     </form>`;
            res.send(html);
        }
    });
});

// Teenuse lisamise töötlemine
app.post('/admin/teenused', (req, res) => {
    const { teenus, hind } = req.body;

    const sql = `INSERT INTO teenused (teenus, hind) VALUES (?, ?)`;
    db.query(sql, [teenus, hind], (err, result) => {
        if (err) {
            console.error('Teenuse lisamine ebaõnnestus:', err);
            res.send('Teenuse lisamine ebaõnnestus');
        } else {
            res.redirect('/admin/teenused'); // Pärast teenuse lisamist suuname tagasi teenuste haldamise lehele
        }
    });
});

// Käivita server
app.listen(3000, () => {
    console.log('Server töötab aadressil http://localhost:3000');
});
