<?php
include('koneksi.php');
include('session.php');

// Cek apakah pengguna sudah login
if (!isLoggedIn()) {
    header('Location: login.php');
    exit();
}

// Cek apakah ID penduduk ada di URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk mengambil data penduduk berdasarkan ID
    $query = "SELECT * FROM penduduk WHERE id = $id";
    $result = $conn->query($query);
    $penduduk = $result->fetch_assoc();

    if (!$penduduk) {
        echo "Penduduk tidak ditemukan!";
        exit();
    }

    // Menangani pengiriman form edit data penduduk
    if (isset($_POST['update'])) {
        $nama = $_POST['nama'];
        $umur = $_POST['umur'];
        $jenisKelamin = $_POST['jenisKelamin'];
        $alamat = $_POST['alamat'];
        $statusPernikahan = $_POST['statusPernikahan'];

        // Query untuk memperbarui data penduduk
        $updateQuery = "UPDATE penduduk SET nama = '$nama', umur = '$umur', jenis_kelamin = '$jenisKelamin', alamat = '$alamat', status_pernikahan = '$statusPernikahan' WHERE id = $id";

        if ($conn->query($updateQuery) === TRUE) {
            echo "Data penduduk berhasil diperbarui!";
            header('Location: tabel_penduduk.php');
            exit();
        } else {
            echo "Error: " . $updateQuery . "<br>" . $conn->error;
        }
    }
} else {
    echo "ID penduduk tidak ditemukan!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Penduduk</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Edit Data Penduduk</h1>

        <!-- Form untuk mengedit data penduduk -->
        <form method="POST" action="edit_penduduk.php?id=<?php echo $penduduk['id']; ?>">
            <input type="text" name="nama" value="<?php echo $penduduk['nama']; ?>" required><br>
            <input type="number" name="umur" value="<?php echo $penduduk['umur']; ?>" required><br>
            <select name="jenisKelamin" required>
                <option value="Laki-laki" <?php if ($penduduk['jenis_kelamin'] == 'Laki-laki') echo 'selected'; ?>>Laki-laki</option>
                <option value="Perempuan" <?php if ($penduduk['jenis_kelamin'] == 'Perempuan') echo 'selected'; ?>>Perempuan</option>
            </select><br>
            <input type="text" name="alamat" value="<?php echo $penduduk['alamat']; ?>" required><br>
            <select name="statusPernikahan" required>
                <option value="Belum Menikah" <?php if ($penduduk['status_pernikahan'] == 'Belum Menikah') echo 'selected'; ?>>Belum Menikah</option>
                <option value="Menikah" <?php if ($penduduk['status_pernikahan'] == 'Menikah') echo 'selected'; ?>>Menikah</option>
            </select><br>
            <button type="submit" name="update">Perbarui Data</button>
        </form>

        <div class="links">
            <a href="tabel_penduduk.php">Kembali ke Tabel Penduduk</a>
        </div>
    </div>
</body>
</html>
