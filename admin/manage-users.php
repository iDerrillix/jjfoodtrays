<!DOCTYPE html>
<html lang="en">
<head>
    
    <link rel="stylesheet" href="../table-css.css">
    <link rel="stylesheet" href="../admin/products.css">
    <link rel="stylesheet" href="../flexboxx.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
</head>
<body>
    <?php
        session_start();
        include '../php/level.php';
        include 'sidebar.html';
        require '../php/dbcon.php';

    ?>
    <header>
            <h2>
                <label for="">
                    <span class="material-symbols-outlined">menu</span>
            </label>
            Manage Users</h2>
     
        </div>
        </header>
    <div class="main-content">
        <div class="main2">
            <div class="flex-row">
            <div class="sw">
                <div class="flex-row">
                    <div class="sw">
                        <h3>Administrators</h3>
                    </div>
                    <div class="sw"><button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-modal">Add Admin</button></div>
                </div>
                <hr>
                <table class="table-css" width="100%">
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>User Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $query = "SELECT uID, uEmail, uType FROM users WHERE uType=1";
                            $result = mysqli_query($con, $query);
                            while($row = $result->fetch_assoc()){
                                echo "<tr>
                                <td>".$row['uID']."</td>
                                <td>".$row['uEmail']."</td>
                            </tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="sw">
                <div class="flex-row">
                    <div class="sw">
                        <h3>Couriers</h3>
                    </div>
                    <div class="sw"><button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-modal2">Add Courier</button></div>
                </div>
                <hr>
                <table class="table-css" width="100%">
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>User Email</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $query = "SELECT uID, uEmail, uType FROM users WHERE uType=3";
                        $result = mysqli_query($con, $query);
                        while($row = $result->fetch_assoc()){
                            echo "<tr>
                            <td>".$row['uID']."</td>
                            <td>".$row['uEmail']."</td>
                        </tr>";
                        }
                    ?>
                    </tbody>
                </table>
            </div>
            </div>
            
        </div>
    </div>
    <!-- modals -->
    <div class="modal fade" id="add-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Administrator</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="../php/add-user.php" method="POST">
                <div class="modal-body">
                    <label for="uEmail">Email Address: </label>
                    <br>
                    <input type="email" name="uEmail" id="" required placeholder="e.g. name@email.com" size="50px">
                    <br>
                    <label for="uPswd">Password: </label>
                    <br>
                    <input type="password" name="uPswd" id="" required placeholder="" size="50px">
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="add-admin">Add</button>
                </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="add-modal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Courier</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="../php/add-user.php" method="POST">
                <div class="modal-body">
                    <label for="uEmail">Email Address: </label>
                    <br>
                    <input type="email" name="uEmail" id="" required placeholder="e.g. name@email.com" size="50px">
                    <br>
                    <label for="uPswd">Password: </label>
                    <br>
                    <input type="password" name="uPswd" id="" required placeholder="" size="50px">
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="add-courier">Add</button>
                </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>