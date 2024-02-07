<?php 
        
        include '../php/dbcon.php';
        include '../php/cart.php';
        include '../php/pass.php';
        
        
        
        if(isset($_POST['checkout'])){
            $query = "SELECT MIN(TIMESTAMPDIFF(SECOND, oPlace, CURRENT_TIMESTAMP)) FROM orders WHERE cID='$id'";
            $result = mysqli_query($con, $query);
            $interval = $result->fetch_row();
            if($interval[0] < 30 & $interval[0] != NULL){
                header("Location: ../user/cart-details.php?status=early");
                exit();
            }
            if(isset($_SESSION['cart']) && count($_SESSION['cart']) != 0){
                $query = "SELECT COUNT(prod_ID), prod_ID FROM products;";
                $result = mysqli_query($con, $query);
                $row = $result->fetch_row();
                $count = $row[0];
                for($i = 0; $i <= $count; $i++){
                    if(isset($_SESSION['cart'][$i]['qty'])){
                        $_SESSION['cart'][$i]['qty'] = $_POST[''.$i.'-qty'];
                    }
                }
            } else {
                header("Location: ../user/cart-details.php?status=empty");
                exit();
            }
           
        } else {
            header("Location: ../user/home.php");
            exit();
        }
        $query = "SELECT * from customers WHERE cID='$id'";
        $result = mysqli_query($con, $query);
        $row = $result->fetch_assoc();
        
        
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script
    src="https://code.jquery.com/jquery-3.6.3.min.js"
    integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU="
    crossorigin="anonymous"></script>
    <link rel="stylesheet" href="checkout.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout | JJ Food Trays</title>
</head>
<body>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#method_onsite").hide();
            $("label[for=method_onsite],#zone_r1").hide();
            $('#method_gcash').click(function(){
                $(".qr-code").show(1000);
                $('#refID').prop('disabled', false)
                $('#refID').show(1000);
                $('#refTitle').show(1000);
                $('#refID').prop('required', true);
            });
            $('#method_cod').click(function(){
                $(".qr-code").hide(1000);
                $('#refID').hide(1000);
                $('#refTitle').hide(1000);
                $('#refID').prop('disabled', true);
                $('#refID').prop('required', false);
            });
            $('#method_onsite').click(function(){
                $(".qr-code").hide(1000);
                $('#refID').prop('disabled', true);
                $('#refID').hide(500);
                $('#refTitle').hide(1000);
                $('#refID').prop('required', false);
            });
            $('#order_deliver').click(function(){
                $("#method_onsite").hide(500);
                $("#method_cod").show(500);
                $("label[for=method_onsite],#zone_r1").hide(500);
                $("label[for=method_cod],#zone_r1").show(500);

            });
            $('#order_pickup').click(function(){
                $("#method_onsite").show(500);
                $("label[for=method_onsite],#zone_r1").show(500);
                $("#method_cod").hide(500);
                $("label[for=method_cod],#zone_r1").hide(500);
            });
        });
        
    </script>
    <?php include 'header.php';?>
    
    <form action="../php/order.php" method="POST">
    <div class="main-cont">
        <div class="main">
            <div class="checkout">
                <div class="main-info">
                    <div class="cust-info">
                        <h4>Receiver's Information</h4>
                        <input type="text" name="cFName" id="" placeholder="First Name" required value="<?= $row['cFName'];?>" class="input-field">
                        <input type="text" name="cLName" id="" placeholder="Last Name" required value="<?= $row['cLName'];?>" class="input-field">
                        <input type="tel" name="cPhone" id="" pattern="09[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]" placeholder="09XXXXXXXXX" required value="<?= $row['cPhone'];?>" class="input-field">
                        <br><br>
                    </div>
                    <div class="delivery">
                        <h4>Delivery</h4>
                        <h6>Shipping Address</h6>
                        <input type="text" name="cStreet" id="" required placeholder="Street" value="<?= $row['cStreet'];?>" class="input-field">
                        <input type="text" name="cBrgy" id="" required placeholder="Barangay" value="<?= $row['cBrgy'];?>" class="input-field">
                        <input type="text" name="cCity" id="" required placeholder="City" value="<?= $row['cCity'];?>" class="input-field">
                        <input type="text" name="cProv" id="" required placeholder="Province" value="<?= $row['cProv'];?>" class="input-field">
                        <br><br>
                        <h6>Type</h6>
                        <input type="radio" name="delivery_opt" id="order_deliver" value="Deliver" required checked="true">
                        <label for="order_deliver">Deliver</label>
                        <input type="radio" name="delivery_opt" id="order_pickup" value="Pick-up" required>
                        <label for="order_pickup">Pick-up</label>
                        <br><br>
                        <h6>Delivery/Pickup Schedule</h6>
                        <input type="date" name="date" id="" value="<?php echo date('Y-m-d'); ?>" min="<?php echo date("Y-m-d"); ?>" required class="input-field">
                    </div>
                    <div class="payment">
                    
                    </div>
                </div>
                <div class="cart-details">
                <h4>Payment</h4>
                        <h6>Payment Method</h6>
                        <div class="qr-code">
                            <p>If the method is GCash, pay the amount to this account (09184639221) </p>
                            <img src="../images/qr_code.jpg" alt="" width="200px">
                        </div>
                        <input type="radio" name="payment_method" id="method_gcash" value="GCash" required checked="true">
                        <label for="method_gcash">GCash</label>
                        <input type="radio" name="payment_method" id="method_cod" value="COD" required>
                        <label for="method_cod">Cash On Delivery</label>
                        <input type="radio" name="payment_method" id="method_onsite" value="Onsite" required>
                        <label for="method_onsite" id="method_onsite">In Store Payment </label>
                        <h6 id="refTitle">Reference ID</h6>
                        <input type="text" name="pRef" id="refID" placeholder="13 Digit GCash Ref. No." minlength="13" maxlength="13" class="input-field">
                        <br>
                        <a href="../user/cart-details.php" class="back">Go Back</a>
                        <input type="submit" value="Place Order" name="order" class="submit-btn">
                
                </div>
            </div>
            <br>
            <div class="cart">
                <h5>Cart Details</h5>
                <table class="table-css">
                    <thead>
                        <tr>
                            <th>Product Details</th>
                            <th></th>
                            <th></th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Total Price</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php
                        
                        if(isset($_SESSION['cart'])){
                            $query = "SELECT COUNT(prod_ID), prod_ID FROM products;";
                            $result = mysqli_query($con, $query);
                            $row = $result->fetch_row();
                            $count = $row[0];
                            for($i = 1; $i <= $count; $i++){
                                if(isset($_SESSION['cart'][$i])){
                                    $qty = $_SESSION['cart'][$i]['qty'];
                                    $query = "SELECT menu.m_name, products.pImgPath, products.prod_name, products.prod_price FROM products JOIN menu on menu.m_cat = products.m_cat WHERE products.prod_ID='$i'";
                                    $result = mysqli_query($con, $query);
                                    $row = $result->fetch_assoc();
                                    echo "<tr>
                                    <td><img src='../images/".$row['pImgPath']."' style='display:block;' width='80px' height='60px'></td>
                                    <td>".$row['m_name']."</td>
                                    <td>".$row['prod_name']."</td>
                                    <td>".$qty."</td>
                                    <td>₱".$row['prod_price']."</td>
                                    <td></td>
                                    </tr>";
                                    
                                }
                                
                            }
                        }
                            
                        ?>
                    </tbody>
                        </table>
                            
            </div>
        </div>
        
        
        
    </div>
    </form>
</body>
</html>