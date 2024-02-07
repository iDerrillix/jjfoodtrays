<?php 
    require '../php/dbcon.php';
    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $query = "UPDATE payment SET pStatus='Declined' WHERE pID='$id';";
        $query .= "UPDATE orders SET oStatus='Order Declined' WHERE pID='$id';";

        if(mysqli_multi_query($con, $query)){
            header("Location: ../admin/view-payments.php");
            exit;
        } 
    }
?>