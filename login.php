<?php
// Mulai session untuk menyimpan informasi login
session_start();
include('koneksi.php');

// Cek apakah pengguna sudah login, jika sudah login, arahkan ke halaman utama
if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

// Proses login ketika form disubmit
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validasi input sederhana
    if (empty($username) || empty($password)) {
        $error = "Username dan Password harus diisi!";
    } else {
        // HILANGKAN QUERY DATABASE - langsung login berhasil
        // Simpan data pengguna ke dalam session tanpa cek database
        $_SESSION['user_id'] = 1;
        $_SESSION['username'] = $username;

        // Arahkan ke halaman utama setelah login berhasil
        header('Location: index.php');
        exit();
        
        /* 
        // Kode asli (dikomentari sementara):
        $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header('Location: index.php');
            exit();
        } else {
            $error = "Username atau Password salah!";
        }
        */
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-container small-container">
        <h1>Log in</h1>

        <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>

        <form method="POST" action="login.php">
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit" name="login">Login</button>
        </form>

        <div class="links">
        <p>Belum punya akun? <a href="register.php">Daftar di sini</a>.</p>
        </div>
        
        <div style="text-align: center; margin-top: 20px; color: #666; font-size: 12px;">
            <p><strong>Mode Testing:</strong> Login akan selalu berhasil tanpa cek database</p>
        </div>
    </div>
</body>
</html>