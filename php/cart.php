<?php
    session_start();
    if(isset($_POST['id'])){
        $item_id = $_POST['id'];
        $qty = 1;
        $price = floatval($_POST['price']);
        if(isset($_SESSION['cart'])){
            if(in_array($item_id, $_SESSION['cart'])){
                $_SESSION['cart'][$item_id]['qty']++;
            } else {
                $_SESSION['cart'][$item_id] = array('qty' => $qty, 'price' => $price);
            }
        } else {
            $_SESSION['cart'][$item_id] = array('qty' => $qty, 'price' => $price);
        }
        echo 1;
        // header("Location: ../user/home.php");
        exit();
    } else{
        echo 0;
    }
?>