# UAS Pemrograman Web RA | Rayhan Ahmad Rizalullah - 1211400002

Halo, selamat datang. Ini adalah repository GitHub untuk UAS Pemrograman Web saya. Pada UAS ini, saya membuat website untk manajemen data film. Pada website ini, saya menggunakan HTML, CSS, PHP JavaScript, dan semua itu native ya btw.

[Anda bisa visit hasilnya di sini.](https://rayhan.geminiguys.my.id/uas_pemweb/login.php)

**Akun uji coba**
Email: admin@admin
Password: admin123

## Fitur
### Login
![Screenshot 2023-12-18 163643](https://github.com/rayhan-121140002/121140002_UAS-Pemweb/assets/109260551/02c35a3e-b661-4c3e-b046-e334604e71ef)

### Register
![Screenshot 2023-12-18 163650](https://github.com/rayhan-121140002/121140002_UAS-Pemweb/assets/109260551/e6be5e84-0483-4e9f-8070-966fa01f7c5c)

### Homepage/Manajemen Film & Hapus Film
![Screenshot 2023-12-18 163709](https://github.com/rayhan-121140002/121140002_UAS-Pemweb/assets/109260551/769f20b9-50f1-45ef-95c5-c055ada25b96)

### Tambah Film
![Screenshot 2023-12-18 163715](https://github.com/rayhan-121140002/121140002_UAS-Pemweb/assets/109260551/7ba6f8f7-c3d5-4e8f-b4a8-b3cf55faf56b)

### Ubah Film
![Screenshot 2023-12-18 163724](https://github.com/rayhan-121140002/121140002_UAS-Pemweb/assets/109260551/74177310-fdc0-41a0-afa6-a02659eff947)

## Keterkaitan dengan Kriteria Penilaian
### Bagian 1: Client-side Programming
Saya merapkan form input di fitur tambah dan ubah film.

![image](https://github.com/rayhan-121140002/121140002_UAS-Pemweb/assets/109260551/07a5f25c-101f-4a70-b82a-87d65a9c1115)

Pada manajemen, saya menampilkan data dari server dengan tag tabel. Tabel ini juga telah dibuat responsive sehingga tetap rapi jika dibuka lewat mobile.

![image](https://github.com/rayhan-121140002/121140002_UAS-Pemweb/assets/109260551/2e6e5f3f-32fc-481c-bde0-96cd8b963f07)

Selain itu, saya juga menerapkan 3 event dan validasi input di fitur tambah dan ubah film.
Event pertama adalah event "submit." Event ini adalah pencegahan form agar tidak kosong saat pengguna men-submit form. Pesan alert akan ditampilkan jika input kosong.

![image](https://github.com/rayhan-121140002/121140002_UAS-Pemweb/assets/109260551/3719bd5a-8436-4498-afd7-87b13591a6a3)
Kode yang digunakan:
```
  form.addEventListener("submit", function (event) {
    // Validasi input
    const judul = document.getElementById("judul").value;
    const genre = document.getElementById("genre").value;
    const penulis = document.getElementById("penulis").value;
    const sutradara = document.getElementById("sutradara").value;
  
    if (!judul || !genre || !penulis || !sutradara) {
      alert("Semua field harus diisi.");
      event.preventDefault(); // Mencegah form dari submit jika validasi gagal
    }
  });
```
Event kedua yaitu "focus." Event ini akan dipanggil saat pengguna sedang berada di input penulis. Hasilnya program akan menampilkan teks guide penulis dengan mengubah style display yang sebelumnya none menjadi block.

![image](https://github.com/rayhan-121140002/121140002_UAS-Pemweb/assets/109260551/c3c56600-5aed-444f-8e58-717ab0f8af22)
Kode yang digunakan:
  ```
document.getElementById("penulis").addEventListener("focus", function () {
    document.getElementById("guide-penulis").style.display = "block";
  });
```
Event ketiga yaitu "change." Event ini akan dipanggil saat pengguna mengubah value dari input select genre. Hasilnya program akan menampilkan teks guide genre dengan mengubah style display yang sebelumnya none menjadi block.

![image](https://github.com/rayhan-121140002/121140002_UAS-Pemweb/assets/109260551/32b24cde-60c7-40db-9a0a-30b56b614ff8)
Kode yang difunakan:
```
  document.getElementById('genre').addEventListener('change', function() {
    document.getElementById('guide-genre').style.display = "block";
  });
```

Validasi form dengan JavaScript juga digunakan sebagai pencegahan form agar tidak kosong saat pengguna men-submit form. Pesan alert akan ditampilkan jika input kosong.

![image](https://github.com/rayhan-121140002/121140002_UAS-Pemweb/assets/109260551/3719bd5a-8436-4498-afd7-87b13591a6a3)
Kode yang digunakan:
```
  form.addEventListener("submit", function (event) {
    // Validasi input
    const judul = document.getElementById("judul").value;
    const genre = document.getElementById("genre").value;
    const penulis = document.getElementById("penulis").value;
    const sutradara = document.getElementById("sutradara").value;
  
    if (!judul || !genre || !penulis || !sutradara) {
      alert("Semua field harus diisi.");
      event.preventDefault(); // Mencegah form dari submit jika validasi gagal
    }
  });
```

### Bagian 2: Server-side Programming
Saya telah mengimplementasikan method POST dan GET, menggunakan variabel globalnya, serta parsing dan validasinya di banyak fitur.
Sebagai contoh, saya menerapkannya di update.php. Blok kode if dan else if berikut akan dijalankan jika $_Get['id'] memiliki value.
```
  if (isset($_GET["id"]) and (isset($_GET["action"]) and $_GET["action"] == "form")) {
    $id = $_GET['id'];
    .........
    }
  } else if (isset($_GET["id"]) and (isset($_GET["action"]) and $_GET["action"] == "update")) {
    if (isset($_POST["judul"]) and isset($_POST["genre"]) and isset($_POST["penulis"]) and isset($_POST["sutradara"])) {
      $id_get = $_GET['id'];
      $judul = $_POST['judul'];
      $genre = $_POST['genre'];
      $penulis = $_POST['penulis'];
      $sutradara = $_POST['sutradara'];
      ......
    }
    ....
  } else {
    .....
  }
```

Untuk menyimpan jenis browser dan alamat IP pengguna, saya menerapkannya di fitur login. Saat pengguna berhasil login, token akan dibuat dan disimpan bersama dengan user ID, jenis browser dan alamat IP pengguna.

Kelas Auth:
```
  ...
  private function storeToken($userId, $token) {
    $stmt = $this->conn->prepare("INSERT INTO token (user_id, token, browser, ip_address) VALUES (?, ?, ?, ?)");
    $browser = $_SERVER['HTTP_USER_AGENT'];
    $ip = $_SERVER['REMOTE_ADDR'];
    $stmt->execute([$userId, $token, $browser, $ip]);
  }
  ...
```

Sedangkan untuk menangani autentikasi pengguna seperti fungsi login, register, dan token saya menerapkannya dengan OOP di kelas Auth.php.

### Bagian 3: Database Management
Untuk membuat tabel, saya telah menyertakan query SQL "uas_pemweb.sql" yang dapat diimpor melalui phpMyAdmin ke database yang diinginkan.

Sedangkan konfigurasi untuk koneksi ke database MySQL terdapat pada "koneksi.php." Koneksi database di sini menggunakan PDO yang punya banyak kelebihan ketimbang MySQLi.

Kemudian untuk manipulasi data pada tabel database (CRUD: Create, Read, Update, Delete) terdapat di fitur manajemen film serta autentikasi pengguna (login, register, token).

### Bagian 4: State Management

Autentikasi pengguna yang diterapkan melalui kelas Auth di website saya sangat memanfaatkan session. Manipulasi session dilakukan dengan menyimpan dan menghapus token sebagai informasi pengguna di session. session_start juga digunakan di seluruh fitur website saya.

### Bagian Bonus: Hosting Aplikasi Web

**Langkah-langkah meng-host website saya.**
Saya dan teman-teman saya membeli hosting dan domain "geminiguys.my.id" di RumahWeb Setelah itu, kami memperoleh username dan password untuk membuka cPanel website kami. Dengan cPanel, kami bisa memulai meng-host website kami.

Selanjutnya, kami mulai dengan membuat subdomain dari geminiguys.my.id untuk saya dan teman-teman saya. Saya mendapatkan subdomain "rayhan.geminiguys.my.id" di mana ini juga membuat folder dengan nama yang sama di public_html. Setelah itu, saya membuka manajemen database MySQL di cPanel dan membuat database baru. Tak lupa, saya juga membuat user MySQL dan memberi izin akses ke database tadi. Saya membuka phpMyAdmin, masuk ke database itu, dan melakukan impor SQL "uas_pemweb.sql" ke database tersebut.

Kemudian, saya membuka file manager di cPanel dan mengunggah file-file website saya di folder tadi. Setelah selesai diunggah, saya memodifikasi konfigurasi di koneksi.php dan menyesuaikannya dengan konfigurasi sebelumnya.

**Penyedia Hosting yang Cocok?**
Menurut saya, hosting dan domain yang kami beli dari RumahWeb sudah sangat cocok untuk kebutuhan UAS Pemrograman Web ini. Harganya affordable untuk masa aktif hingga 1 tahun, pelayanan customer service yang cukup baik, dan website tetap stabil.

**Keamanan Website**
Keamanan dapat dijaga dengan tidak memberikan konfigurasi database dan akun cPanel ke sembarang orang. Jika identitas tersebut tidak dijaga dengan baik, hacker dapat merusak website kita. Kami juga mengaktifkan HTTPS agar website kami menjadi lebih aman..

**Konfigurasi Server**
Seperti yang telah disebutkan sebelumnya, kami menggunakan subdomain pada hosting kami agar bisa saling berbagi. Kami juga mengaktifkan HTTPS agar website kami menjadi lebih aman. Untuk paket hosting yang kami membeli paket unlimited bandwith, storage, dan database MySQL dengan syarat dan ketentuan yang berlaku.