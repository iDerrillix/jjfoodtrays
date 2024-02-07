<?php
    require 'dbcon.php';

    if(isset($_POST['signup'])){
        $email = $_POST['uEmail'];
        $pass = $_POST['uPswd'];
        $cFName = $_POST['cFName'];
        $cLName = $_POST['cLName'];
        $cStreet = $_POST['cStreet'];
        $cBrgy = $_POST['cBrgy'];
        $cCity = $_POST['cCity'];
        $cProv = $_POST['cProv'];
        $cPhone = $_POST['cPhone'];
        
        $query = "SELECT uEmail FROM users WHERE uEmail='$email'";
        $result = mysqli_query($con, $query);
        if(mysqli_num_rows($result) > 0){
            header("Location: ../register-error.html");
            exit;
        } else {
            $query = "INSERT INTO customers VALUES ('', '$cFName', '$cLName', '$cStreet', '$cBrgy', '$cCity', '$cProv', '$cPhone'); INSERT INTO users VALUES ('', '$email', '$pass', '2', LAST_INSERT_ID());";
            $result = mysqli_multi_query($con, $query);
            if($result){
                header("Location: http://".$_SERVER['HTTP_HOST']."/jjfoods/index.html");
                exit();
            } else {
                echo "error";
                exit();
            }
        }
        
    }
?>

