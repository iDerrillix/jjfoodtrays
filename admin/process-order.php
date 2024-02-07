<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../table-css.css">
    <link rel="stylesheet" href="../admin/products.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Process Order</title>
</head>
<body>
    <?php 
        session_start();
        include '../php/level.php';
        require '../php/dbcon.php';
        include '../admin/sidebar.html';
        if(isset($_GET['id'])){
            $id = $_GET['id'];

            $query = "UPDATE orders SET oStatus='Processing' WHERE oID='$id'";
            mysqli_query($con, $query);
            $query = "SELECT orders.oID, orders.oType, orders.oPlace, orders.oWhen, orders.oStatus, payment.pID, payment.pMethod, payment.pRef, payment.pStatus, payment.pAmount FROM orders JOIN payment ON orders.pID = payment.pID WHERE orders.oID='$id'";
            $result = mysqli_query($con, $query);
            $row = $result->fetch_assoc();
            $type = $row['oType'];
        }
    ?>
    <header>
        <h2><label for=""><span class="material-symbols-outlined">menu</span></label>Process Order</h2>
        
    </header>
    <div class="main-content">
        <div class="main2">
            <div class="sw">
                <div class="flex-row">
                    <div class="sw">
                        <div class="flex-col">
                        <div class="sw">
                            <div class="flex-row">
                                <div class="sw">
                                    <?php 
                                        echo "
                                        <h3>Order Details</h3>
                                        <h4>Order ID</h4>
                                        <p>".$row['oID']."</p>
                                        <h4>Order Date</h4>
                                        <p>".$row['oPlace']."</p>
                                        <h4>Scheduled Date</h4>
                                        <p>".$row['oWhen']."</p>
                                        <h4>Type</h4>
                                        <p>".$row['oType']."</p>
                                        <h4>Status</h4>
                                        <p class='status-yellow'>".$row['oStatus']."</p>
                                        <h4>Total</h4>
                                        <p>".$row['pAmount']."</p>
                                        ";
                                    ?>
                                    
                                    
                                </div>
                                <div class="sw">
                                <h3>Attached Payment</h3>
                                <?php 
                                    echo "
                                    <h4>Payment ID</h4>
                                    <p>".$row['pID']."</p>
                                    <h4>Payment Method</h4>
                                    <p>".$row['pMethod']."</p>
                                    <h4>Reference Number</h4>
                                    <p>".$row['pRef']."</p>
                                    <h4>Payment Status</h4>
                                    <p>".$row['pStatus']."</p>
                                    <h4>Amount</h4>
                                    <p>".$row['pAmount']."</p>
                                    ";
                                ?>
                                    
                                </div>
                            </div>
                        </div>
                            <div class="sw">
                                <a href="../php/complete-order.php?id=<?php echo $id;?>&type=<?php echo $type;?>" class="goto-btn">Complete</a>
                            </div>
                        </div>
                    </div>
                        <div class="main2">
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