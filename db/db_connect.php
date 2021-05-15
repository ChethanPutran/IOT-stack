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
        $con = mysql_connect(DB_SERVER,DB_USER,DB_PASSWORD) or die(mysql_error());

        //Seleting database
        $db = mysql_selct_db(DB_DATABASE) or die(mysql_error());

        return $con;

    }

    //Closing the connection
    function close(){
        mysql_close();
    }

}
?>