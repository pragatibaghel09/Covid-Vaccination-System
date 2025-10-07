<?php
$server = "localhost";
$username = "root";
$password = "";



$conn = mysqli_connect( $server, $username, $password);

// check connection 
if(!$conn)
{
    die("Sorry we fail to connect:". mysqli_connect_error());
}

else
{
    echo "connection is succesfull"; 
}

// create database

$sql = "create database VACCINE_RECORD";

$result = mysqli_query($conn, $sql);

// check for the database connection

if($result)
{
    echo "database created successfully</br>";
}

else{
    echo "database not created successfully because of this error // " . mysqli_connect_error($conn);
}
echo " The result is " ;
echo var_dump($result);
echo "</br>";

// check database connections



?>
