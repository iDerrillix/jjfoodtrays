<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../admin/products.css">
    <link rel="stylesheet" href="../flexbox.css">
    <link rel="stylesheet" href="../table-css.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Deliveries</title>
</head>
<body>
    <?php
        session_start();
        include '../php/verification.php';
        include '../courier/sidebar.html';
        require '../php/dbcon.php';
    ?>
    <header>
        <h2><label for=""><span class="material-symbols-outlined">menu</span></label>View Deliveries</h2>
        
    </header>
    <div class="main-content">
        <div class="main2">
            <div class="flex-row">
                <div class="sw">
                    <h3>Pending Shipments</h3>
                    <table class="table-css" width ="100%">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer Name</th>
                                <th>Customer Address</th>
                                <th>Phone Number</th>
                                <th>Email Address</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $query = "SELECT orders.oID, CONCAT(customers.cFName, ' ', customers.cLName) AS cName, CONCAT(customers.cStreet, ', ',customers.cBrgy, ', ',customers.cCity, ', ',customers.cProv) AS cAddress, customers.cPhone, users.uEmail, payment.pAmount FROM orders JOIN customers ON orders.cID=customers.cID JOIN users ON customers.cID=users.cID JOIN payment ON orders.pID=payment.pID WHERE orders.oStatus='Awaiting Shipment'";
                                $result = mysqli_query($con, $query);
                                while($row = $result->fetch_row()){
                                    echo "<tr>
                                    <td>".$row[0]."</td>
                                    <td>".$row[1]."</td>
                                    <td>".$row[2]."</td>
                                    <td>".$row[3]."</td>
                                    <td>".$row[4]."</td>
                                    <td>".$row[5]."</td>
                                    <td><a href='../courier/process-delivery.php?id=".$row[0]."' class='goto-btn'>Process</a></td>
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