<?php
    //start session
    session_start();

    //create constants to store Non repeating values
    define('SITEURL','http://localhost/helpdesk/');
    define('LOCALHOST','localhost');
    define('DB_USERNAME','root');
    define('DB_PASSWORD','');
    define('DB_NAME','government scheme');

    $conn= mysqli_connect(LOCALHOST, DB_USERNAME,DB_PASSWORD) or die(mysqli_error()); // Database Connection
    $sub_select= mysqli_select_db($conn,DB_NAME) or die(mysqli_error()); //selecting databse
    

?>