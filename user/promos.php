<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../user/home.css">
    <style>
        .promos{
            margin: 150px auto auto auto;
        }
    </style>
    <link rel="stylesheet" href="../flexbox.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script defer src="../user/app.js"></script>
    <title>Promos | JJ Food Trays</title>
</head>
<body>
    <?php 
        require '../php/dbcon.php';
        include '../user/header.php';
    ?>
    <div class="promos">
    <div class='prod-menu'>
            <div class='heading'>
                <h3>Discounted Products</h3>
            </div>
            <hr>
            <div class='content'>
                <div class='cat-1'>
                <?php 
                    
                    require '../php/dbcon.php';

                    $query = "SELECT products.prod_ID, products.prod_name, products.prod_desc, products.prod_price, products.pImgPath, menu.m_name FROM products JOIN menu ON products.m_cat = menu.m_cat AND products.discounted=1";
                    $query .= "";
                    $result = mysqli_query($con, $query);
                    while($row = $result->fetch_assoc()){
                      echo "<div class='card' style='width: 18rem;'>
                      <img src='../images/".$row['pImgPath']."' class='card-img-top' alt='...'>
                      <div class='card-body'>
                        <h5 class='card-title'>".$row['prod_name']."</h5>
                        <p class='card-text'>".$row['prod_desc']."</p>
                      </div>
                      <div class='card-footer'>
                          Price: ₱".$row['prod_price']."
                          <a href='../php/cart.php?id=".$row['prod_ID']."&qty=1&price=".$row['prod_price']."' class='btn btn-danger'><span class='material-symbols-outlined'>shopping_cart</span>+</a>
                      </div>
                    </div>";
                    }
                    
                ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>