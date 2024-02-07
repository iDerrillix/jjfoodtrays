<?php 
    require '../php/dbcon.php';
    if(isset($_POST['add-admin'])){
        $email = $_POST['uEmail'];
        $password = $_POST['uPswd'];

        $query = "INSERT INTO users (uEmail, uPswd, uType, cID) VALUES ('$email', '$password', '1', NULL)";
        $result = mysqli_query($con, $query);
        if($result){
            header("Location: ../admin/manage-users.php");
            exit;
        }
    } else if (isset($_POST['add-courier'])){
        $email = $_POST['uEmail'];
        $password = $_POST['uPswd'];

        $query = "INSERT INTO users (uEmail, uPswd, uType) VALUES ('$email', '$password', '3')";
        $result = mysqli_query($con, $query);
        if($result){
            header("Location: ../admin/manage-users.php");
            exit;
        }
    } else if(isset($_POST['remove-user'])){
        $email = $_POST['uEmail'];
        $password = $_POST['uPswd'];

        $query = "DELETE FROM users WHERE uEmail='$email'";
        $result = mysqli_query($con, $query);
        if($result){
            header("Location: ../admin/manage-users.php");
            exit;
        }
    }
?>