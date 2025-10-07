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

// create the table_3 dose_available

$sql = " CREATE TABLE `dose_available` 
(`Vaccine` VARCHAR(15) NOT NULL , `injection` INT(8) NOT NULL , PRIMARY KEY (`Vaccine`))";

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

$sql = " INSERT INTO `dose_available` (`Vaccine`, `injection`)
         VALUES ('COVAXIN', '100'),
         ('COVISHIELD', '100'),
         ('SPUTNIK', '100')";

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
