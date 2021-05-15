<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type:application/json;charset=UTF-8");


//Validation
if(isset($_GET['temp']) && isset($_GET['hum'])){
    $temp = $_GET['temp'];
    $hum = $_GET['hum'];

    //Include database connect class
    $filepath = realpath(dirname(__FILE__));
    require_once($filepath."/db_connect.php");

    //Connecting to database
    $db = new DbConnect();

    $result = mysql_query("SELECT * FROM weather") or die(mysql_error());

    //Checking
    if(mysql_num_rows($result)>0){
        
        //Creating array for json response
        $response["weather"] = array();

        //Storing all data from the array
        while($row = mysql_fetch_array($result)){

        $weather = array();  
          
        $weather['id'] = $row['id'];
        $weather['temp'] = $row['temp'];
        $weather['hum'] = $row['hum'];

        array_push($response["weather"],$weather);

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
}


?>