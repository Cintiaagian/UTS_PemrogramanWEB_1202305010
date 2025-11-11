<?php
$host = 'localhost'; // Ganti dengan host jika menggunakan server lain
$username = 'root'; // Username MySQL (default pada XAMPP/WAMP)
$password = ''; // Password MySQL (default pada XAMPP/WAMP kosong)
$database = 'UTS_PemrogramanWEB_1202305010'; // Nama database

// Membuat koneksi ke database
$conn = new mysqli($host, $username, $password, $database);

// Mengecek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
