<?php 
    session_start();
    include '../php/level.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="../admin/products.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
</head>
<body>
    <?php 
        include 'sidebar.html';
    ?>
    <div class="test">
    <header>
            <h2>
                <label for="">
                    <span class="material-symbols-outlined">menu</span>
            </label>
            Add Product</h2>
        </header>
    </div>
    <form action="../php/insert-prod.php" method="POST" enctype="multipart/form-data">
    <div class="main-content">
        <div class="main2">
            <div class="flex-row">
                <div class="flex-row">
                    <div class="s">
                        <p>Product Name</p>
                        <input type="text" name="prod_name" id="" class="input-field" required>
                        <p>Product Desc</p>
                        <textarea name="prod_desc" id="" cols="30" rows="10"></textarea required>
                        <p>Product Menu Category</p>
                        <input type="number" name="m_cat" id="" min="1" class="input-field" required>
                        <p>Product Image</p>
                        <input type="file" name="image" id="" required accept=".jpeg,.png,.jpg">
                    </div>
                    <div class="s">
                        <p>Product Selling Price</p>
                        <input type="number" name="prod_price" id="" min="1" class="input-field" required>
                        <p>Product Total Production Cost</p>
                        <input type="number" name="prod_cost" id="" min="1" class="input-field" required>
                        <p>Fixed Cost</p>
                        <input type="number" name="fixed_cost" id="" min="1" class="input-field" required>
                        <p>Month Planned Sales</p>
                        <input type="number" name="planned_sales" id="" min="1" class="input-field" required>
                        <p>Target Sales Increase per Month (%)</p>
                        <input type="number" name="target_sales" id="" min="1" max="100"class="input-field" required>
                        <input type="submit" value="Add Product" name="add-prod">
                    </div>
                </div>
                <div class="statement">
                    <h3>Projected Income Statement</h3>
                    <table class="projected-tbl">
                        <thead>
                            <tr>
                                <th>Month</th>
                                <th>Sales</th>
                                <th>Variable Cost</th>
                                <th>Contribution Margin</th>
                                <th>Fixed Cost</th>
                                <th>Net Income</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                if(isset($_SESSION['sales'])){
                                    $sales = $_SESSION['sales'];
                                    $target = $_SESSION['target'] / 100;
                                    $price = $_SESSION['price'];
                                    $cost = $_SESSION['cost'];
                                    $fixed_cost = $_SESSION['fixed_cost'];


                                    $month = array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
                                    for($i = 0; $i < 12; $i++){
                                        if($i == 0){
                                            $totalsales = $price * $sales;
                                            $variablecosts = $sales * $cost;
                                            $contrimargin = $totalsales - $variablecosts;
                                            $netincome = $contrimargin - $fixed_cost;
                                        } else {
                                            $totalsales = $totalsales + ($totalsales * $target);
                                            $variablecosts = $variablecosts + ($variablecosts * $target);
                                            $contrimargin = $totalsales - $variablecosts;
                                            $netincome = $contrimargin - $fixed_cost;
                                        }
                                        echo "<tr>
                                        <td>$month[$i]</td>
                                        <td>".number_format($totalsales, 2)."</td>
                                        <td>".number_format($variablecosts, 2)."</td>
                                        <td>".number_format($contrimargin, 2)."</td>
                                        <td>".number_format($fixed_cost, 2)."</td>
                                        <td>".number_format($netincome, 2)."</td>
                                        </tr>";
                                    }

                                    unset($_SESSION['sales']);
                                    unset($_SESSION['target']);
                                    unset($_SESSION['price']);
                                    unset($_SESSION['cost']);
                                    unset($_SESSION['fixed_cost']);
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </form>
</body>
</html>