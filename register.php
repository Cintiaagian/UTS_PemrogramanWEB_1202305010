<?php
include('koneksi.php');

// Proses pendaftaran
if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk menyimpan pengguna baru
    $query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

    if ($conn->query($query) === TRUE) {
        echo "Akun berhasil dibuat! <a href='login.php'>Login sekarang</a>";
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="register-container">
        <h1>Daftar Akun</h1>

        <form method="POST" action="register.php">
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="text" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit" name="register">Daftar</button>
        </form>

        <div class="links">
        <p>Sudah punya akun? <a href="login.php">Login di sini</a>.</p>
        </div>
    </div>
</body>
</html>
