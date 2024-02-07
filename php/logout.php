<?php 
    session_start();
    unset($_SESSION['login']);
    unset($_SESSION['cID']);
    session_destroy();
    header("Location: ../index.html");
    exit();
?>