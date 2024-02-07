<?php
    session_start();
    include '../php/verification.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="header.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="navb">
        <div class="navb-logo">
            <img src="../images/logotrans.png" alt="">
        </div>
        <a href="" class="toggle-button">
            <span class="material-symbols-outlined">menu</span>
        </a>
        <div class="navb-items">
            <ul>
                <li>
                    <a href="home.php"><span class="material-symbols-outlined">home</span>Home</a>
                    <a href="../user/reviews.php"><span class="material-symbols-outlined">thumbs_up_down</span>Reviews</a>
                    <a href="../user/about.php"><span class="material-symbols-outlined">contact_page</span>About</a>
                    <a href="../user/promos.php"><span class="material-symbols-outlined">contact_phone</span>Promos</a>
                </li>
            </ul>
        </div>
        <div class="navb-func">
            <ul>
                <li>
                    <a href="profile.php"><span class="material-symbols-outlined">account_circle</span>User</a>
                    <a href="cart-details.php"><span class="material-symbols-outlined">shopping_cart</span>Cart</a>
                    <a href="../php/logout.php" class="login-btn"><span class="material-symbols-outlined">logout</span>Logout</a>
                </li>
            </ul>
        </div>
    </div>
</body>
</html>