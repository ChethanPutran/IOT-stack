<?php
    $table_name = "Appliances";
    $querry = "CREATE TABLE `$table_name` (`id` INT(6) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(12) NOT NULL,`status` VARCHAR(6) NOT NULL,PRIMARY KEY(`id`))";

    //Include database connect class
    $filepath = realpath(dirname(__FILE__));
    require_once($filepath."/db_connect.php");

    //Connecting to database
      //Connecting to database
    $connection = new DbConnect();
    $con = $connection->connect();
    
    $result = mysqli_query($con,$querry);
    if($result){
        echo "Table created successfully.";
    }else{
        echo "Unable to create table. Error : ".mysqli_error($con);
    }
?>