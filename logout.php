<?php
session_start();
require 'koneksi.php';
require 'Auth.php';

$auth = new Auth($conn);
$auth->logoutUser();

header("Location: login.php");
exit();
?>
