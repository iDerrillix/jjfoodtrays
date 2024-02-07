<?php
if(!isset($_SESSION)){
    session_start();
    $id = $_SESSION['cID'];
} else {
    $id = $_SESSION['cID'];
}
?>