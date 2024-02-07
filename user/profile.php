<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../user/profile.css">
    <link rel="stylesheet" href="../flexbox.css">
    <title>User Profile | JJ Food Trays</title>
</head>
<body>
    <?php
        include 'header.php';
        include '../php/pass.php';
        require '../php/dbcon.php';
        $query = "SELECT customers.cFName, customers.cLName, customers.cPhone, users.uEmail, users.uPswd, customers.cStreet, customers.cBrgy, customers.cCity, customers.cProv from customers JOIN users on users.cID=customers.cID WHERE customers.cID='$id'";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_row($result);
    ?>
    
    <div class="profile">
        <div class="view-options">
            <a href="../user/profile.php" class="view-btn" id="profile-btn">Profile</a>
            <a href="../user/orders.php" class="view-btn">Orders</a>
        </div>
        <hr>
        <div class="flex-row">
        <div class="basic-info">
            <h5>Basic Information</h5>
            <hr>
            <label for="">First Name</label>
            <input type="text" name="" id="" readonly class="text-field" value="<?php echo $row[0]?>">
            <label for="">Last Name</label>
            <input type="text" name="" id="" readonly class="text-field" value="<?php echo $row[1]?>">
            <label for="">Mobile No.</label>
            <input type="text" name="" id="" readonly class="text-field" value="<?php echo $row[2]?>">
            <label for="">Email Address</label>
            <input type="text" name="" id="" readonly class="text-field" value="<?php echo $row[3]?>">
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#updateProfile">
            Change
            </button>
        </div>
        <div class="addr">
            <h5>Address</h5>
            <hr>
            <label for="">Street</label>
            <input type="text" name="" id="" readonly class="text-field" value="<?php echo $row[5]?>">
            <label for="">Barangay</label>
            <input type="text" name="" id="" readonly class="text-field" value="<?php echo $row[6]?>">
            <label for="">City</label>
            <input type="text" name="" id="" readonly class="text-field" value="<?php echo $row[7]?>">
            <label for="">Province</label>
            <input type="text" name="" id="" readonly class="text-field" value="<?php echo $row[8]?>">
        </div>

    </div>

    </div>
    <div class="modal fade" id="updateProfile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="../php/update-profile.php" method="POST">
            <div class="modal-body">
                <h5>Basic Information</h5>
                <hr>
                <label for="">First Name</label>
                <input type="text" name="cFName" id="" class="text-field" value="<?php echo $row[0]?>" required>
                <label for="">Last Name</label>
                <input type="text" name="cLName" id="" class="text-field" value="<?php echo $row[1]?>" required>
                <label for="">Mobile No.</label>
                <input type="text" name="cPhone" id="" class="text-field" value="<?php echo $row[2]?>" required minlength="11" maxlength="11" placeholder="09XXXXXXXXX">
                <label for="">Password</label>
                <input type="password" name="uPswd" id="" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required class="text-field" value="<?php echo $row[4]?>">
                <h5>Address</h5>
                <hr>
                <label for="">Street</label>
                <input type="text" name="cStreet" id="" class="text-field" value="<?php echo $row[5]?>" required>
                <label for="">Barangay</label>
                <input type="text" name="cBrgy" id="" class="text-field" value="<?php echo $row[6]?>" required>
                <label for="">City</label>
                <input type="text" name="cCity" id="" class="text-field" value="<?php echo $row[7]?>" required>
                <label for="">Province</label>
                <input type="text" name="cProv" id="" class="text-field" value="<?php echo $row[8]?>" required>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="update-prof">Save changes</button>
            </div>
            </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>