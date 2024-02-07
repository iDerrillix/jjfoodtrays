<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="cart-details.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script
    src="https://code.jquery.com/jquery-3.6.3.min.js"
    integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU="
    crossorigin="anonymous"></script>
    <title>Shopping Cart | JJ Food Trays</title>
</head>
<body>
    <?php
        
        include 'header.php';
        include '../php/cart.php';
        include '../php/dbcon.php';
        
        
        // for($i = 0; $i < count($_SESSION['cart']); $i++){
        //     $query = "SELECT"
        // }
    ?>
    <form action="../user/checkout.php" method="POST">
        <div class="cart-main">
            <div class="cart-details">
            <?php 
                    if(isset($_GET['status']) && $_GET['status'] == 'empty'){
                        echo "<p class='status-msg'>Your cart is empty!</p>";
                    } else if(isset($_GET['status']) && $_GET['status'] == 'early'){
                        echo "<p class='status-msg'>You are ordering too quickly! Please wait a minute before ordering again.</p>";
                    }
                ?>
                <div class="cart-heading">
                    <h4>Your Cart</h4>
                    <h4><?php if(isset($_SESSION['cart'])){
                        echo count($_SESSION['cart'])." Items";
                    } else {
                        echo "0 Items";
                    } ?>
                    </h4>
                </div>
                <br>
                <div class="cart-table">
                    <table class="table-css">
                        <thead>
                            <tr>
                                <th>Product Details</th>
                                <th></th>
                                <th></th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th>Total Price</th>
                                <th></th>
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
                                        <td><input type='number' name='$i-qty' step='1' min='1' max='99' value='".$qty."' required class='input-qty' id='test' onchange='update_price(this);' data-price='".$row['prod_price']."'></td>
                                        <td>₱".$row['prod_price']."</td>
                                        <td></td>
                                        <td><a class='cart-remove' href='../php/cart-remove.php?id=".$i."'>X</a></td>
                                        </tr>";
                                        
                                    }
                                    
                                }
                            }
                                
                            ?>
                        </tbody>
                    </table>
                </div>
                <br>
                <div style="float: right;">
                    <h5 style="display: inline;"><b>TOTAL: ₱</b></h5>
                    <h5 id="total" style="display: inline;">
                        <?php
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
                            echo $totalamount;
                        ?>
                    </h5>
                    <p style="font-size: 14px; color: #D0D0D0;">Shipping fee not included</p>
                    <input type="submit" value="Checkout" class="submit-btn" name="checkout">
                </div>
                
                <script>

                    var initial_value;
                    $("input").on('focus', function(){
                        initial_value = this.value;
                    });
                    function update_price(d){
                        var new_Value = d.value;
                        var prod_price = Number(d.getAttribute("data-price"));
                        var total = Number(document.getElementById("total").innerText);
                        if(initial_value < new_Value){
                            var total_price = total + prod_price;
                        } else {
                            var total_price = total - prod_price;
                        }
                        document.getElementById("total").innerHTML = total_price;
                    }
                </script>
            </div>
    </form>
    
</body>
</html>