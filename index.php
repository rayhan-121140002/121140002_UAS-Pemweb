<?php
session_start();
include "koneksi.php";
require 'Auth.php';

$auth = new Auth($conn);

if (!$auth->checkToken()) {
  header("Location: login.php");
  exit();
}

$hitRow = $conn->prepare("SELECT COUNT(*) FROM film");
$hitRow->execute();
?>
<!DOCTYPE html>
<html lang="en">

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
      <h1>Manajemen Film</h1>
      <p>Rayhan Ahmad Rizalullah - 121140002</p>
      <p>UAS Pemrograman Web Kelas RA</p>
      <a class="btn-primary" href="./create.php">Tambah Film</a>
      <?php
      if ($hitRow->fetchColumn() > 0) {
        $query = $conn->prepare("SELECT * FROM film");
        $query->execute();
        $films = $query->fetchAll(PDO::FETCH_OBJ);
      ?>
        <div class="table-overlay">
          <table id="data-film">
            <tr class="header-table">
              <th>No.</th>
              <th>Judul</th>
              <th>Genre</th>
              <th>Penulis</th>
              <th>Sutradara</th>
              <th>Aksi</th>
            </tr>
            <?php
            $i = 1;
            foreach ($films as $film) {
            ?>
              <tr>
                <td><?php echo $i;
                    ?></td>
                <td><?php echo $film->judul;
                    ?></td>
                <td><?php echo $film->genre;
                    ?></td>
                <td><?php echo $film->penulis;
                    ?></td>
                <td><?php echo $film->sutradara;
                    ?></td>
                <td>
                  <a class="btn-primary" href="./update.php?action=form&id=<?php echo $film->id;
                                                                            ?>">Ubah</a>
                  <a class="btn-primary" onclick="return confirm('Apakah Anda yakin akan menghapus data ini?')" href="./delete.php?id=<?php echo $film->id;
                                                                                                                                      ?>">Hapus</a>
                </td>
              </tr>
            <?php
              $i++;
            }
            ?>
          </table>
        </div>
      <?php
      } else {
        echo "<p>Belum ada data.</p>";
      }
      ?>
    </section>

    <!-- Other content goes here -->
  </main>

  <script src="script.js"></script>
</body>

</html>