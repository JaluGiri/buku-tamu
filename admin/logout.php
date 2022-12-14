<?php 
    require 'connection.php';

    session_destroy();

    header('location: adminlogin.php', true)
?>