const express = require('express');
const cors = require('cors');

const app = express();
const PORT = 5000;

app.use(cors());
app.use(express.json());

// Test Route
app.get('/', (req, res) => {
  res.send('Auto hoolduse platvorm töötab!');
});

// Endpoint teenuste saamiseks (andmed oleksid tavaliselt andmebaasis)
app.get('/services', (req, res) => {
  const services = [
    { id: 1, name: 'Õlivahetus', price: 50 },
    { id: 2, name: 'Pidurite kontroll', price: 30 },
    { id: 3, name: 'Rehvide vahetus', price: 60 },
  ];
  res.json(services);
});

app.listen(PORT, () => {
  console.log(`Server töötab portil ${PORT}`);
});
