<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type:application/json;charset=UTF-8");


//Validation
if(isset($_GET['id'])){
    $id = $_GET['id'];

    //Include database connect class
    $filepath = realpath(dirname(__FILE__));
    require_once($filepath."/db_connect.php");

    //Connecting to database
    $db = new DbConnect();

    $result = mysql_query("SELECT * FROM weather WHERE id='$id'") or die(mysql_error());

    if(!empty($result)){

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
    }else{
        $response = array();
        //Failed to insert data
        $response['success'] = 0;
        $response['message'] = "Item not found!";

        //Show json response
        echo json_encode($response);

    } 
}


?>