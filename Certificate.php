<?php
session_start();
if(!isset($_SESSION['loggedin'])|| $_SESSION['loggedin']!=true){
header("location: Search_detail.php");
exit;
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

    <title>Certificate</title>
  </head>
  <body>
        <?php require 'partials/_nav.php' ?>

        <div class = "main-div my-4">
        <h1 class ='text-center' style="color:blue;font-size:30px";>YOUR INFORMATION WITH CERTIFICATE</h1>
            <div class = "center-div">
            <div class = "table-responsive">
            <table class="table table-striped">
  <thead>
    <tr>
    <th scope="col">Reference ID</th>
      <th scope="col">Name</th>
      <th scope="col">Age</th>
      <th scope="col">Gender</th>
      <th scope="col">Identity Number</th>
      <th scope="col">First Dose</th>
      <th scope="col">First Dose Date</th>
      <th scope="col">Second Dose</th>
      <th scope="col">Second Dose Date</th>
      <th scope="col">Vaccine Type</th>
      <th scope="col">Vaccinated by</th>
    </tr>
  </thead>
  <tbody>

<?php
include 'partials/_dbconnect.php';

$referenceid = $_SESSION['referenceid'];
$identity = $_SESSION['identity'];

$sql = "SELECT user_data.Reference_ID, user_data.Identity, user_data.First_Name,
        user_data.Gender,
        user_data.Age, vaccination_status.first_date , vaccination_status.second_date,
        vaccination_status.vaccine_type , vaccination_status.vaccinated_by
        FROM user_data
        INNER JOIN vaccination_status ON user_data.Reference_ID = vaccination_status.Refer_ID
        where  user_data.Reference_ID='$referenceid' AND user_data.Identity='$identity' ";

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
<td>Success</td>
<td><?php echo $res['first_date'] ?></td>
<td>Success</td>
<td><?php echo $res['second_date'] ?></td>
<td><?php echo $res['vaccine_type'] ?></td>
<td><?php echo $res['vaccinated_by'] ?></td>


</tr>
   
  </tbody>
</table>

</div>
     </div>
        </div>
        <h1></br></h1>
  <?php

if($_SERVER["REQUEST_METHOD"]=="POST")
{ 
include 'partials/_dbconnect.php';

    session_start();
    $_SESSION['loggedin'] = true;
    $referenceid = $_SESSION['referenceid'];
    header("location: Get_Certificate.php");
}
?>

<div class="container my-3">
  
<form class="row g-3" action="/COVID_VACCINATION/Get_Certificate.php" method="post" >

<h1 class = "my-3"></h1>
  <div class="d-grid gap-2 col-6 mx-auto">
    <button type="submit" class="btn btn-success">Get Certificate</button>
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
