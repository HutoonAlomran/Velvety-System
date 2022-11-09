<?php
	/* "connection.php";

	$id=$_GET['id'];
	$role=$_GET['role'];

	$sql="UPDATE request SET `status`=1 WHERE id='$id' ";

	$quuery=mysqli_query($conn,$sql);

	  if(($role)==("Manager")){
    	header('Location: managerHomePage.php');
    }else{

    	header("Location: information.php?bid=$id");
    }*/


    include "connection.php";
	$id="";

	if(isset($_GET['id'])){
		$id=$_GET['id'];
		
		$sql="UPDATE request SET `status`=1 WHERE request.id='$id' ";
		$query=mysqli_query($conn,$sql) or die(mysqli_error($conn));
		header("Location: information.php?bid=$id");
	}else{


		$id=$_POST["myid"];		
		$sql="UPDATE request SET `status`=1 WHERE request.id='$id' ";
		$query=mysqli_query($conn,$sql) or die(mysqli_error($conn));

	}
?>