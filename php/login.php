<?php 
    session_start();
    require 'dbcon.php';

    if(isset($_POST['sign-in'])){
        
        //removes any special characters to avoid XSS scripting
        $unam = htmlspecialchars($_POST['uEmail']);
        $pwd = htmlspecialchars($_POST['uPswd']);

        //prepare statements to avoid sql injections
        $query = $con->prepare("SELECT cID, uType FROM users WHERE uEmail=? AND uPswd=? ");
        $query->bind_param("ss", $unam, $pwd);
        $query->execute();
        $query->store_result();
        $query->bind_result($cID, $uType);
        if($query->num_rows > 0){
            while($query->fetch()){
                //redirects to proper page depending on user type
                if($uType == 1){
                    $_SESSION['cID'] = $cID;
                    $_SESSION['login'] = true;
                    $_SESSION['admin'] = true;
                    header("Location: ../admin/dashboard.php");
                    exit();
                } elseif($uType == 2){
                    $_SESSION['cID'] = $cID;
                    $_SESSION['login'] = true;
                    header("Location: ../user/home.php");
                    exit();
                } elseif($uType == 3){
                    $_SESSION['login'] = true;
                    header("Location: ../courier/view-delivery.php");
                    exit();
                }
                else{
                    header("Location: ../index-error.html");
                    exit();
                }
            }
            
        } else {
            header("Location: ../index-error.html");
            exit();
        }
    } else {
        header("Location: ../index.html");
        exit;
    }
?>