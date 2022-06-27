<?php 
    // Start session
    session_start();



    define("SITEURL","http://localhost:81/food-order/");
    // Create contants to store non repeating value
    define("SEVERNAME",'localhost');
    define("DB_USERNAME",'phamhaidang');
    define("DB_PASSWORD",'123456789');
    define("DB_NAME",'food-order');

    $conn = mysqli_connect( SEVERNAME, DB_USERNAME , DB_PASSWORD) or die(mysqli_error()); //Database conection

    $db_select = mysqli_select_db($conn ,DB_NAME) or die(mysqli_error()); // Select database

?>