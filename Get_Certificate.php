<?php
session_start();
if(!isset($_SESSION['loggedin'])|| $_SESSION['loggedin']!=true){
header("location: Certificate.php");
exit;
}
?>
<?php
    include 'partials/_dbconnect.php';
     
    $referenceid = $_SESSION['referenceid'];
    $sql = "SELECT user_data.Last_Name, user_data.Identity, user_data.First_Name,
    user_data.Gender,
    user_data.Age, vaccination_status.first_date , vaccination_status.second_date,
    vaccination_status.vaccine_type , vaccination_status.vaccinated_by
    FROM user_data
    INNER JOIN vaccination_status ON user_data.Reference_ID = vaccination_status.Refer_ID
    where  user_data.Reference_ID='$referenceid'";
    $result = mysqli_query( $conn, $sql);
   
    header('content-type:image/jpeg');
    $font  =realpath('Calibri Regular.TTF');
    $image = imagecreatefromjpeg('Certificate_2.jpg');
    $color = imagecolorallocate($image,0,0,0);
    
    while($row = mysqli_fetch_assoc($result)){
        $ref = $row['Identity'];
        $name = $row['First_Name'];
        $name1 = $row['Last_Name'];
        $age = $row['Age'];
        $gender = $row['Gender'];
        $fdate = $row['first_date'];
        $sdate = $row['second_date'];
        $vaccine = $row['vaccine_type'];
        $docname = $row['vaccinated_by'];
    imagettftext($image, 15, 0,280, 203 , $color, $font,"  $name  $name1");
    imagettftext($image, 15, 0,280, 236 , $color, $font,"  $age");
    imagettftext($image, 15, 0,280, 269 , $color, $font,"  $ref");
    imagettftext($image, 15, 0,280, 305, $color, $font, "  $gender");
    imagettftext($image, 15, 0,280, 485, $color, $font, "  $vaccine");
    imagettftext($image, 15, 0,280, 522, $color, $font, "            ($fdate)");
    imagettftext($image, 15, 0,280, 564, $color, $font, "            ($sdate)");
    imagettftext($image, 15, 0,280, 605, $color, $font, "  $docname");
    imagejpeg($image);
    
    imagedestroy($image);
    }
   
?> 

<!doctype html>
<html lang="en">
  <head>
  <?php require 'partials/_nav.php' ?>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>Download_Certificate</title>
  </head>
  <body>

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
