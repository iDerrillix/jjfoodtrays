<?php
    require '../php/dbcon.php' ;
    if(isset($_GET['id'])){
        $id = mysqli_escape_string($con, $_GET['id']);

        $query = "DELETE FROM menu WHERE m_cat='$id'";
        if(mysqli_query($con, $query)){
            header("Location: ../admin/products.php");
            exit;
        }
    }
?>