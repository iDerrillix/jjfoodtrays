<?php 
    require '../php/dbcon.php';

    if(isset($_GET['prod_ID'])){
        $id = $_GET['prod_ID'];

        $query = "DELETE FROM products WHERE prod_ID='$id'";
        $result = mysqli_query($con, $query);
        if($result){
            header("Location: ../admin/products.php");
            exit;
        }
    }
?>