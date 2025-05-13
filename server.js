const express = require('express');
const bodyParser = require('body-parser');
const mysql = require('mysql2');

const app = express();
const PORT = 3000;

app.use(bodyParser.urlencoded({ extended: false }));
app.use(express.static(__dirname));

// Create MySQL connection
const db = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: '',
  database: 'sanothimicollege'
});

// Connect to DB
db.connect((err) => {
  if (err) throw err;
  console.log('Connected to MySQL Database');
});

// Route to serve login.html
app.get('/', (req, res) => {
  res.sendFile(__dirname + '/login.html');
});

// Login POST route
app.post('/login', (req, res) => {
  const { email, password } = req.body;

  const query = 'SELECT * FROM users WHERE email = ? AND password = ?';
  db.query(query, [email, password], (err, results) => {
    if (err) throw err;

    if (results.length > 0) {
      res.send(`<h3>Login successful. Welcome, ${results[0].email}!</h3>`);
    } else {
      res.send('<h3>Invalid email or password.</h3>');
    }
  });
});

// Start server
app.listen(PORT, () => {
  console.log(`Server running on http://localhost:${PORT}`);
});
