<?php
include('connection.php');
if(isset($_POST["id"]))
{
    $result = $conn->query("SELECT * FROM request WHERE id = ".$_POST["id"]."");
    $output = '';
    foreach($result as $row)
    { 
        $val= $row["description"];
    }
    $json = json_encode($val, JSON_UNESCAPED_SLASHES);
     
    echo '<p align="center" style="font-size: 15px; text-align:left;"> <b>Request description:</b> </br>'.$json.'</p>';
}
