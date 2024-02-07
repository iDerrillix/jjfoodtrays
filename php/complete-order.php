<?php 
    require '../php/dbcon.php';
    if(isset($_GET['id']) && isset($_GET['type'])){
        $id = $_GET['id'];
        $type = $_GET['type'];
        if($type == 'Pick-up'){
            $query = "UPDATE orders SET oStatus='Awaiting Pickup' WHERE oID='$id'";
            $result = mysqli_query($con, $query);
            if($result){
                header("Location: ../admin/view-orders.php");
                exit;
            }
        } elseif($type == 'Deliver'){
            $query = "UPDATE orders SET oStatus='Awaiting Shipment' WHERE oID='$id'";
            $result = mysqli_query($con, $query);
            if($result){
                header("Location: ../admin/view-orders.php");
                exit;
            }
        }
        
    }
?>