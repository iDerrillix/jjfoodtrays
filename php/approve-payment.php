<?php 
    require '../php/dbcon.php';

    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $query = "UPDATE payment SET pStatus='Verified' WHERE pID='$id';";
        $query .= "UPDATE orders SET oStatus='Awaiting Fulfillment' WHERE pID='$id';";
        $result = mysqli_multi_query($con, $query);
        if($result){
            header("Location: ../admin/view-payments.php");
            exit;
        }
    }
?>