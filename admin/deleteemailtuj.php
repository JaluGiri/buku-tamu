<?php
    require 'connection.php';
    $id = $_GET['id'];
    $tujuan = mysqli_query($conn, "SELECT * FROM tujuan WHERE id=$id");
    $row = mysqli_fetch_assoc($tujuan);


    $tujuan = mysqli_query($conn, "DELETE FROM tujuan WHERE id=$id");
    if ($tujuan) {
        header('location: dataemailtujuan.php');
        $_SESSION['message'] = 'Data has been Deleted';
    }
