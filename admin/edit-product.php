<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../admin/products.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
</head>
<body>
    <?php 
        session_start();
        include '../php/level.php';
        include '../admin/sidebar.html';
        include '../php/dbcon.php';
        if(isset($_GET['prod_ID'])){
            $id = $_GET['prod_ID'];
            $query = "SELECT * FROM products WHERE prod_ID='$id'";
            $result = mysqli_query($con, $query);
            $row = $result->fetch_array();
        }else if(isset($_GET['m_cat'])){
            $id = $_GET['m_cat'];
            $query = "SELECT * FROM menu WHERE m_cat='$id'";
            $result = mysqli_query($con, $query);
            $row = $result->fetch_array();
        }
    ?>
    <div class="test">
    <header>
            <h2>
                <label for="">
                    <span class="material-symbols-outlined">menu</span>
            </label>
            Edit Product</h2>
    
        </header>
    </div>
    <div class="main-content">
        <div class="main2" id="prod">
            <div class="flex-row">
                <div class="side1">
                    <div class="s">
                    <form action="../php/update-prod.php" method="POST">
                    <p>Product ID</p>
                    <input type="number" name="prod_ID" id="" readonly class="input-field" value="<?php (isset($_GET['prod_ID']))? printf($row['prod_ID']) : printf("");?>">
                    <p>Product Name</p>
                    <input type="text" name="prod_name" id="" class="input-field" value="<?php (isset($_GET['prod_ID']))? printf($row['prod_name']) : "hehe";?>">
                    <p>Product Description</p>
                    <textarea name="prod_desc" id="" cols="30" rows="10"><?php (isset($_GET['prod_ID']))? printf($row['prod_desc']) : "";?></textarea>
                    </div>  
                    <div class="s">
                        <?php 
                            if(isset($_GET['update']) && $_GET['update'] == 1){
                                echo "<div class='sw'>
                                <div class='notify'>
                                    <p>The system suggests to add a discount (10%) to this product due to its sale's performance</p>
                                    <a href='../php/discount.php?id=".$id."' class='apply-btn'>Apply Discount</a>
                                </div>
                            </div>";
                            } else if(isset($row['discounted']) && $row['discounted'] == 1){
                                echo "<div class='sw'>
                                <div class='notify'>
                                    <p>This product is discounted. Revert back to original price?</p>
                                    <a href='../php/discount.php?id=".$id."&revert=1' class='apply-btn'>Revert</a>
                                </div>
                            </div>";
                            }
                        ?>
                    <p>Product Price</p>
                    <input type="number" name="prod_price" id="" min="1" class="input-field" value="<?php (isset($_GET['prod_ID']))? printf($row['prod_price']) : "";?>">
                    <p>Product Cost</p>
                    <input type="" name="prod_cost" id="" min="1" class="input-field" value="<?php (isset($_GET['prod_ID']))? printf($row['prod_cost']) : "";?>">
                    <p>Product Menu Category</p>
                    <input type="number" name="m_cat" id="" min="1" class="input-field" value="<?php (isset($_GET['prod_ID']))? printf($row['m_cat']) : "";?>">
                    
                    
                    <input type="submit" value="Update" name="edit-product">
                    </form>
                    </div>
                    
                </div>
                <div class="side1">
                    <div class="s">
                    <form action="../php/update-prod.php" method="POST">
                    <p>Menu ID</p>
                    <input type="number" name="m_cat" id="" readonly value="<?php (isset($_GET['m_cat']))? printf($row['m_cat']) : "";?>">
                    <p>Menu Name</p>
                    <input type="text" name="m_name" id="" value="<?php (isset($_GET['m_cat']))? printf($row['m_name']) : "";?>">
                    <input type="submit" value="Update" name="edit-menu">
                    </form>
                    </div>
                    
                </div>
            </div>
            
        </div>
    </div>
    
</body>
</html>