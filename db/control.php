<?php 

header("Access-Control-Allow-Origin: *");
header("Content-Type:application/json;charset=UTF-8");

//Creating array for json response
$response = array();

//Validation
if(isset($_GET['id']) && isset($_GET['status'])){
    $id = $_GET['id'];
    $status = $_GET['status'];

    //Include database connect class
    $filepath = realpath(dirname(__FILE__));
    require_once($filepath."/db_connect.php");

    //Connecting to database
    $db = new DbConnect();

  
    $result = mysql_query("UPDATE lights SET status='$status' WHERE id='$id'");

    //Checking
    if($result){
        //Insertion successfull
        $response['success'] = 1;
        $response['message'] = "Data updated successfully.";

        //Show json response
        echo json_encode($response);

    }else{
        //Failed to insert data
        $response['success'] = 0;
        $response['message'] = "Unable to update the data!";

        //Show json response
        echo json_encode($response);

    }
}



?>