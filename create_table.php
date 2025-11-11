<?php
include('koneksi.php');

// SQL untuk membuat tabel users
$sql = "CREATE TABLE users (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Tabel users berhasil dibuat!";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>