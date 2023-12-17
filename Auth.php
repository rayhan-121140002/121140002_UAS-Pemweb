<?php
class Auth {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function loginUser($email, $password) {
        $stmt = $this->conn->prepare("SELECT id, password FROM user WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $token = $this->generateToken();
            $this->storeToken($user['id'], $token);
            $_SESSION['token'] = $token;
            return true;
        }

        return false;
    }

    public function checkToken() {
        if (isset($_SESSION['token'])) {
            $stmt = $this->conn->prepare("SELECT * FROM token WHERE token = ?");
            $stmt->execute([$_SESSION['token']]);
            return $stmt->fetch(PDO::FETCH_ASSOC) ? true : false;
        }
        return false;
    }

    public function logoutUser() {
        if (isset($_SESSION['token'])) {
            $stmt = $this->conn->prepare("DELETE FROM token WHERE token = ?");
            $stmt->execute([$_SESSION['token']]);
            unset($_SESSION['token']);
            session_destroy();
        }
    }

    private function generateToken() {
        return bin2hex(random_bytes(32));
    }

    private function storeToken($userId, $token) {
        $stmt = $this->conn->prepare("INSERT INTO token (user_id, token, browser, ip_address) VALUES (?, ?, ?, ?)");
        $browser = $_SERVER['HTTP_USER_AGENT'];
        $ip = $_SERVER['REMOTE_ADDR'];
        $stmt->execute([$userId, $token, $browser, $ip]);
    }
    public function registerUser($email, $username, $password) {
        // Validasi input
        if(empty($email) || empty($username) || empty($password)) {
            return false; // Input tidak lengkap
        }

        // Cek apakah email sudah ada
        $stmt = $this->conn->prepare("SELECT id FROM user WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            return false; // Email sudah terdaftar
        }

        // Enkripsi password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Masukkan user baru ke database
        $stmt = $this->conn->prepare("INSERT INTO user (email, username, password) VALUES (?, ?, ?)");
        $stmt->execute([$email, $username, $hashedPassword]);

        // Ambil ID user yang baru dibuat
        $userId = $this->conn->lastInsertId();

        // Buat token untuk sesi
        $token = $this->generateToken();
        $this->storeToken($userId, $token);
        $_SESSION['token'] = $token;

        return true;
    }
}
?>