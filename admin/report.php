<!DOCTYPE html>
<html lang="en">
<head>

    <link rel="stylesheet" href="../table-css.css">
    <link rel="stylesheet" href="../flexbox.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Report</title>
    <link rel="stylesheet" href="report.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <?php
        session_start();
        include '../php/level.php'; 
      include 'sidebar.html';
      include '../php/dbcon.php';

      if(isset($_GET['timeframe'])){
        $timeframe = $_GET['timeframe'];
        if($timeframe == 'day'){
            $range = -1;
        } else if($timeframe == 'week'){
            $range = -7;
        } else if ($timeframe == 'month'){
            $range = -30;
        } else if ($timeframe == 'year'){
            $range = -365;
        } else {
            $range = -30;
        }
      } else {
        $range = -30;
      }
    ?>
    <div class="main-content">
        <header>
            <h2>
                <label for="">
                    <span class="material-symbols-outlined">menu</span>
            </label>
            Sales Report</h2>
     
        </header>
     <main>
        <div class="timeframe">
        <a href="../admin/report.php?timeframe=day">Daily</a>
            <a href="../admin/report.php?timeframe=week">Weekly</a>
            <a href="../admin/report.php?timeframe=month">Monthly</a>
            <a href="../admin/report.php?timeframe=year">Yearly</a>
        </div>
     <div class="cards">
            <div class="card-single">
                <div>
                <?php 
                        $query = "SELECT SUM(payment.pAmount) FROM payment JOIN orders ON orders.pID=payment.pID WHERE orders.oStatus='Completed' AND DATEDIFF(orders.oPlace, CURRENT_DATE) BETWEEN $range AND 0;";
                        $result = mysqli_query($con, $query);
                        $row = $result->fetch_row();
                        echo "<h1>₱".$row[0]."</h1>"
                    ?>
                    <span>Revenue</span>
                </div>
                <div>
                    <span class="material-icons">
                    paid
                    </span>
                </div>
                
            </div>
            <div class="card-single">
                <div>
                <?php 
                        $query = "SELECT SUM(products.prod_cost * order_item.qty) FROM products JOIN order_item ON order_item.prod_ID=products.prod_ID JOIN orders ON order_item.oID=orders.oID WHERE orders.oStatus='Completed' AND DATEDIFF(orders.oPlace, CURRENT_DATE) BETWEEN $range AND 0;";
                        $result = mysqli_query($con, $query);
                        $row = $result->fetch_row();
                        echo "<h1>₱".$row[0]."</h1>"
                    ?>
                    <span>Costs</span>
                </div>
                <div>
                <span class="material-icons">money_off</span>
                </div>
            </div>
            <div class="card-single">
                <div>
                <?php 
                        $query = "SELECT (SELECT SUM(payment.pAmount) FROM payment JOIN orders ON orders.pID=payment.pID WHERE orders.oStatus='Completed' AND DATEDIFF(orders.oPlace, CURRENT_DATE) BETWEEN $range AND 0) - (SELECT SUM(products.prod_cost * order_item.qty) FROM products JOIN order_item ON order_item.prod_ID=products.prod_ID JOIN orders ON order_item.oID=orders.oID WHERE orders.oStatus='Completed' AND DATEDIFF(orders.oPlace, CURRENT_DATE) BETWEEN $range AND 0);";
                        $result = mysqli_query($con, $query);
                        $row = $result->fetch_row();
                        echo "<h1>₱".$row[0]."</h1>"
                    ?>
                    <span>Profit</span>
                </div>
                <div>
                    <span class="material-icons">savings</span>
                </div>
            </div>
            <div class="card-single">
                <div>
                <?php 
                        $query = "SELECT COUNT(oID) FROM orders WHERE oStatus='Completed' AND DATEDIFF(oPlace, CURRENT_DATE) BETWEEN $range AND 0;";
                        $result = mysqli_query($con, $query);
                        $row = $result->fetch_row();
                        echo "<h1>".$row[0]."</h1>"
                    ?>
                    <span>Total Sales</span>
                </div>
                <div>
                <span class="material-icons">point_of_sale</span>
                </div>
                
            </div>
        </div>
        <div class="container">
        <div class="flex-row">
            <div class="container">
                <div class="variable-pricing">
                    <h2>Best Selling Products</h2>
                    <table width="100%" class="table-css">
                        <thead>
                            <tr>
                                <td>Product Name</td>
                                <td>Sales</td>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $query = "SELECT products.prod_name, SUM(qty) FROM order_item JOIN products ON order_item.prod_ID = products.prod_ID JOIN orders ON orders.oID = order_item.oID WHERE orders.oStatus='Completed' AND DATEDIFF(orders.oPlace, CURRENT_DATE) BETWEEN $range AND 0 GROUP BY products.prod_name ORDER BY SUM(qty) DESC LIMIT 3;";
                                $result = mysqli_query($con, $query);
                                while($row = $result->fetch_assoc()){
                                    echo "<tr>
                                    <td>".$row['prod_name']."</td>
                                    <td>".$row['SUM(qty)']."</td>
                                </tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="container">
                <div class="variable-pricing">
                    <h2>Price Update Suggestion</h2>
                    <table width="100%" class="table-css">
                        <thead>
                            <tr>
                                <th>Product ID</th>
                                <th>Product Name</th>
                                <th>Sales</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $query = "SELECT products.prod_ID, products.prod_name, SUM(qty) FROM order_item JOIN products ON order_item.prod_ID = products.prod_ID JOIN orders ON order_item.oID = orders.oID WHERE orders.oStatus='Completed' AND products.discounted='0' AND DATEDIFF(orders.oPlace, CURRENT_DATE) BETWEEN $range AND 0 GROUP BY products.prod_name ORDER BY SUM(qty) LIMIT 3;";
                                $result = mysqli_query($con, $query);
                                while($row = $result->fetch_assoc()){
                                    echo "<tr>
                                        <td>".$row['prod_ID']."</td>
                                        <td>".$row['prod_name']."</td>
                                        <td>".$row['SUM(qty)']."</td>
                                        <td><a href='../admin/edit-product.php?prod_ID=".$row['prod_ID']."&update=1'>Update</a></td>
                                    </tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>        
            </div>
            <div class="container">
                <div class="variable-pricing">
                    <div class="sw">
                        <h3>Completed Orders</h3>
                        <table class="table-css">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Payment Method</th>
                                    <th>Order Date</th>
                                    <th>Scheduled Date</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                $query = "SELECT orders.oID, payment.pMethod, orders.oPlace, orders.oWhen, orders.oStatus, payment.pAmount FROM orders JOIN payment on orders.pID = payment.pID WHERE orders.oStatus='Completed' AND DATEDIFF(orders.oPlace, CURRENT_DATE) BETWEEN $range AND 0 ORDER BY orders.oPlace DESC;";
                                $result = mysqli_query($con, $query);
                                while($row = $result->fetch_assoc()){
                                    echo "<tr>
                                    <td>".$row['oID']."</td>
                                    <td>".$row['pMethod']."</td>
                                    <td>".$row['oPlace']."</td>
                                    <td>".$row['oWhen']."</td>
                                    <td>".$row['oStatus']."</td>
                                    <td>".$row['pAmount']."</td>
                                    </tr>";
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
       <div class="recent-flex">
        <div class="projects">
            <div class="card">
                
                
            </div>
        </div>
        
        <div class="customer">

        </div>
       </div>
     </main>
    </div>
</body>
</html>