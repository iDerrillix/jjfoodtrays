<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        .approve{
            color: green;
        }
        .decline{
            color: darkred;
        }
    </style>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="../admin/products.css">
    <link rel="stylesheet" href="../table-css.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Payments</title>
</head>
<body>
    <?php
        session_start();
        include '../php/level.php'; 
        include '../admin/sidebar.html';
        require '../php/dbcon.php';

        $query = "SELECT * FROM payment WHERE pStatus='Pending' ORDER BY pTimestamp";
        $result = mysqli_query($con, $query);
    ?>
    <header>
        <h2><label for=""><span class="material-symbols-outlined">menu</span></label>Dashboard</h2>
        
    </header>
    <div class="main-content">
        <div class="main2">
            <div class="flex-row">
                <div class="sw">
                    <h3>Pending Payments</h3>
                    <table class="table-css" width="100%">
                        <thead>
                            <tr>
                                <th>Payment ID</th>
                                <th>Payment Method</th>
                                <th>Reference No.</th>
                                <th>Payment Amount</th>
                                <th>Payment Status</th>
                                <th>Payment Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                while($row = $result->fetch_assoc()){
                                    echo "
                                    <tr>
                                        <td>".$row['pID']."</td>
                                        <td>".$row['pMethod']."</td>
                                        <td>".$row['pRef']."</td>
                                        <td>".$row['pAmount']."</td>
                                        <td><label class='status-yellow'>".$row['pStatus']."</label></td>
                                        <td>".$row['pTimestamp']."</td>
                                        <td><a href='../php/approve-payment.php?id=".$row['pID']."' class='approve'><span class='material-symbols-outlined'>
                                        done
                                        </span></a>
                                            <a href='../php/decline-payment.php?id=".$row['pID']."' class='decline'><span class='material-symbols-outlined'>
                                            close
                                            </span></a>
                                        </td>
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
</body>
</html>