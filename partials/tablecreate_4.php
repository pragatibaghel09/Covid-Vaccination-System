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

// create the table_4 vaccination_status

$sql = " CREATE TABLE `vaccination_status` 
(`Refer_ID` INT(6) NOT NULL ,`Identity` VARCHAR(20) NOT NULL, `First_Dose` VARCHAR(15) NULL, 
 `first_date` DATE NULL,  
 `Second_Dose` VARCHAR(15) NULL , `second_date` DATE NULL, `vaccine_type` VARCHAR(15) NULL,
 `vaccinated_by` VARCHAR(15) NULL, 
  PRIMARY KEY  (`Identity`), 
  FOREIGN KEY (`vaccine_type`) REFERENCES `dose_available`(`Vaccine`))";



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
