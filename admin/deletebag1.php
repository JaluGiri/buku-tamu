<?php
    require 'connection.php';
    $id = $_GET['id'];
    $tamu = mysqli_query($conn, "SELECT * FROM tamu WHERE id=$id");
    $row = mysqli_fetch_assoc($tamu);


    $tamu = mysqli_query($conn, "DELETE FROM tamu WHERE id=$id");
    if ($tamu) {
        header('location: bagian1.php');
        $_SESSION['message'] = 'Data has been Deleted';
    }
