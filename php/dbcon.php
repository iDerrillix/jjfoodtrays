<?php 
    $con = mysqli_connect('localhost', 'root', '', 'jjfoodtrays');
    if(!$con){
        die("Connect Error".mysqli_connect_error());
    }
?>