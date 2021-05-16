<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

header("Access-Control-Allow-Origin: *");
header("Content-Type:application/json;charset=UTF-8");


//Validation
if(!empty($_GET['id'])){

    $id = $_GET['id'];

    //Include database connect class
    $filepath = realpath(dirname(__FILE__));
    require_once($filepath."/db_/db_connect.php");

    //Connecting to database
    $connection = new DbConnect();
    $con = $connection->connect();

    $result = mysqli_query($con,"SELECT * FROM lights WHERE id='$id'") or die(mysqli_error($con));

    if(!empty($result)){

        //Checking
        if(mysqli_num_rows($result)>0){
            
            //Creating array for json response
            $response = array();

            //Storing all data from the array
            while($row = mysqli_fetch_array($result)){

            //$lights = array();      
              //$lights['name'] = $row['name'];
            $response['status'] = $row['status'];

            //array_push($response["lights"],$lights);

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
      

        //Show json response
        echo json_encode($response);

    } 
}
