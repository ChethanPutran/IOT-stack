<?php
    $db_name = "IOT";
    $querry = "CREATE DATABASE $db_name";

    //Include database connect class
    $filepath = realpath(dirname(__FILE__));
    require_once($filepath."/db_connect.php");

    //Connecting to database
    $con = new DbConnect();
    $result = mysqli_query($con,$querry);
?>