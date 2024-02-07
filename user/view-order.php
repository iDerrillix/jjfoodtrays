<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        .vertical-tbl th, .vertical-tbl td{
            width: fit-content;
            white-space: nowrap;
            padding: 0 15px;
        }
        .limaw{
            margin-top: 20px;
        }
    </style>
    <link rel="stylesheet" href="../user/checkout.css">
<link rel="stylesheet" href="../user/orders.css">
<link rel="stylesheet" href="../user/profile.css">
<link rel="stylesheet" href="../flexbox.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Order | JJ Food Trays</title>
</head>
<body>
<?php
        include 'header.php';
        include '../php/pass.php';
        require '../php/dbcon.php';
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $query = "SELECT * from orders WHERE oID='$id'";
            $result = mysqli_query($con, $query);
            if($result){
                $row = $result->fetch_assoc();
                $status = $row['oStatus'];
            } else {
                header("Location: ../user/error-page.php");
                exit;
            }
        } else {
            header("Location: ../user/error-page.php");
            exit;
        }
        
    ?>
    
    <div class="profile">
        <div class="flex-row">
            <div class="kraezy">
                <h6>Order Details</h6>
                <hr>
                <table width="100%" class="vertical-tbl">
                    <tbody>
                        <tr>
                            <th>Order ID</th>
                            <td><?= $row['oID']; ?></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td><?= $row['oStatus']; ?></td>
                        </tr>
                        <tr>
                            <th>Schedule</th>
                            <td><?= $row['oWhen']; ?></td>
                        </tr>
                        <tr>
                            <th>Ordered At</th>
                            <td><?= $row['oPlace']; ?></td>
                        </tr>
                    </tbody>
                </table>
                <br>
                <h6>Payment Details</h6>
                <hr>
                <table width="100%" class="vertical-tbl">
                    <tbody>
                        <?php 
                            $query = "SELECT * from payment WHERE pID='".$row['pID']."'";
                            $result = mysqli_query($con, $query);
                            if($result){
                                $row = $result->fetch_assoc();
                            } else {
                                header("Location: ../user/error-page.php");
                                exit;
                            }
                        ?>
                        <tr>
                            <th>Payment ID</th>
                            <td><?= $row['pID']; ?></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td><?= $row['pStatus']; ?></td>
                        </tr>
                        <tr>
                            <th>Method</th>
                            <td><?= $row['pMethod']; ?></td>
                        </tr>
                        <tr>
                            <th>Amount</th>
                            <td><?= $row['pAmount']; ?></td>
                        </tr>
                        <tr>
                            <th>pRef</th>
                            <td><?= $row['pRef']; ?></td>
                        </tr>
                        <tr>
                            <th>Paid at</th>
                            <td><?= $row['pTimestamp']; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="sw">
                <h6>Items</h6>
                <hr>
                <?php 
                    $query = "SELECT products.prod_name, order_item.qty from order_item JOIN products ON order_item.prod_ID = products.prod_ID WHERE oID=$id";
                    $result = mysqli_query($con, $query);
                    if($result){
                        while($row = $result->fetch_assoc()){
                            echo "<p>".$row['qty']." ". $row['prod_name']."</p>";
                        }
                    } else {
                        header("Location: ../user/error-page.php");
                        exit;
                    }
                ?>
                
                
            </div>
        </div>
        <div class="limaw">
        <a href="../user/orders.php" class="back">Back</a>
        <?php
         
            if($status == 'Awaiting Fulfillment' || $status == 'Verifying Payment'){
                echo "<a href='../php/cancel-order.php?id=$id' class='submit-btn'>Cancel</a>";
            }
        ?>
        </div>
        
    </div>
</body>
</html>