<?php
session_start();

include "koneksi.php";
require 'Auth.php';

$auth = new Auth($conn);

if (!$auth->checkToken()) {
  header("Location: login.php");
  exit();
}

if (isset($_POST["judul"]) and isset($_POST["genre"]) and isset($_POST["penulis"]) and isset($_POST["sutradara"])) {
  $judul = $_POST['judul'];
  $genre = $_POST['genre'];
  $penulis = $_POST['penulis'];
  $sutradara = $_POST['sutradara'];
  $query = $conn->prepare("INSERT INTO film (judul, genre, penulis, sutradara) VALUES (:judul, :genre, :penulis, :sutradara)");
  $query->bindParam(':judul', $judul);
  $query->bindParam(':genre', $genre);
  $query->bindParam(':penulis', $penulis);
  $query->bindParam(':sutradara', $sutradara);
  $query->execute();
  $conn = null;
  header('Location: ./index.php');
  exit();
}

$genres = ['Musical', 'Romance', 'Drama', 'Action', 'Horror', 'Thriller', 'Sci-fi'];
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rayhan Ahmad | Manajemen Film</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="styles.css">
</head>

<body>

  <header class="navbar" id="navbar">
    <div class="navbar-content">
      <div class="brand-name">Rayhan</div>
      <nav>
        <ul>
          <li><a href="./index.php">Home</a></li>
          <li><a href="./create.php">Tambah Film</a></li>
          <li><a href="./logout.php">Logout</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <!-- Content of the website -->
  <main class="content">
    <section class="container">
      <h2>Tambah Film</h2>
      <p>Rayhan Ahmad Rizalullah - 121140002</p>
      <p>UAS Pemrograman Web Kelas RA</p>
      <form method="POST" id="filmForm">
        <input type="hidden" name="action" value="create">
        <div class="row">
          <label for="judul">Judul</label>
          <input type="text" id="judul" name="judul" placeholder="Masukkan Judul...">
        </div>
        <div class="row">
          <label for="genre">Genre</label>
          <select id="genre" name="genre">
            <option value="">=== PILIH GENRE ===</option>
            <?php
            foreach ($genres as $genre) {
            ?>
              <option value="<?php echo $genre ?>"><?php echo $genre ?></option>
            <?php } ?>
          </select>
          <span id="guide-genre" style="display: none;">Genre telah diubah</span>
        </div>
        <div class="row">
          <label for="penulis">Penulis</label>
          <input type="text" id="penulis" name="penulis" placeholder="Masukkan Penulis...">
          <span id="guide-penulis" style="display: none;">Fact: Ada penulis yang juga menjadi sutradara.</span>
        </div>
        <div class="row">
          <label for="sutradara">Sutradara</label>
          <input type="text" id="sutradara" name="sutradara" placeholder="Masukkan Sutradara...">
        </div>
        <div class="row">
          <input type="submit" value="Submit">
        </div>
      </form>
    </section>
  </main>

  <script src="script.js"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const form = document.getElementById('filmForm');

      form.addEventListener('submit', function(event) {
        // Validasi input
        const judul = document.getElementById('judul').value;
        const genre = document.getElementById('genre').value;
        const penulis = document.getElementById('penulis').value;
        const sutradara = document.getElementById('sutradara').value;

        if (!judul || !genre || !penulis || !sutradara) {
          alert('Semua field harus diisi.');
          event.preventDefault(); // Mencegah form dari submit jika validasi gagal
        }
      });

      document.getElementById('penulis').addEventListener('focus', function() {
        document.getElementById('guide-penulis').style.display = "block";
      });

      document.getElementById('genre').addEventListener('change', function() {
        document.getElementById('guide-genre').style.display = "block";
      });
    });
  </script>
</body>

</html>