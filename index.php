<?php
include('koneksi.php');
include('session.php');

// Cek apakah pengguna sudah login
if (!isLoggedIn()) {
    header('Location: login.php');
    exit();
}

// Menangani pengiriman form untuk menambah data penduduk
if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $umur = $_POST['umur'];
    $jenisKelamin = $_POST['jenisKelamin'];
    $alamat = $_POST['alamat'];
    $statusPernikahan = $_POST['statusPernikahan'];

    // SIMULASI: Simpan data di session (tanpa database)
    if (!isset($_SESSION['data_penduduk'])) {
        $_SESSION['data_penduduk'] = [];
    }
    
    $new_data = [
        'nama' => $nama,
        'umur' => $umur,
        'jenis_kelamin' => $jenisKelamin,
        'alamat' => $alamat,
        'status_pernikahan' => $statusPernikahan
    ];
    
    $_SESSION['data_penduduk'][] = $new_data;
    
    echo "Data penduduk berhasil ditambahkan!";
    
    /* KODE ASLI (DIKOMENTARI):
    $sql = "INSERT INTO penduduk (nama, umur, jenis_kelamin, alamat, status_pernikahan)
            VALUES ('$nama', '$umur', '$jenisKelamin', '$alamat', '$statusPernikahan')";

    if ($conn->query($sql) === TRUE) {
        echo "Data penduduk berhasil ditambahkan!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    */
}

// SIMULASI: Hitung jumlah penduduk dari session
if (isset($_SESSION['data_penduduk'])) {
    $totalPenduduk = count($_SESSION['data_penduduk']);
    
    $jumlahBelumMenikah = 0;
    $jumlahMenikah = 0;
    
    foreach ($_SESSION['data_penduduk'] as $penduduk) {
        if ($penduduk['status_pernikahan'] == 'Belum Menikah') {
            $jumlahBelumMenikah++;
        } elseif ($penduduk['status_pernikahan'] == 'Menikah') {
            $jumlahMenikah++;
        }
    }
} else {
    $totalPenduduk = 0;
    $jumlahBelumMenikah = 0;
    $jumlahMenikah = 0;
}

/* KODE ASLI (DIKOMENTARI):
// Query untuk mendapatkan jumlah penduduk
$totalPendudukQuery = "SELECT COUNT(*) as total FROM penduduk";
$totalPendudukResult = $conn->query($totalPendudukQuery);
$totalPenduduk = $totalPendudukResult->fetch_assoc()['total'];

// Query untuk mendapatkan jumlah penduduk berdasarkan status pernikahan
$jumlahBelumMenikahQuery = "SELECT COUNT(*) as total_belum FROM penduduk WHERE status_pernikahan = 'Belum Menikah'";
$jumlahBelumMenikahResult = $conn->query($jumlahBelumMenikahQuery);
$jumlahBelumMenikah = $jumlahBelumMenikahResult->fetch_assoc()['total_belum'];

$jumlahMenikahQuery = "SELECT COUNT(*) as total_menikah FROM penduduk WHERE status_pernikahan = 'Menikah'";
$jumlahMenikahResult = $conn->query($jumlahMenikahQuery);
$jumlahMenikah = $jumlahMenikahResult->fetch_assoc()['total_menikah'];
*/
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Penduduk</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <div class="container">

        <h1>Data Penduduk</h1>

        <!-- Container untuk Status Penduduk -->
        <div class="status-container">
            <div class="status-item">
                <h3>Total Jumlah Penduduk</h3>
                <p><?php echo $totalPenduduk; ?> orang</p>
            </div>
            <div class="status-item">
                <h3>Jumlah Belum Menikah</h3>
                <p><?php echo $jumlahBelumMenikah; ?> orang</p>
            </div>
            <div class="status-item">
                <h3>Jumlah Menikah</h3>
                <p><?php echo $jumlahMenikah; ?> orang</p>
            </div>
        </div>

        <!-- Form Input Data Penduduk -->
        <form method="POST" action="index.php">
            <input type="text" name="nama" placeholder="Nama" required><br>
            <input type="number" name="umur" placeholder="Umur" required><br>
            <select name="jenisKelamin" required>
                <option value="" disabled selected>Jenis Kelamin</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select><br>
            <input type="text" name="alamat" placeholder="Alamat" required><br>
            <select name="statusPernikahan" required>
                <option value="" disabled selected>Status Pernikahan</option>
                <option value="Belum Menikah">Belum Menikah</option>
                <option value="Menikah">Menikah</option>
            </select><br>
            <button type="submit" name="submit">Tambah Penduduk</button>
        </form>

        <div class="links">
            <a href="tabel_penduduk.php">Lihat Data Penduduk</a> | 
            <a href="logout.php">Logout</a>
        </div>
        
        <div style="text-align: center; margin-top: 20px; color: #666; font-size: 12px;">
            <p><strong>Mode Testing:</strong> Data disimpan di session (akan hilang setelah logout)</p>
        </div>
    </div>
</body>
</html>