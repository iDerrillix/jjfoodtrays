<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        .auto-container{
            background-color: white;
            margin-top: 150px;
            display: flex;
            width: 400px;
            padding: 20px;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-left: auto;
            margin-right: auto;
            height: 400px;
            border-radius: 10px;
            box-shadow: 2px 2px 5px rgba(0,0,0,0.2);
        }
        .red-btn{
            width: 300px;
            background-color: #d92424;
            color: white;
            font-weight: bold;
            border: none;
            border-radius: 10px;
            padding: 10px 0px 10px 0px;
            transition: background 0.5s color 0.5s;
            text-decoration: none;
            text-align: center;
        }
        .red-btn:hover{
            background-color: #7C0F0F;
            color: white;
        }
    </style>
    <link rel="stylesheet" href="../flexbox.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>
</head>
<body>
    <?php
        include '../user/header.php';
        include '../php/verification.php';
    ?>
    <div class="auto-container">
        <h1><strong>Oops..</strong></h1>
        <br>
        <p>The page you are looking for does not exist</p>
        <p>or an unexpected error has occured.</p>
        <br>
        <br>
        <a href="../user/home.php" class="red-btn">Back to Home</a>
    </div>
</body>
</html>