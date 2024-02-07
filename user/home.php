<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="home.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | JJ Food Trays</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script
    src="https://code.jquery.com/jquery-3.6.3.min.js"
    integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU="
    crossorigin="anonymous"></script>
    <script defer src="../user/app.js"></script>
    <script>
      function add_to_cart(d){
        var prod_ID = d.getAttribute("data-id");
        var prod_price = d.getAttribute("data-price")
        $.ajax({
          type:'POST',
          url: '../php/cart.php',
          data: 'id=' + prod_ID + '&qty=' + 1 + '&price=' + prod_price,
          success:function(result){
            if(result == 1){
              alert("Item added to cart");
              console.log(prod_ID);
            } else {
              alert("Failed");
              console.log(prod_ID);
              console.log(prod_price);
            }
          },
          error: function(xhr, status, error) {
              alert(error);
          }
        })
      };
      $(document).ready(function (){
        
      });
    </script>
    
</head>
<body>
    <?php 
    include 'header.php';
    ?>
    <div class="all-cont">
        <div class="side-bar">
          <h6>MENU</h6>
          <ul>
            <li>
              <button>All Products</button>
            </li>
            <li>
              <button>Recommended</button>
            </li>
            <li>
              <button>Bilao Bundles</button>
            </li>
            <li>
              <button>Bilao Orders</button>
            </li>
          </ul>
        </div>
        <div class="main-cont">
        <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="../images/test.png" class="d-block w-100" alt="..." id="showcase-img">
                <div class="carousel-caption d-none d-md-block">
                    <h5></h5>
                    <p></p>
                  </div>
              </div>
              <div class="carousel-item">
                <img src="../images/test.png" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5></h5>
                    <p></p>
                  </div>
              </div>
              <div class="carousel-item">
                <img src="../images/test.png" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5></h5>
                    <p></p>
                  </div>
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
          <div class='prod-menu'>
            <div class='heading'>
                <h5>Recommended</h5>
            </div>
            <div class='content'>
                <div class='cat-1'>
                <?php 
                    
                    require '../php/dbcon.php';

                    $query = "(SELECT products.prod_ID, products.prod_name, products.prod_desc, products.prod_price, products.pImgPath FROM order_item JOIN products ON order_item.prod_ID = products.prod_ID WHERE products.m_cat=(SELECT products.m_cat FROM order_item JOIN products ON order_item.prod_ID = products.prod_ID GROUP BY products.m_cat ORDER BY SUM(order_item.qty) DESC LIMIT 1) GROUP BY products.prod_name ORDER BY SUM(order_item.qty) DESC LIMIT 3) UNION (SELECT order_item.prod_ID, products.prod_name, products.prod_desc, products.prod_price, products.pImgPath FROM order_item JOIN orders ON order_item.oID = orders.oID JOIN products ON order_item.prod_ID = products.prod_ID WHERE orders.cID = 1 GROUP BY order_item.prod_ID ORDER BY SUM(order_item.qty) DESC LIMIT 3) UNION (SELECT order_item.prod_ID, products.prod_name, products.prod_desc, products.prod_price, products.pImgPath FROM order_item JOIN products ON order_item.prod_ID = products.prod_ID WHERE oID=(SELECT orders.oID FROM orders ORDER BY orders.oPlace DESC LIMIT 1));";
                    $query .= "";
                    $result = mysqli_query($con, $query);
                    while($row = $result->fetch_assoc()){
                      echo "<div class='card' style='width: 18rem;'>
                      <img src='../images/".$row['pImgPath']."' class='card-img-top' alt='...'>
                      <div class='card-body'>
                        <h6 class='card-title'>".$row['prod_name']."</h6>
                        <hr>
                        <p class='card-text'>".$row['prod_desc']."</p>
                      </div>
                      <div class='card-footer'>
                          ₱".$row['prod_price']."
                          <a  class='btn btn-danger' id='add_to_cart' data-id='".$row['prod_ID']."' data-price='".$row['prod_price']."' onclick='add_to_cart(this);'><span class='material-symbols-outlined'>shopping_cart</span>+</a>
                      </div>
                    </div>";
                    }
                    
                ?>
                </div>
            </div>
        </div>
        <div class='prod-menu'>
            <div class='heading'>
                <h5>Bilao Bundles</h5>
            </div>
            <div class='content'>
                <div class='cat-1'>
                <?php 
                    
                    require '../php/dbcon.php';

                    $query = "SELECT products.prod_ID, products.prod_name, products.prod_desc, products.prod_price, products.pImgPath, menu.m_name FROM products JOIN menu ON products.m_cat = menu.m_cat AND products.m_cat=1";
                    $result = mysqli_query($con, $query);
                    while($row = $result->fetch_assoc()){
                      echo "<div class='card' style='width: 18rem;'>
                      <img src='../images/".$row['pImgPath']."' class='card-img-top' alt='...'>
                      <div class='card-body'>
                        <h6 class='card-title'>".$row['prod_name']."</h6>
                        <hr>
                        <p class='card-text'>".$row['prod_desc']."</p>
                      </div>
                      <div class='card-footer'>
                          ₱".$row['prod_price']."
                          <a  class='btn btn-danger' id='add_to_cart' data-id='".$row['prod_ID']."' data-price='".$row['prod_price']."' onclick='add_to_cart(this);'><span class='material-symbols-outlined'>shopping_cart</span>+</a>
                      </div>
                    </div>";
                    }
                ?>
                </div>
            </div>
        </div>
        <div class="prod-menu">
            <div class="heading">
                <h5>Bilao Orders</h5>
            </div>
            <div class="content">
                <div class="cat-1">
                  <?php 
                    $query = "SELECT products.prod_ID, products.prod_name, products.prod_desc, products.prod_price, products.pImgPath, menu.m_name FROM products JOIN menu ON products.m_cat = menu.m_cat AND products.m_cat=2";
                    $result = mysqli_query($con, $query);
                    while($row = $result->fetch_assoc()){
                      echo "<div class='card' style='width: 18rem;'>
                      <img src='../images/".$row['pImgPath']."' class='card-img-top' alt='...'>
                      <div class='card-body'>
                        <h6 class='card-title'>".$row['prod_name']."</h6>
                        <hr>
                        <p class='card-text'>".$row['prod_desc']."</p>
                      </div>
                      <div class='card-footer'>
                          ₱".$row['prod_price']."
                          <a  class='btn btn-danger' id='add_to_cart' data-id='".$row['prod_ID']."' data-price='".$row['prod_price']."' onclick='add_to_cart(this);'><span class='material-symbols-outlined'>shopping_cart</span>+</a>
                      </div>
                    </div>";
                    }
                  ?>
                </div>
            </div>
        </div>
        </div>
        
        
    </div>
    

    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <?php 
      include '../user/footer.html';
    ?>
</body>
</html>