<?php 
    include '../php/dbcon.php';
    if(isset($_POST['edit-product'])){
        $id = $_POST['prod_ID'];
        $name = $_POST['prod_name'];
        $desc = $_POST['prod_desc'];
        $price = $_POST['prod_price'];
        $cost = $_POST['prod_cost'];
        $cat = $_POST['m_cat'];

        $query = "UPDATE products SET prod_name='$name', prod_desc='$desc', prod_price='$price', prod_cost='$cost', m_cat='$cat' WHERE prod_ID='$id'";
        $result = mysqli_query($con, $query);
        if($result){
            header("Location: ../admin/products.php");
            exit();
        }
    } else if(isset($_POST['edit-menu'])){
        $id = $_POST['m_cat'];
        $name = $_POST['m_name'];

        $query = "UPDATE menu SET m_name='$name' WHERE m_cat='$id'";
        $result = mysqli_query($con, $query);
        if($result){
            header("Location: ../admin/products.php");
            exit();
        }
    }
?>