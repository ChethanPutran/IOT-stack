<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type:application/json;charset=UTF-8");

//Include database connect class
$filepath = realpath(dirname(__FILE__));
require_once($filepath."/db_connect.php");

//Connecting to database
$con = new DbConnect();

$result = mysql_query($con,"SELECT * FROM lights") or die(mysql_error());

//Checking
if(mysql_num_rows($result)>0){
    
    //Creating array for json response
    $response["lights"] = array();

    //Storing all data from the array
    while($row = mysql_fetch_array($result)){

    $lights = array();  
        
    $lights['id'] = $row['id'];
    $lights['name'] = $row['name'];
    $lights['status'] = $row['status'];

    array_push($response["lights"],$lights);

    }

    $response['success'] = 1;

    //Show json response
    echo json_encode($response);

}else{
    $response = array();
    //Failed to insert data
    $response['success'] = 0;
    $response['message'] = "Something went wrong!";

    //Show json response
    echo json_encode($response);

}



?>