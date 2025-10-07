<?php
session_start();
if(!isset($_SESSION['loggedin'])|| $_SESSION['loggedin']!=true){
header("location: Admin_page.php");
exit;
}
?>

<?php
$add = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"]=="POST")
{ 
include 'partials/_dbconnect.php';

$dose = $_POST["dose"];
$quantity = $_POST["quantity"];

$sql = "Select * from dose_available where Vaccine = '$dose' ";

$result = mysqli_query($conn,$sql);

$count = mysqli_num_rows($result);

if($count == 1)
{
   
    $sql = "Update dose_available 
            set `injection`= `injection` + '$quantity' where Vaccine = '$dose' ";

    $result = mysqli_query($conn,$sql);
        $add = true;


}

else{
    $showError = " Invalid Process "; 
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

    <title>Dose check</title>
  </head>
  <body>
   <?php include 'partials/_nav.php'?>
   <?php
    if($add){
    echo'
    <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>SUCCESS</strong> Injections added successfully.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
    }
   else if($showError){
        echo'
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Error!</strong> '. $showError.'
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
        }
?>
<div class="container my-4 ">
<div class = "main-div">
<h1 class = 'text-center' style="color:blue;font-size:30px;">Dose available</h1>
<div class = "center-div">
            <div class = "table-responsive">
            <table class="table table-dark table-striped">
  <thead>
    <tr>
    <th scope="col">S.NO.</th>
    <th scope="col">Vaccine Type</th>
      <th scope="col">Number of doses</th>
    </tr>
  </thead>
  <tbody>
<?php
    include 'partials/_dbconnect.php';

    $sql = "Select * from dose_available";
    $result = mysqli_query( $conn, $sql);
    $num=1;
    while($row = mysqli_fetch_assoc($result)){
  
?>
    <tr>
    <th scope="row"><?php echo $num ?></th>
<td><?php echo $row['Vaccine'] ?></td>
<td><?php echo $row['injection'] ?></td>
</tr>
<tr>
<?php
$num=$num+1;
   }
   ?>
  </tbody>
</table>

</div>
     </div>
        </div>


  <div class="container my-3">
  <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>ADD INJECTIONS</strong> Enter injection name and quantity.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<h1 class ='text-center'>Add Vaccines</h1>
<h1></br></h1>
    <form class="row g-3" action="/COVID_Vaccination/Dose_update.php" method="post" >
<div class="col-md-6">
    <label for="dose" class="form-label">Vaccine Name</label>
    <input type="text" class="form-control" id="dose" name="dose">
  </div>
  <h1 class = "my-3"></h1>
  <div class="col-md-6">
    <label for="quantity" class="form-label">Quantity of injections</label>
    <input type="text" class="form-control" id="quantity" name="quantity">
  </div>
<h1 class = "my-3"></h1>
  <div class="col-12">
    <button type="submit" class="btn btn-primary">ADD</button>
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