<?php
    require 'connection.php';
    $id = $_GET['id'];
    $pengguna = mysqli_query($conn, "SELECT * FROM pengguna WHERE id=$id");
    $row = mysqli_fetch_assoc($pengguna);


    $pengguna = mysqli_query($conn, "DELETE FROM pengguna WHERE id=$id");
    if ($pengguna) {
        header('location: datausers.php');
        $_SESSION['message'] = 'Data Sudah Terhapus';
    }
