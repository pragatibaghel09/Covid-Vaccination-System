<?php
$login = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"]=="POST")
{ 
include 'partials/_dbconnect.php';
$pincode = $_POST["pincode"];
$centreid = $_POST["centreid"];
$password = $_POST["password"];


$sql = "Select * from admin_security where PIN_Code='$pincode' AND Centre_ID='$centreid'";


$result = mysqli_query($conn,$sql);

$num = mysqli_num_rows($result);

if($num == 1)
{
  while($row = mysqli_fetch_assoc($result))
  {
    if(password_verify($password, $row['Password']))
    {
      $login = true;
      session_start();
      $_SESSION['loggedin'] = true;
      $_SESSION['centreid'] = $centreid;
      header("location: Welcome_admin.php");
    }
    else{
      $showError = " Invalid Credential !! your password is wrong"; 
  }
  }
  
  
}
else{
  $showError = " Invalid Credential !! either your centre id or your PIN_CODE is wrong"; 
}
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
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

    <title>Admin Page</title>
  </head>
  <body>
    <?php require 'partials/_nav.php' ?>
    <?php
    if($login){
    echo'
    <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>SUCCESS</strong> Your loged in is successful.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
    }
    if($showError){
        echo'
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Error!</strong> '. $showError.'
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
        }
?>

    <div class="container my-4 ">
    <h1 class = 'text-center' style="color:blue;font-size:30px;">PLEASE ENTER YOUR DETAILS HERE FOR LOGIN</h1>
    <h1 class = 'text-center' style="color:red;font-size:30px;"> !! ONLY FOR ADMIN !!</h1>
    <h1></br></h1>
    <form class="row g-3" action="/COVID_VACCINATION/Admin_page.php" method="post" >
  <div class="col-md-6">
    <label for="pincode" class="form-label">PIN_Code</label>
    <input type="text" class="form-control" id="pincode" name="pincode">
  </div>
  <div class="col-md-6">
    <label for="centreid" class="form-label">Centre_ID</label>
    <input type="text" class="form-control" id="centreid" name="centreid">
  </div>
  <div class="col-12">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password">
  </div>
 
 
  <div class="col-12">
    <button type="submit" class="btn btn-primary">Login</button>
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