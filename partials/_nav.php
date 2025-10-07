<?php

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
  $loggedin = true;
}
else{
  $loggedin = false;
}
echo'
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="">Vaccination_Portal</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/COVID_Vaccination/User_Interface.php">Home<span class="sr-only"></span></a>
      </li>';
      if(!$loggedin){
        echo'
      <li class="nav-item">
        <a class="nav-link" href="/COVID_Vaccination/Admin_page.php">Admin</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/COVID_Vaccination/Registration_Page.php">Registration</a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="/COVID_Vaccination/Search_details.php">Certificate</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/COVID_Vaccination/About_Vaccine.php">About Vaccination</a>
      </li>';}

      if($loggedin){
      echo'<li class="nav-item">
        <a class="nav-link" href="/COVID_Vaccination/Logout.php">Logout</a>
      </li>';
    }
      
  echo'     </ul>
            </div>
            </nav>';
?>