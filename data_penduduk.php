<?php
// Menangani penghapusan data penduduk
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $sql = "DELETE FROM penduduk WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Data penduduk berhasil dihapus!";
        header('Location: index.php'); // Redirect kembali ke halaman utama setelah penghapusan
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
