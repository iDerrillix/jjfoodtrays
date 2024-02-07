<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../admin/products.css">
    <link rel="stylesheet" href="../table-css.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Orders</title>
</head>
<body>
    <?php
        session_start();
        include '../php/level.php'; 
        include '../admin/sidebar.html';
        require '../php/dbcon.php';
    ?>
    <header>
        <h2><label for=""><span class="material-symbols-outlined">menu</span></label>View Orders</h2>
        
    </header>
    <div class="main-content">
        <div class="main2">
            <div class="flex-row">
                <div class="sw">
                    <h3>Pending Orders</h3>
                    <table class="table-css" width ="100%">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Payment Method</th>
                                <th>Order Date</th>
                                <th>Scheduled Date</th>
                                <th>Status</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $query = "SELECT orders.oID, payment.pMethod, orders.oPlace, orders.oWhen, orders.oStatus, payment.pAmount FROM orders JOIN payment ON orders.pID = payment.pID WHERE orders.oStatus='Awaiting Fulfillment' OR orders.oStatus='Processing'";
                                $result = mysqli_query($con, $query);
                                while($row = $result->fetch_assoc()){
                                    echo "<tr>
                                    <td>".$row['oID']."</td>
                                    <td>".$row['pMethod']."</td>
                                    <td>".$row['oPlace']."</td>
                                    <td>".$row['oWhen']."</td>
                                    <td><label class='status-yellow'>".$row['oStatus']."</label></td>
                                    <td>".$row['pAmount']."</td>
                                    <td><a href='../admin/process-order.php?id=".$row['oID']."' class='goto-btn'>Process</a></td>
                                </tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>
</html>