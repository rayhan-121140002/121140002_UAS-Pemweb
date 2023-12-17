<?php
session_start();
    include "koneksi.php";
    require 'Auth.php';

    $auth = new Auth($conn);
    
    if (!$auth->checkToken()) {
        header("Location: login.php");
        exit();
    }

    if (isset($_GET["id"])) {
        $id = $_GET['id'];
        $hitRow = $conn->prepare("SELECT COUNT(*) FROM film WHERE id = ?");
        $hitRow->execute([$id]);
        if($hitRow->fetchColumn() == 1){
            $query = $conn->prepare("DELETE FROM film WHERE id = ?");
            $query->execute([$id]);
        }
    }

    $conn = null;
    header('Location: ./index.php');
    exit();