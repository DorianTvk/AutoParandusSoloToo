CREATE DATABASE broneeringud;

USE broneeringud;

CREATE TABLE broneeringud (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    date DATE NOT NULL
);

CREATE TABLE teenused (
    id INT AUTO_INCREMENT PRIMARY KEY,
    teenus VARCHAR(255) NOT NULL,
    hind DECIMAL(10, 2) NOT NULL
);
