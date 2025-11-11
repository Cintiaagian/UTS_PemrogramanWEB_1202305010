<?php
session_start();

// Fungsi untuk memeriksa apakah pengguna sudah login
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Fungsi untuk mendapatkan informasi pengguna yang sedang login
function getUser() {
    return isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
}

// Fungsi untuk login
function login($user_id) {
    $_SESSION['user_id'] = $user_id;
}

// Fungsi untuk logout
function logout() {
    session_destroy();
    header('Location: login.php');
    exit();
}
?>
