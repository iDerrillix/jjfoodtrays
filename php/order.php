<?php 
    include 'dbcon.php';
    include 'cart.php';
    include 'pass.php';
    if(isset($_POST['order'])){
        $cFName = $_POST['cFName'];
        $cLName = $_POST['cLName'];
        $cPhone = $_POST['cPhone'];
        $cStreet = $_POST['cStreet'];
        $cBrgy = $_POST['cBrgy'];
        $cCity = $_POST['cCity'];
        $cProv = $_POST['cProv'];
        
        $delivery_opt = $_POST['delivery_opt'];
        $date = $_POST['date'];

        $payment_method = $_POST['payment_method'];
        $pRef = $_POST['pRef'];
        
        $query = "UPDATE customers SET cFName='$cFName', cLName='$cLName', cPhone='$cPhone', cStreet='$cStreet', cBrgy='$cBrgy', cCity='$cCity', cProv='$cProv' WHERE cID='$id';";
        mysqli_query($con, $query);
        $totalamount = 0;
        $query = "SELECT COUNT(prod_ID), prod_ID FROM products;";
        $result = mysqli_query($con, $query);
        $row = $result->fetch_row();
        $count = $row[0];
        for($i = 0; $i <= $count; $i++){
            if(isset($_SESSION['cart'][$i])){
                $totalamount = $totalamount + ($_SESSION['cart'][$i]['price'] * $_SESSION['cart'][$i]['qty']);
            }
        }
        $query ="INSERT INTO payment (pMethod, pAmount, pRef, pStatus) VALUES ('$payment_method', '$totalamount', '$pRef', 'Pending');";
        mysqli_query($con, $query);
        $pay_id = mysqli_insert_id($con);
        $query ="INSERT INTO orders (oType, oWhen, cID, pID, oStatus) VALUES ('$delivery_opt', '$date', '$id', $pay_id, 'Verifying Payment');";
        mysqli_query($con, $query);
        $order_id = mysqli_insert_id($con);
        for($i = 0; $i <= $count; $i++){
            if(isset($_SESSION['cart'][$i])){
                $query = "INSERT INTO order_item VALUES ($order_id, ".$i.", ".$_SESSION['cart'][$i]['qty'].")";
                mysqli_query($con, $query);
            }
            
        }
        for($i = $count; $i >= 0; $i--){
            if(isset($_SESSION['cart'][$i])){
                unset($_SESSION['cart'][$i]);
            }
        }
        header("Location: ../user/order-success.php");
        exit();
        
    }
?>