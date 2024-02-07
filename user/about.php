<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        .main-cont{
            padding: 0px 250px 0px 250px;
            background-color: #560d0d;
        }
        .about{
            margin: 100px auto auto auto;
            border-radius: 10px;
            color: white;
            max-width: 800px;
            width: fit-content;
            padding: 50px;
            word-break: normal;
            overflow-wrap: break-word;
        }
        .locate-us{
            margin: 100px auto auto auto;
            border-radius: 10px;
            max-width: 800px;
            width: fit-content;
            padding: 50px;
            color: white;
            word-break: normal;
            overflow-wrap: break-word;
        }
    </style>
    <link rel="stylesheet" href="../flexbox.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About | JJ Food Trays</title>
</head>
<body>
    <?php
        include '../user/header.php';
    ?>
    <div class="main-cont">
        <div class="flex-row">
            <div class="about">
                <div class="sw">
                <h3><strong>About Us</strong></h3>
                <p>JJ Food Trays is a start-up business that was recently started back in 2019. We are a team of passionate food lovers who believe in preserving and promoting the rich culinary heritage of the Philippines. Our mission is to bring a taste of the Philippines to food lovers around the world and to introduce them to the unique flavors and traditions of Filipino cuisine.</p>
                <p>We offer a wide range of traditional Filipino dishes made from only the freshest ingredients and cooked with the same care and love that goes into every home-cooked meal. From the savory pancit bihon and juicy friend chicken to the sweet and sticky kutsinta, we have something for everyone.</p>
                <p>Our menu showcases the best of what Filipino cuisine has to offer, and we are committed to providing our customers with an authentic and memorable dining experience. Whether you're a first-time visitor or a seasoned connoisseur of Filipino food, we invite you to come and taste the difference that comes from using only the finest ingredients and preparing our dishes with care.</p>
                <p>We are proud to be a part of the vibrant Filipino community, and we believe that food is more than just sustenance, it's a way to connect people and share cultural traditions. So come join us and let's celebrate the rich flavors and traditions of the Philippines, together.</p>
                <p>Thank you for choosing us as your destination for delicious and authentic Filipino cuisine!</p>
                </div>
                
            </div>
            <div class="locate-us">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d892.1559459598852!2d120.9422376885606!3d14.97454159999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397013812c32115%3A0x3169d4f1223c1d5b!2sKalsadang%20Bago%20Caingin%20San%20Rafael%20Bulacan!5e0!3m2!1sen!2sph!4v1675839272095!5m2!1sen!2sph" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
    
    
    <?php 
      include '../user/footer.html';
    ?>
</body>
</html>