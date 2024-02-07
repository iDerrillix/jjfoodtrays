<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        .view{
            color: green;
            transition: color 0.5s;
        }
        .cancel{
            transition: color 0.5s;
            color: red;
        }
        .view :hover{
            color: lightgreen;
        }
        .cancel :hover{
            color: lightcoral;
        }
    </style>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../table-css.css">
    <link rel="stylesheet" href="../user/orders.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../user/profile.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>My Orders | JJ Food Trays</title>
</head>
<body>
    <?php
        include 'header.php';
        include '../php/pass.php';
        require '../php/dbcon.php';
        if(isset($_GET['filter'])){
            $filter = $_GET['filter'];
            if($filter == 'all'){
                $query = "SELECT * from orders WHERE cID='$id'";
            } else if($filter == 'pending'){
                $query = "SELECT * from orders WHERE cID='$id' AND oStatus IN ('Verifying Payment', 'Awaiting Fulfillment', 'Processing', 'Awaiting Shipment', 'Awaiting Pickup', 'Shipping')";
            } else if ($filter == 'completed'){
                $query = "SELECT * from orders WHERE cID='$id' AND oStatus='Completed'";
            } else {
                $query = "SELECT * from orders WHERE cID='$id' AND oStatus IN ('Verifying Payment', 'Awaiting Fulfillment', 'Processing')";
            }
        } else {
            $query = "SELECT * from orders WHERE cID='$id' AND oStatus IN ('Verifying Payment', 'Awaiting Fulfillment', 'Processing')";
        }
        $result = mysqli_query($con, $query);
        
    ?>
    
    <div class="profile">
        <div class="view-options">
            <a href="../user/profile.php" class="view-btn">Profile</a>
            <a href="../user/orders.php" class="view-btn" id="orders-btn">Orders</a>
        </div>
        <hr>
        <div class="orders-container">
            <div class="all-orders">
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    Filter By
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="../user/orders.php?filter=all">All Orders</a></li>
                    <li><a class="dropdown-item" href="../user/orders.php?filter=pending">Pending</a></li>
                    <li><a class="dropdown-item" href="../user/orders.php?filter=completed">Completed</a></li>
                </ul>
                </div>
                <table class="table-css">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Order Type</th>
                            <th>Schedule For</th>
                            <th>Ordered At</th>
                            <th>Payment ID</th>
                            <th>Order Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        
                        while($row = $result->fetch_assoc()){
                            if(isset($filter) && $filter == 'pending'){
                                echo "<tr>
                                    <td>".$row['oID']."</td>
                                    <td>".$row['oType']."</td>
                                    <td>".$row['oWhen']."</td>
                                    <td>".$row['oPlace']."</td>
                                    <td>".$row['pID']."</td>
                                    <td>".$row['oStatus']."</td>
                                    <td><a class='view' href='../user/view-order.php?id=".$row['oID']."'><span class='material-symbols-outlined'>visibility</span></a><a href='../php/cancel-order.php?id=".$row['oID']."' class='cancel'><span class='material-symbols-outlined'>cancel</span></a></td>
                                </tr>";
                            } else {
                                echo "<tr>
                                    <td>".$row['oID']."</td>
                                    <td>".$row['oType']."</td>
                                    <td>".$row['oWhen']."</td>
                                    <td>".$row['oPlace']."</td>
                                    <td>".$row['pID']."</td>
                                    <td>".$row['oStatus']."</td>
                                    <td><a class='view' href='../user/view-order.php?id=".$row['oID']."'><span class='material-symbols-outlined'>visibility</span></a></td>
                                </tr>";
                            }
                            
                        }
                        ?>
                    </tbody>
                    
                </table>
            </div>
            
        </div>
    </div>
</body>
</html>