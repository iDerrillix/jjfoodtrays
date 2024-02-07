<?php 
    session_start();
    require '../php/dbcon.php';
    if(isset($_POST['add-prod'])){
        $prod_name = $_POST['prod_name'];
        $prod_desc = $_POST['prod_desc'];
        $m_cat = $_POST['m_cat'];
        $prod_price = $_POST['prod_price'];
        $prod_cost = $_POST['prod_cost'];
        $sales = $_POST['planned_sales'];
        $target = $_POST['target_sales'];
        $fixedcost = $_POST['fixed_cost'];

        $file = $_FILES['image'];
        $fileName = $_FILES['image']['name'];
        $fileTmpName = $_FILES['image']['tmp_name'];
        $fileSize = $_FILES['image']['size'];
        $fileType = $_FILES['image']['type'];
        $fileError = $_FILES['image']['error'];

        
        $fileExt = strtolower(end(explode('.', $fileName)));

        $allowed = array('jpg', 'jpeg', 'png');

        $fileDestination = '../images/'.$fileName;
        move_uploaded_file($fileTmpName, $fileDestination);

        



        $query = "INSERT INTO products (prod_name, prod_desc, prod_price, prod_cost, m_cat, pImgPath) VALUES ('$prod_name', '$prod_desc', '$prod_price', '$prod_cost', '$m_cat', '$fileName');";
        $result = mysqli_query($con, $query);
        if($result){
            $_SESSION['sales'] = $sales;
            $_SESSION['target'] = $target;
            $_SESSION['price'] = $prod_price;
            $_SESSION['cost'] = $prod_cost;
            $_SESSION['fixed_cost'] = $fixedcost;
            header("Location: ../admin/add-product.php");
            exit();
        }
    }
?>