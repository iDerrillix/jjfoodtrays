<?php 
    require '../php/dbcon.php';
    if(isset($_POST['add-menu'])){
        $m_name = mysqli_real_escape_string($con,$_POST['m_name']);
        
        $query = "INSERT INTO menu (m_name) VALUES ('$m_name')";
        if(mysqli_query($con, $query)){
            header("Location: ../admin/products.php");
            exit;
        }

    }
?>