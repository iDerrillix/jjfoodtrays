
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="../table-css.css">
</head>
<body>
    <?php
        session_start();
        include 'sidebar.html';
        require '../php/dbcon.php';
        include '../php/level.php';

        $query = "SELECT COUNT(cID) FROM customers;"
    ?>
    <div class="main-content">
        <header>
            <h2>
                <label for="">
                    <span class="material-symbols-outlined">menu</span>
            </label>
            Dashboard</h2>
     
        </header>
     <main>
        <div class="cards">
            <div class="card-single">
                <div>
                    <?php 
                        $query = "SELECT COUNT(cID) FROM customers;";
                        $result = mysqli_query($con, $query);
                        $row = $result->fetch_row();
                        echo "<h1>".$row[0]."</h1>"
                    ?>
                    <span>Customers</span>
                </div>
                <div>
                    <span class="material-icons">
                    people_alt
                    </span>
                </div>
            </div>
            <div class="card-single">
                <div>
                <?php 
                        $query = "SELECT COUNT(pID) FROM payment;";
                        $result = mysqli_query($con, $query);
                        $row = $result->fetch_row();
                        echo "<h1>".$row[0]."</h1>"
                    ?>
                    <span>Payments</span>
                </div>
                <div>
                    <span class="material-icons">
                    payments
                    </span>
                </div>
                
            </div>
            <div class="card-single">
                <div>
                <?php 
                        $query = "SELECT COUNT(oID) FROM orders";
                        $result = mysqli_query($con, $query);
                        $row = $result->fetch_row();
                        echo "<h1>".$row[0]."</h1>"
                    ?>
                    <span>Orders</span>
                </div>
                <div>
                    <span class="material-symbols-outlined">shopping_cart</span>
                </div>
            </div>
            <div class="card-single">
                <div>
                    <?php 
                        $query = "SELECT COUNT(oID) FROM orders WHERE oStatus='Completed';";
                        $result = mysqli_query($con, $query);
                        $row = $result->fetch_row();
                        echo "<h1>".$row[0]."</h1>"
                    ?>
                    <span>Sales</span>
                </div>
                <div>
                    <span class="material-symbols-outlined">monetization_on</span>
                </div>
                
            </div>
        </div>
       <div class="container">
       <div class="recent-flex">
        <div class="projects">
            <div class="card">
                <div class="card-header">
                    <h2>Recent Orders</h2>
                    <a href="">View All</a>
                </div>
                <div class="card-body">
                    <table class="table-css" width="100%">
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
                                $query = "SELECT orders.oID, payment.pMethod, orders.oPlace, orders.oWhen, orders.oStatus, payment.pAmount FROM orders JOIN payment on orders.pID = payment.pID ORDER BY orders.oPlace DESC LIMIT 10;";
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
       <div class="recent-flex">
        <div class="projects">
            <div class="card">
                <div class="card-header">
                    <h2>Reviews</h2>
                </div>
                <div class="card-body">
                <table class="table-css" width="100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Rating</th>
                                <th>Message</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $query = "SELECT CONCAT(customers.cFName, ' ', customers.cLName), rRating, rMsg FROM reviews JOIN customers ON reviews.cID = customers.cID";
                                $result = mysqli_query($con, $query);
                                while($row = $result->fetch_row()){
                                    echo "<tr><td>".$row[0]."</td>
                                <td>".$row[1]."</td>
                                <td>".$row[2]."</td></tr>";
                                }

                                
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
       </div>
       </div>
     </main>
    </div>
</body>
</html>