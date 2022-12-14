<?php 
    require 'connection.php';

    session_destroy();

    header('location: logreg.php', true)
?>