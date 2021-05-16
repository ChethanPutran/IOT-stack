<?php

class DbConnect{

    function __construct(){
        $this->connect();
    }
    function __destruct(){
        $this->close();
    }

    //Function to connect to database
    function connect(){
        //Importing DB config file
        $filepath = realpath(dirname(__FILE__));
        require_once($filepath."/dbconfig.php");

        //Connecting to mysql database
        $con = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_DATABASE) or die(mysqli_connect_errno());
        // $db = $con->select_db(DB_DATABASE) or die(mysql_error($con));
        return $con;

    }

    //Closing the connection
    function close(){
        mysqli_close();
    }

}
?>