<?php
$showAlert = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"]=="POST")
{ 
include 'partials/_dbconnect.php';
$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$address = $_POST["address"];
$identity = $_POST["identity"];
$mobile = $_POST["mobile"];
$dobirth = $_POST["dobirth"];
$age = $_POST["age"];
$gender = $_POST["gender"];
// $exists=false;
// for checking data is not entered repeatedly

$existSql = "Select * FROM user_data Where Identity = '$identity' "; 

$result = mysqli_query($conn,$existSql);

$numExistRows = mySqli_num_rows($result);

if($numExistRows > 0 || $age<=18 || $identity == NULL){
  // $exists = true;
  $showError="Your registration was already done or you did some mistake";
}
else
{
$exists = false;
$sql = "INSERT INTO `user_data` 
(`First_Name`, `Last_Name`, `Address`, `Identity`, `Mobile_Number`, `Date_Of_Birth`, `Age`, `Gender`, `Date`) 
VALUES ('$firstname', '$lastname', '$address', '$identity', '$mobile', '$dobirth', '$age', '$gender', current_timestamp())";

$result = mysqli_query($conn,$sql);

$sql = " SELECT * from user_data where `Identity`='$identity' ";

$result = mysqli_query($conn,$sql);

$num = mysqli_num_rows($result);

$res = mysqli_fetch_array($result);

$temp = $res['Reference_ID'];

$sql = "INSERT INTO `vaccination_status` 
(`Refer_ID`, `Identity` , `first_date`, `second_date`) 
VALUES ('$temp' , '$identity' ,NULL , NULL)";

$result = mysqli_query($conn,$sql);

if($result)
{
  $showAlert = true;
      }
}

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
</head>
<body>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

  </head>
  <body>
    <?php require 'partials/_nav.php' ?>
    <?php
    if($showAlert){
    echo'
    <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>SUCCESS</strong> Your registration for CO-VACCINATION is successful, now you are valid for vaccination. Your Centre Reference ID is  '. $temp .'
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
    }
    if($showError){
      echo'
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>OOPS!!</strong> '. $showError.'
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
      }
?>

    <div class="container my-4 ">
    <h1 class ='text-center' style="color:blue;font-size:30px;">FOR VACCINATION PLEASE REGISTER HERE</h1>
    <h1></br></h1>
    <form class="row g-3" action="/COVID_VACCINATION/Registration_Page.php" method="post" >
  <div class="col-md-6">
    <label for="firstname" class="form-label">First_Name</label>
    <input type="text" class="form-control" id="firstname" name="firstname">
  </div>
  <div class="col-md-6">
    <label for="lastname" class="form-label">Last_Name</label>
    <input type="text" class="form-control" id="lastname" name="lastname">
  </div>
  <div class="col-12">
    <label for="address" class="form-label">Address</label>
    <input type="text" class="form-control" id="address" name="address" placeholder="1234 Main St">
  </div>
  <div class="col-12">
    <label for="identity" class="form-label">Aadhaar_Number/PAN_NUMBER/VOTER_ID.....</label>
    <input type="text" class="form-control" id="identity" name="identity" placeholder="Must be unique identity">
  </div>
  <div class="col-md-6">
    <label for="mobile" class="form-label">Mobile_Number</label>
    <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Must be of 10 digits.">
  </div>
  <div class="col-md-6">
    <label for="dobirth" class="form-label">Date_Of_Birth</label>
    <input type="text" class="form-control" id="dobirth" name="dobirth" placeholder="yyyy-mm-dd">
  </div>
  <div class="col-md-6">
    <label for="age" class="form-label">Age</label>
    <input type="text" class="form-control" id="age" name="age">
  </div>
  <div class="col-md-6">
    <label for="gender" class="form-label">Gender</label>
    <input type="text" class="form-control" id="gender" name="gender">
  </div>
 
  <div class="col-12">
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>
</form>
   
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
</body>
</html>