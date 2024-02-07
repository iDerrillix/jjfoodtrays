<?php 
    include '../php/pass.php';
    require '../php/dbcon.php';
    if(isset($_POST['add-review'])){
        $rating = $_POST['rRating'];
        $msg = $_POST['rMsg'];

        $query = "INSERT INTO reviews (cID, rMsg, rRating) VALUES ('$id', '$msg', '$rating')";
        $result = mysqli_query($con, $query);
        if($result){
            header("Location: ../user/reviews.php");
            exit;
        }
    }
?>