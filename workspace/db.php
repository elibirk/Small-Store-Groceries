<?php

//this file connects to our database in Cloud9, code will likely only work in Cloud9

 $servername = getenv('IP'); //db info
    $dbusername = getenv('C9_USER');
    $dbpassword = "";
    $database = "c9";
    $dbport = 3306;
    
     // Create connection
    $mysql = new mysqli($servername, $dbusername, $dbpassword, $database, $dbport);

    // Check connection
    if ($mysql->connect_error) {
        die("Connection failed: " . $mysql->connect_error);
    } 
    
    
    //choose the correct database
    $selected = mysqli_select_db($mysql, "store");
    if(!$selected){
        echo "Cannot select database. Please contact an adminsistrator.";
        exit;
    }
    
    
 ?>