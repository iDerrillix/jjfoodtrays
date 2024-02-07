<?php 
    include '../php/pass.php';
    require '../php/dbcon.php';
    if(isset($_POST['update-prof'])){
        $cFName = $_POST['cFName'];
        $cLName = $_POST['cLName'];
        $cPhone = $_POST['cPhone'];
        $cStreet = $_POST['cStreet'];
        $cBrgy = $_POST['cBrgy'];
        $cCity = $_POST['cCity'];
        $cProv = $_POST['cProv'];
        $uPswd = $_POST['uPswd'];

        $query = "UPDATE customers SET cFName='$cFName', cLName='$cLName', cPhone='$cPhone', cStreet='$cStreet', cBrgy='$cBrgy', cCity='$cCity', cProv='$cProv' WHERE cID='$id';";
        $query .= "UPDATE users SET uPswd='$uPswd' WHERE cID='$id'";
        if(mysqli_multi_query($con, $query)){
            header("Location: ../user/profile.php");
            exit;
        } else {
            header("Location: ../user/error-page.php");
            exit;
        }
    }
?>