<?php 
    require '../php/dbcon.php';
    if(isset($_GET['id']) && isset($_GET['revert'])){
        $id = $_GET['id'];
        $query = "SELECT prod_price FROM products WHERE prod_id='$id'";
        $result = mysqli_query($con, $query);
        $row = $result->fetch_assoc();
        $price = $row['prod_price'];
        $price = ($price / 0.9);
        $query = "UPDATE products SET prod_price='$price', discounted='0' WHERE prod_id='$id'";
        if(mysqli_query($con, $query)){
            header("Location: ../admin/products.php");
            exit;
        }
    } else if(isset($_GET['id'])){
        $id = $_GET['id'];
        $query = "SELECT prod_price FROM products WHERE prod_id='$id'";
        $result = mysqli_query($con, $query);
        $row = $result->fetch_assoc();
        $price = $row['prod_price'];
        $price = $price - ($price * 0.10);
        $query = "UPDATE products SET prod_price='$price', discounted='1' WHERE prod_id='$id'";
        if(mysqli_query($con, $query)){
            header("Location: ../admin/products.php");
            exit;
        }
    } else {

    }
?>