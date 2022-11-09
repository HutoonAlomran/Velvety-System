<?php
session_start();

include "connection.php";
$emp_id="";
$request_id="";
$description="";
$status="";


if(isset($_POST['submit'])){

    $emp_id=$_POST['employee_id'];
    $request_id=$_POST['id'];   
    $description=$_POST['description'];
    $status=$_POST['status'];

      $file_name = $_FILES['image']['name'];
      $file_size =$_FILES['image']['size'];
      $file_tmp =$_FILES['image']['tmp_name'];
      $file_type=$_FILES['image']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
      
      $file_name2 = $_FILES['image2']['name'];
      $file_size2 =$_FILES['image2']['size'];
      $file_tmp2 =$_FILES['image2']['tmp_name'];
      $file_type=$_FILES['image2']['type'];
      $file_ext2=strtolower(end(explode('.',$_FILES['image']['name'])));
        // $extensions= array("jpeg","jpg","png");      
      
    if(!empty($file_name)){
     $sql="UPDATE request SET emp_id='$emp_id',description='$description',attachment1='$file_name',attachment2='$file_name2',status='$status' WHERE id='$request_id' "; 
     move_uploaded_file($file_tmp,"images/".$file_name);     
    
    $query=mysqli_query($conn,$sql) or die(mysqli_error($conn));

   header("Location:information.php?bid=$request_id");
   }else{
    $sql="UPDATE request SET emp_id='$emp_id',description='$description',status='$status' WHERE id='$request_id' ";         

    $query=mysqli_query($conn,$sql) or die(mysqli_error($conn));    
    header("Location:information.php?bid=$request_id");
   }
   
    
    
}

?>