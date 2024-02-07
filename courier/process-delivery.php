<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../admin/products.css">
    <link rel="stylesheet" href="../flexbox.css">
    <link rel="stylesheet" href="../table-css.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Process Delivery</title>
</head>
<body>
    <?php 
        session_start();
        include '../php/verification.php';
        include '../courier/sidebar.html';
        require '../php/dbcon.php';

        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $query = "UPDATE orders SET oStatus='Shipping' WHERE oID='$id'";
            mysqli_query($con, $query);
            $query = "SELECT orders.oID, CONCAT(customers.cFName, ' ', customers.cLName) AS cName, CONCAT(customers.cStreet, ' ',customers.cBrgy, ' ',customers.cCity, ' ',customers.cProv) AS cAddress, customers.cPhone, users.uEmail, payment.pAmount FROM orders JOIN customers ON orders.cID=customers.cID JOIN users ON customers.cID=users.cID JOIN payment ON orders.pID=payment.pID WHERE orders.oID='$id';";
            $result = mysqli_query($con, $query);
            $row = $result->fetch_row();
        }
    ?>
    <header>
        <h2><label for=""><span class="material-symbols-outlined">menu</span></label>View Deliveries</h2>
        
    </header>
    <div class="main-content">
        <div class="flex-row">
            <div class="center">
                <div class="fit-content">
                    <div class="design-container">
                        <div class="flex-row">
                            <div class="sw">
                                <h3>Delivery Information</h3>
                                <br>
                                <?php 
                                    echo "
                                    <h4>Order ID</h4>
                                    <p>".$row[0]."</p>
                                    <h4>Customer Name</h4>
                                    <p>".$row[1]."</p>
                                    <h4>Customer Address</h4>
                                    <p>".$row[2]."</p>
                                    ";
                                ?>
                            </div>
                            <div class="sw">
                                <br><br>
                                <?php 
                                    echo "<h4>Phone Number</h4>
                                    <p>".$row[3]."</p>
                                    <h4>Email Address</h4>
                                    <p>".$row[4]."</p>
                                    <h4>Total</h4>
                                    <p>".$row[5]."</p>";
                                ?>
                                <br><br>
                                <a href="../courier/complete-delivery.php?id=<?php echo $id;?>" class="goto-btn">Complete</a>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="center">
                <div class="fit-content">
                    <div class="design-container">
                        <div class="sw">
                        <h3>Order Items</h3>
                                <table class="table-css">
                                    <thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th>Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $query = "SELECT products.prod_name, order_item.qty FROM products JOIN order_item ON products.prod_ID = order_item.prod_ID WHERE order_item.oID='$id'";
                                            $result = mysqli_query($con, $query);
                                            while($row = $result->fetch_assoc()){
                                                echo "
                                                <tr>
                                                    <td>".$row['prod_name']."</td>
                                                    <td>".$row['qty']."</td>
                                                </tr>
                                                ";
                                            }
                                        ?>
                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
    </div>
</body>
</html>