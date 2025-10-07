<?php


$server = "localhost";
$username = "root";
$password = "";
$database = "Vaccine_Record";


$conn = mysqli_connect( $server, $username, $password, $database);

if($conn)
{
    echo "connection is success";
}

else
{
    die("Error". mysqli_connect_error());
}

// create the table_1 user_data

$sql = " CREATE TABLE `user_data` 
( `Reference_ID` INT(6) NOT NULL AUTO_INCREMENT, `First_Name` VARCHAR(15) NOT NULL , 
 `Last_Name` VARCHAR(15) NOT NULL ,  
`Address` VARCHAR(40) NOT NULL , `Identity` VARCHAR(20) NOT NULL ,  
`Mobile_Number` BIGINT(10) NOT NULL , `Date_Of_Birth` DATE NOT NULL ,
`Age` INT(5) NOT NULL ,  `Gender` VARCHAR(6) NOT NULL , 
`Date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY  (`Reference_ID`))";

$result = mysqli_query($conn, $sql);

// check for the table creation

if($result)
{
    echo "Table created successfully</br>";
}

else{
    echo "Table not created successfully because of this error -----> " . mysqli_connect_error($conn);
}
/*echo " The result is " ;
echo var_dump($result);
echo "</br>";*/


?>
