<?php 
    require '../php/dbcon.php';
    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $query = "UPDATE orders SET oStatus='Completed' WHERE oID='$id'";
        $result = mysqli_query($con, $query);
        if($result){
            header("Location: ../courier/view-delivery.php");
            exit;
        }
        
    }
?>