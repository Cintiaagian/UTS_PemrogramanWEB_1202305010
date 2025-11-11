<?php
include('koneksi.php');
include('session.php');

// Cek apakah pengguna sudah login
if (!isLoggedIn()) {
    header('Location: login.php');
    exit();
}

// SIMULASI: Ambil data dari session (tanpa database)
$pendudukMenikah = [];
$pendudukBelumMenikah = [];

if (isset($_SESSION['data_penduduk'])) {
    foreach ($_SESSION['data_penduduk'] as $index => $penduduk) {
        if ($penduduk['status_pernikahan'] == 'Menikah') {
            $pendudukMenikah[] = $penduduk + ['id' => $index]; // tambah id sebagai index array
        } elseif ($penduduk['status_pernikahan'] == 'Belum Menikah') {
            $pendudukBelumMenikah[] = $penduduk + ['id' => $index];
        }
    }
}

/* KODE ASLI (DIKOMENTARI):
// Query untuk mengambil penduduk yang sudah menikah
$pendudukMenikahQuery = "SELECT * FROM penduduk WHERE status_pernikahan = 'Menikah'";
$pendudukMenikahResult = $conn->query($pendudukMenikahQuery);

// Query untuk mengambil penduduk yang belum menikah
$pendudukBelumMenikahQuery = "SELECT * FROM penduduk WHERE status_pernikahan = 'Belum Menikah'";
$pendudukBelumMenikahResult = $conn->query($pendudukBelumMenikahQuery);
*/
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Penduduk Desa</title>
    <link rel="stylesheet" href="style.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .links {
            margin-top: 20px;
            text-align: center;
        }
        .links a {
            color: #007bff;
            text-decoration: none;
            margin: 0 10px;
        }
        .links a:hover {
            text-decoration: underline;
        }
        h3 {
            color: #333;
            margin-top: 30px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Data Penduduk Desa</h1>

        <!-- Tabel Penduduk yang Menikah -->
        <h3>Penduduk yang Menikah</h3>
        <?php if (count($pendudukMenikah) > 0): ?>
        <table id="tabelMenikah">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Umur</th>
                    <th>Jenis Kelamin</th>
                    <th>Alamat</th>
                    <th>Status Pernikahan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pendudukMenikah as $row): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['nama']); ?></td>
                        <td><?php echo htmlspecialchars($row['umur']); ?></td>
                        <td><?php echo htmlspecialchars($row['jenis_kelamin']); ?></td>
                        <td><?php echo htmlspecialchars($row['alamat']); ?></td>
                        <td><?php echo htmlspecialchars($row['status_pernikahan']); ?></td>
                        <td>
                            <a href='edit_penduduk.php?id=<?php echo $row['id']; ?>'>Edit</a> | 
                            <a href='delete.php?id=<?php echo $row['id']; ?>' onclick="return confirm('Yakin hapus data?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php else: ?>
            <p style="text-align: center; color: #666;">Tidak ada data penduduk yang menikah.</p>
        <?php endif; ?>

        <!-- Tabel Penduduk yang Belum Menikah -->
        <h3>Penduduk yang Belum Menikah</h3>
        <?php if (count($pendudukBelumMenikah) > 0): ?>
        <table id="tabelBelumMenikah">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Umur</th>
                    <th>Jenis Kelamin</th>
                    <th>Alamat</th>
                    <th>Status Pernikahan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pendudukBelumMenikah as $row): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['nama']); ?></td>
                        <td><?php echo htmlspecialchars($row['umur']); ?></td>
                        <td><?php echo htmlspecialchars($row['jenis_kelamin']); ?></td>
                        <td><?php echo htmlspecialchars($row['alamat']); ?></td>
                        <td><?php echo htmlspecialchars($row['status_pernikahan']); ?></td>
                        <td>
                            <a href='edit_penduduk.php?id=<?php echo $row['id']; ?>'>Edit</a> | 
                            <a href='delete.php?id=<?php echo $row['id']; ?>' onclick="return confirm('Yakin hapus data?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php else: ?>
            <p style="text-align: center; color: #666;">Tidak ada data penduduk yang belum menikah.</p>
        <?php endif; ?>

        <div class="links">
            <a href="index.php">Kembali ke Halaman Utama</a> | 
            <a href="logout.php">Logout</a>
        </div>
        
        <div style="text-align: center; margin-top: 20px; color: #666; font-size: 12px;">
            <p><strong>Mode Testing:</strong> Data diambil dari session</p>
        </div>
    </div>
</body>
</html>