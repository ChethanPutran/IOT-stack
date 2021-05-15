<?php 

header("Access-Control-Allow-Origin: *");
header("Content-Type:application/json;charset=UTF-8");

//Creating array for json response
$response = array();

//Validation
if(isset($_GET['temp']) && isset($_GET['hum'])){
    $temp = $_GET['temp'];
    $hum = $_GET['hum'];

    //Include database connect class
    $filepath = realpath(dirname(__FILE__));
    require_once($filepath."/db_connect.php");

    //Connecting to database
    $db = new DbConnect();

    $result = mysql_query("INSERT INTO weather(temp,hum) VALUES('$temp','$hum')");
    //Update
    //$result = mysql_query("UPDATE weather SET temp='$temp' WHERE id='$id'");

    //Checking
    if($result){
        //Insertion successfull
        $response['success'] = 1;
        $response['message'] = "Weather Data uploaded successfully.";

        //Show json response
        echo json_encode($response);

    }else{
        //Failed to insert data
        $response['success'] = 0;
        $response['message'] = "Unable to uploade Weather Data!";

        //Show json response
        echo json_encode($response);

    }
}



?>