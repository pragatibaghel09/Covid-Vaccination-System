<?php

$server = "localhost";
$username = "root";
$password = "";
$database = "Vaccine_Record";


$conn = mysqli_connect( $server, $username, $password, $database);

if($conn)
{
    echo "connection is success</br>";
}

else
{
    die("Error". mysqli_connect_error());
}

// create the table_2 admin_security

$sql = " CREATE TABLE `admin_security` 
( `S.No.` INT(6) NOT NULL AUTO_INCREMENT , `PIN_Code` INT(6) NOT NULL , 
 `Centre_ID` VARCHAR(10) NOT NULL , `Password` VARCHAR(255) NOT NULL, PRIMARY KEY (`S.NO.`))";

$result = mysqli_query($conn, $sql);

// check for the table creation

if($result)
{
    echo "Table created successfully</br>";
}

else{
    echo "Table not created successfully because of this error -----> " . mysqli_connect_error($conn);
}

// insert data into table
$hash = password_hash('Apple@123', PASSWORD_DEFAULT);
 

$sql = " INSERT INTO `admin_security` (`PIN_Code`, `Centre_ID`, `Password`)
         VALUES ('452010', 'AH123', '$hash')";

$result = mysqli_query($conn, $sql);

// check for the table creation

if($result)
{
    echo "Data has been inserted successfully</br>";
}

else{
    echo "Data not inserted successfully because of this error -----> ".mysqli_connect_error($conn);
}
/*echo " The result is " ;
echo var_dump($result);
echo "</br>";*/


?>
