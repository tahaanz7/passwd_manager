CREATE DATABASE Gestion_password;
USE Gestion_password;

CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL
);

CREATE TABLE passwords (
    password_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    titre VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    notes TEXT,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);
