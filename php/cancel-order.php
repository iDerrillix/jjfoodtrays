<?php 
    require '../php/dbcon.php';
    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $query = "UPDATE orders SET oStatus='Cancelled' WHERE oID='$id';";
        $query .= "UPDATE payment set pStatus='Cancelled' WHERE pID=(SELECT pID FROM orders WHERE oID='$id')";
        $result = mysqli_multi_query($con, $query);
        if($result){
            header("Location: ../user/orders.php");
            exit;
        }
    }
?>