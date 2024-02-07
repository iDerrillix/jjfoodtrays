<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../table-css.css">
    <link rel="stylesheet" href="../admin/products.css">
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Products</title>
</head>
<body>
    <?php
        session_start();
        include '../php/level.php'; 
        include '../admin/sidebar.html';
        
    ?>
    <div class="test">
    <header>
            <h2>
                <label for="">
                    <span class="material-symbols-outlined">menu</span>
            </label>
            Product Management</h2>
     
        </header>
    </div>
    
    <div class="main-content">
        <div class="main2">
            <div class="products-panel">
                <h3>Products</h3>
                <a href="../admin/add-product.php" class="button-24">New Product</a>
                <br>
                <table class="projected-tbl">
                    <thead>
                        <tr>
                            <th>Product ID</th>
                            <th>Product Name</th>
                            <th>Product Desc</th>
                            <th>Product Price</th>
                            <th>Product Cost</th>
                            <th>Product Category</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php 
                                require '../php/dbcon.php';
                                $query = "SELECT * FROM products";
                                $result = mysqli_query($con, $query);
                                while($row = $result->fetch_assoc()){
                                    echo "<tr>
                                    <td>".$row['prod_ID']."</td>
                                    <td>".$row['prod_name']."</td>
                                    <td>".$row['prod_desc']."</td>
                                    <td>".$row['prod_price']."</td>
                                    <td>".$row['prod_cost']."</td>
                                    <td>".$row['m_cat']."</td>
                                    <td><a href='../admin/edit-product.php?prod_ID=".$row['prod_ID']."' class='btn-edit'><span class='material-symbols-outlined'>
                                    edit
                                    </span></a><a href='../php/remove-product.php?prod_ID=".$row['prod_ID']."' class='btn-remove'><span class='material-symbols-outlined'>
                                    delete
                                    </span></a></td>
                                    </tr>";
                                }
                            ?>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="menu-panel">
                <h3>Menu Categories</h3>
                <a data-bs-toggle="modal" data-bs-target="#add-menu" class="button-24">New Category</a>
                <br>
                <table class="table-css" width="100%">
                    <thead>
                        <tr>
                            <th>Menu Category</th>
                            <th>Menu Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php 
                                require '../php/dbcon.php';
                                $query = "SELECT * FROM menu";
                                $result = mysqli_query($con, $query);
                                while($row = $result->fetch_assoc()){
                                    echo "<tr>
                                    <td>".$row['m_cat']."</td>
                                    <td>".$row['m_name']."</td>
                                    <td><a href='../admin/edit-product.php?m_cat=".$row['m_cat']."' class='btn-edit'><span class='material-symbols-outlined'>
                                    edit
                                    </span></a><a href='../php/remove-menu.php?id=".$row['m_cat']."' class='btn-remove'><span class='material-symbols-outlined'>
                                    delete
                                    </span></a></td>
                                    </tr>";
                                }
                            ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    <!-- <h6>Product ID</h6>
    <h6>Product Name</h6>
    <h6>Product Description</h6>
    <h6>Product Price</h6>
    <h6>Product Cost</h6>
    <h6>Product Menu Category</h6> -->
    </div>
    <div class="modal fade" id="add-menu" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="../php/add-menu.php" method="POST">
                <div class="modal-body">
                    <label for="m_name">Menu Category Name: </label>
                    <br>
                    <input type="text" name="m_name" id="" required size="50px">
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="add-menu">Add</button>
                </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>