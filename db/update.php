<?php 
error_reporting(E_ALL);
ini_set('display_errors', '1');

header("Access-Control-Allow-Origin: *");
header("Content-Type:application/json;charset=UTF-8");

//Creating array for json response
$response = array();

//Validation
if(!(empty($_GET['id']) && empty($_GET['status']))){
    $id = $_GET['id'];
    $status = $_GET['status'];

    //Include database connect class
    $filepath = realpath(dirname(__FILE__));
    require_once($filepath."/db_connect.php");

  //Connecting to database
    $connection = new DbConnect();
    $con = $connection->connect();

  
    $result = mysqli_query($con,"UPDATE lights SET status='$status' WHERE id='$id'");

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
}else{
    $response['success'] = 0;
    $response['message'] = "Parameters not found!";
      //Show json response
        echo json_encode($response);


}



?>