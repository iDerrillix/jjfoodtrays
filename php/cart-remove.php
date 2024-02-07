<?php 
    session_start();
    if(isset($_GET['id'])){
        $item_id = $_GET['id'];
        unset($_SESSION['cart'][$item_id]);
        header("Location: ../user/cart-details.php");
        exit();
    }
?>