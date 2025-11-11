<?php
// Mulai session untuk menghancurkan session
session_start();

// Hapus semua session
session_unset();
session_destroy();

// Arahkan ke halaman login setelah logout
header('Location: login.php');
exit();
?>
