<?php
session_start();
require 'koneksi.php';
require 'Auth.php';

$auth = new Auth($conn);

if ($auth->checkToken()) {
  header("Location: index.php");
  exit();
}

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($auth->registerUser($email, $username, $password)) {
        header("Location: index.php");
        exit();
    } else {
        $message = "<p>Registrasi gagal. Pastikan semua field terisi dan email belum terdaftar.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rayhan Ahmad | Register</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="login_styles.css">
</head>
<body>

<div class="login-container">
  <div class="login-form">
    <h2>Buat Akun Baru</h2>
    <form method="POST">
      <div class="input-group">
        <input type="text" id="email" name="email" placeholder="Email" required>
      </div>
      <div class="input-group">
        <input type="text" id="username" name="username" placeholder="Username" required>
      </div>
      <div class="input-group">
        <input type="password" id="password" name="password" placeholder="Password" required>
      </div>
      <div class="input-group">
        <button type="submit">DAFTAR</button>
      </div>
    </form>
    <p class="register">Sudah punya akun? <a href="login.php">Masuk</a></p>
  </div>
</div>

</body>
</html>