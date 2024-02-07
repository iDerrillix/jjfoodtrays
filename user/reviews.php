<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../table-css.css">
    <link rel="stylesheet" href="../user/reviews.css">
    <link rel="stylesheet" href="../flexbox.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Reviews | JJ Food Trays</title>
</head>
<body>
    <?php 
        session_start();
        include 'header.php';
        require '../php/dbcon.php';
        if(isset($_GET['sort'])){
            $type = $_GET['sort'];
            if($type == 'high'){
                $query = "SELECT CONCAT(customers.cFName, ' ', customers.cLName), rRating, rMsg FROM reviews JOIN customers ON reviews.cID = customers.cID ORDER BY rRating DESC";
            } else {
                $query = "SELECT CONCAT(customers.cFName, ' ', customers.cLName), rRating, rMsg FROM reviews JOIN customers ON reviews.cID = customers.cID ORDER BY rRating ASC";
            }
        } else {
            $query = "SELECT CONCAT(customers.cFName, ' ', customers.cLName), rRating, rMsg FROM reviews JOIN customers ON reviews.cID = customers.cID";
        }
    ?>
    
    <div class="container" style="margin: auto; margin-top: 75px;">
        <div class="design-container">
            <div class="flex-heading">
                <h4>Reviews</h4>
                <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    Sort By
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="../user/reviews.php?sort=high">Rating (High to Low)</a></li>
                    <li><a class="dropdown-item" href="../user/reviews.php?sort=low">Rating (Low to High)</a></li>
                </ul>
                </div>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Add a Review
                </button>
            </div>
                <br>
                <table class="table-css" width="100%">
                    <?php
                        $result = mysqli_query($con, $query);
                        while($row = $result->fetch_row()){
                            echo "<tr><td>
                            <h6><strong>".$row[0]."</strong></h6>
                            <p>Rating: ".$row[1]."</p></td>
                            <td>".$row[2]."</td></tr>";
                        }
                    ?>
            </table>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Leave a review</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="../php/add-review.php" method="POST">
        <h4>How is your ordering experience with us?</h4>
        <br>
        <label for="rRating">Rating</label>
        <input type="number" name="rRating" id="" value="5" step="0.5" min="0" max="5">
        <br>
        <br>
        <textarea name="rMsg" id="" cols="30" rows="5" class="areatext"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger" name="add-review">Add Review</button>
        </form>
      </div>
    </div>
  </div>
</div>

    
</body>
</html>