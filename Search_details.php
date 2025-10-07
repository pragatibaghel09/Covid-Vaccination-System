<?php
$found = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"]=="POST")
{ 
include 'partials/_dbconnect.php';

$referenceid = $_POST["referenceid"];
$identity = $_POST["identity"];

$sql = "Select * from vaccination_status where 
        Refer_ID = '$referenceid' AND Identity = '$identity' ";

$result = mysqli_query($conn,$sql);

$num = mysqli_num_rows($result);

if($num == 1)
{
    $found = true;
    session_start();
    $_SESSION['loggedin'] = true;
    $_SESSION['referenceid'] = $referenceid;
    $_SESSION['identity'] = $identity;
    header("location: Certificate.php");
}

else{
    $showError = " Your data is not found please enter valid information."; 
}
}

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>Search_Details</title>
  </head>
  <body>
    
    <?php require 'partials/_nav.php' ?>
    <?php

    if($showError)
    {
        echo'
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Error!</strong> '. $showError.'
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }  

 echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>CERTIFICATE</strong> Certificate will only available when you has got both first and second dose.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';

    ?>

<div class="container my-3">
 
<h1 class ='text-center' style="color:blue;font-size:30px;">FILL THE INFORMATION TO GET THE CERTIFICATE</h1>
<h1></br></h1>
<form class="row g-3" action="/COVID_VACCINATION/Search_details.php" method="post" >
<div class="col-md-6">
    <label for="referenceid" class="form-label">Reference_ID</label>
    <input type="text" class="form-control" id="referenceid" name="referenceid">
  </div>
  <h1 class = "my-3"></h1>
  <div class="col-md-6">
    <label for="identity" class="form-label">Identity</label>
    <input type="text" class="form-control" id="identity" name="identity">
  </div>
<h1 class = "my-3"></h1>
  <div class="col-12">
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>
</div>
</div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
  </body>
</html>