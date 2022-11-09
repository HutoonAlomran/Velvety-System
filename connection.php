<?php
define('HOST_NAME',"localhost");
define('USER_NAME',"root");
define('PASSWORD',"root");
define('DB_NAME',"velvetySystemdb");

$conn = new mysqli(HOST_NAME,USER_NAME,PASSWORD,DB_NAME);

 if($conn -> connection_errno){
    
    echo "Failed to connect to MySQL: " . $conn -> connect_error;
    exit();
} 
