<?php 
    if(!isset($_SESSION['admin']) || !isset($_SESSION['login'])){
        include '../php/logout.php';
    }
?>