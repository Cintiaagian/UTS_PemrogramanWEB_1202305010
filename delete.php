<?php
include('koneksi.php');
include('session.php');

// Cek apakah pengguna sudah login
if (!isLoggedIn()) {
    header('Location: login.php');
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk menghapus data penduduk berdasarkan ID
    $sql = "DELETE FROM penduduk WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Data penduduk berhasil dihapus!";
        header('Location: tabel_penduduk.php');
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>