<?php
session_start();
if(!isset($_SESSION['loggedin'])|| $_SESSION['loggedin']!=true){
header("location: Admin_page.php");
exit;
}
?>

<?php
$login = false;
$foundfirst = false;
$foundsecond = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"]=="POST")
{ 
include 'partials/_dbconnect.php';

$referenceid = $_POST["referenceid"];
$identity = $_POST["identity"];

$sql = "Select * from vaccination_status 
 where Refer_ID = '$referenceid' AND Identity = '$identity' AND First_Dose Is NULL";

$result = mysqli_query($conn,$sql);

$count = mysqli_num_rows($result);

$sql = "Select * from vaccination_status
where Refer_ID = '$referenceid' AND Identity = '$identity' AND Second_Dose Is NULL ";

$result = mysqli_query($conn,$sql);

$num = mysqli_num_rows($result);


if($num == 1 && $count==1)
{
    $foundsecond = true;
    $login = true;
    session_start();
    $_SESSION['loggedin'] = true;
    $_SESSION['referenceid'] = $referenceid;  
    header("location: First_Dose.php");
}

else if($num == 1 && $count==0)
{
    $foundfirst = true;
    $login = true;
    session_start();
    $_SESSION['loggedin'] = true;
    $_SESSION['referenceid'] = $referenceid;
    header("location: Second_Dose.php");
}
else{
    $showError = " Something wrong "; 
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

    <title>Vaccination</title>
  </head>
  <body>
    
    <?php require 'partials/_nav.php' ?>
    <?php
    if($foundfirst){
    echo'
    <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>SUCCESS</strong> Details found candidate is valid for First_Dose.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
    }
    else if($foundsecond){
        echo'
        <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>SUCCESS</strong> Details found candidate is valid for Second_Dose.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
        }
   else if($showError){
        echo'
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Opps!</strong> '. $showError.'
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
        }
?>
    <div class="container my-3">
  <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>CHECK</strong> Enter details to check benificiary will available for which dose.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<h1 class ='text-center'>Search details</h1>
<h1></br></h1>
    <form class="row g-3" action="/COVID_Vaccination/Vaccination.php" method="post" >
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
    <button type="submit" class="btn btn-primary">Check</button>
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