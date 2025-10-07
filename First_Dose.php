<?php
session_start();
if(!isset($_SESSION['loggedin'])|| $_SESSION['loggedin']!=true){
header("location: Admin_page.php");
exit;
}
?>
<?php
$showAlert = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"]=="POST")
{ 
include 'partials/_dbconnect.php';
$firstdose = $_POST["firstdose"];
$vaccine = $_POST["vaccine"];
$docname = $_POST["docname"];
$date = date("Y/m/d");
$referenceid = $_SESSION['referenceid'];


$sql = "SELECT * FROM dose_available 
        where Vaccine = '$vaccine' AND injection > 0 ";

$result = mysqli_query($conn,$sql);

$num = mysqli_num_rows($result);

if($num==1)
{
  $sql = "Update dose_available 
  set `injection`= `injection` - '1' where Vaccine = '$vaccine' ";

$result = mysqli_query($conn,$sql);

$sql = "Update Vaccination_status 
        set `First_Dose` = '$firstdose' , `Vaccine_Type` = '$vaccine' , `Vaccinated_By` = '$docname' , `first_date` = '$date'
        WHERE Refer_ID = '$referenceid'";

$result = mysqli_query($conn,$sql);
  if($result)
  {
    $showAlert = true;
  }
}

else
{
  $showError=true;
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

    <title>First Dose</title>
  </head>
  <body>
  <?php require 'partials/_nav.php' ?>
  <?php
    if($showAlert){
    echo'
    <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>VACCINATION SUCCESS</strong> First dose completed. Benificiary  valid for Second dose after date '.date("Y-m-d",strtotime("+1 Months")).'
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
    }
    
    else if($showError){
      echo'
       <div class="alert alert-danger alert-dismissible fade show" role="alert">
     <strong>Oops!</strong> Vaccine dose is not available, Tell beneficiary visit the centre later. 
     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
     </div>';
       } 
    else{
   echo'
    <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>SUCCESS</strong> Details found beneficiary is valid for First_Dose.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
    } 

  ?>
  <div class="container my-4 ">
<div class = "main-div">
<h1 class = 'text-center' style="color:blue;font-size:30px;">Beneficiary Information</h1>
<div class = "center-div">
            <div class = "table-responsive">
            <table class="table table-dark table-striped">
  <thead>
    <tr>
    <th scope="col">Referece_ID</th>
      <th scope="col">Name</th>
      <th scope="col">Age</th>
      <th scope="col">Gender</th>
      <th scope="col">Identity_Number</th>
    </tr>
  </thead>
  <tbody>
  <?php
include 'partials/_dbconnect.php';

$referenceid = $_SESSION['referenceid'];

$sql = " SELECT * from user_data where Reference_ID='$referenceid' ";

$result = mysqli_query($conn,$sql);

$num = mysqli_num_rows($result);

$res = mysqli_fetch_array($result);
?>
<h1></br></h1> 
<tr>
<td><?php echo $res['Reference_ID'] ?></td>
<td><?php echo $res['First_Name'] ?></td>
<td><?php echo $res['Age'] ?></td>
<td><?php echo $res['Gender'] ?></td>
<td><?php echo $res['Identity'] ?></td>
</tr>
   
  </tbody>
</table>

</div>
     </div>
        </div>
        <h1></br></h1>
<form class="row g-3" action="/COVID_VACCINATION/First_Dose.php" method="post" >
<h1 class = 'text-center' style="color:blue;font-size:40px;">Select the information for first dose</h1>
<h1> </br> </h1>

<h1  style="color:red;font-size:30px;">First Dose : </h1>

<div class="form-check">
  <input class="form-check-input" type="radio" value="Success" id="firstdose" name="firstdose">
  <label class="form-check-label" for="firstdose">
    Success
  </label>
</div>

<h1  style="color:red;font-size:30px;">Select Vaccine : </h1>
<div class="form-check">
  <input class="form-check-input" type="radio" value="COVAXIN" id="vaccine" name="vaccine">
  <label class="form-check-label" for="vaccine">
    COVAXIN
  </label>
</div>

<div class="form-check">
  <input class="form-check-input" type="radio" value="COVISHIELD" id="vaccine" name="vaccine">
  <label class="form-check-label" for="vaccine">
    COVISHIELD
  </label>
</div>

<div class="form-check">
  <input class="form-check-input" type="radio" value="SPUTNIK" id="vaccine" name="vaccine">
  <label class="form-check-label" for="vaccine">
    SPUTNIK
  </label>
</div>

<div class="col-md-6">
    <label for="docname" class="form-label">Doctor Name</label>
    <input type="text" class="form-control" id="docname" name="docname">
  </div>


<div class="col-12">
    <button type="submit" class="btn btn-primary">Aprove</button>
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