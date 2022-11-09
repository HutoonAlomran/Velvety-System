<?php
session_start();
include("connection.php");

$emp_id="";
$service_id="";
$description="";
$attachment1="";
$attachment2="";
$status="";
// $dd=$_GET['id'];

if(isset($_POST)){
    
    $emp_id=$_SESSION['id'];
    $dd=$_POST['id'];
    $service_id=$_POST['service_id'];
    $description=$_POST['description'];
    
    $attachment1 = $_FILES['uploadfile']['name'];
    $tempname = $_FILES['uploadfile']['temp_name'];
    move_uploaded_file($file_tmp,"images/".$attachment1);
    
    $attachment2 = $_FILES['uploadfile2']['name'];
    $tempname = $_FILES['uploadfile2']['temp_name'];
    move_uploaded_file($file_tmp,"images/".$attachment2);
    
   
    $sql="INSERT INTO request(emp_id,service_id=,description,attachment1,attachment2) VALUES('$emp_id','$_serviceid','$description','$attachment1','$attachment2')";
    print($sql);
    exit;
    
    $query=mysqli_query($conn,$sql) or die(mysqli_error($conn));
    
    header('Location: Employee home page.php');
    
}

?>