<?php
    $db_name = "IOT";
    $querry = "CREATE DATABASE $db_name";

    //Include database connect class
    $filepath = realpath(dirname(__FILE__));
    require_once($filepath."/db_connect.php");

    //Connecting to database
    //Connecting to database
    $connection = new DbConnect();
    $con = $connection->connect();
    
    $result = mysqli_query($con,$querry);
?>