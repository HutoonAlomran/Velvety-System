<?php
 session_start();
 include "connection.php";

 $userid=$_SESSION['id']; 
  $role=$_SESSION['role'];
  
  if(empty($userid) || empty($role)){
     header('Location: index.php');
 }
 
$id=$_GET['bid'];

 //cont..
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Request login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min_89.css">

	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome_89.min.css">
	
	<link rel="stylesheet" type="text/css" href="css.css">
</head>
<body class="">
	
    <div class="topnav">
		<a class="active" href="index.php">Home</a>
		<a href="#news">News</a>
		<a href="#contact">Contact</a>
		<a href="#about">About</a>
		</div>
	    <?php
    	include "connection.php";
    	$msql="SELECT request.description,request.attachment1,request.attachment2,request.id AS rid,employee.first_name,employee.last_name,request.status,request.service_id,request.emp_id,employee.id AS eid,service.id AS sid,service.type FROM request JOIN employee ON employee.id=request.emp_id JOIN service ON service.id=request.service_id WHERE request.id='$id'"; 

    	$query=mysqli_query($conn,$msql) or die(mysqli_error($conn));
    

    	$q=mysqli_fetch_array($query);
    	
    	?>   			

		<div class="container-login">
			<div class="wrap-login" >
				<form class="login-form">
				<div class="card" style="width: 100%;">
					<div class="card-header">
						<h4><?=$q['type']  ?>
							<span class="badge badge-primary"><?php
							 $status=$q['status'];
							 if(($status)==1){
							 	echo "Approved";
							 }
							 if(($status)==2){
							 	echo "Declined";
							 }
							 if(($status)==0){
							 	echo "In progress";
							 }
							?></span>
							<!-- <a href="edit-information.php?id=<?//=$q['rid']?>" class="btn btn-primary float-right"> <span><i class="fa fa-edit"></i></span> Edit</a> -->
						</h4>
						
					</div>
					<div class="card-body">
				

					  <div class="row">
						<div class="col-3">
							Name
						</div>
						<div class="col-9">
							<?=$q['first_name']?> <?=$q['last_name']?>
						</div>
					  </div>
					  <hr>
					  
					  <hr>
					  <div class="row">
						<div class="col-3">
							Description
						</div>
						<div class="col-9">
						    	<?=$q['description']?>
						</div>
					  </div>
					  <hr>
					  <div class="row">
						<div class="col-3">
							Files
						</div>
						<div class="col-9">
							<div class="list-group">
                                                            <p style="font-size: 15px; text-align: left; font-weight: bold;">attachment1:</p>
                                                            <?php
                                                               $file = $q['attachment1'];
                                                               if(!empty($file)){
                                                                    $info = pathinfo($file);

                                                               if(($info["extension"] == "jpg") || ($info["extension"] == "png")) { 

                                                                   ?>
                                                                   <img src="images/<?=$q['attachment1']?>" width="100" />
                                                                   <?php
                                                                }else{ ?>
                                                               <a href="images/<?=$q['attachment1']?>">File Link</a>
                                                                <?php } 
                                                               }
                                                            ?>
                                                            <hr>
                                                            <p style="font-size: 15px; text-align: left; font-weight: bold;">attachment2:</p>

                                                            <?php
                                                               $file2 = $q['attachment2'];
                                                              if(!empty($file2)){
                                                                     $info2 = pathinfo($file2);
                                                               if (($info2["extension"] == "jpg") || ($info2["extension"] == "png")) { 

                                                                   ?>
                                                                   <img src="images/<?=$q['attachment2']?>" width="100" />

                                                                   <?php

                                                                }else{ ?>

                                                               <a href="images/<?=$q['attachment2']?>">File Link</a>
                                                                <?php } 
                                                              }
                                                            ?>	
							</div>
							
						</div>
					  </div>
					</div>
					<?php
                     if(($role)=="Manager"){ ?>
                       <div class="card-footer text-muted">
						<?php
                     $status=$q['status'];
                     if(($status) == 0){
                     	?>
                     	<a href="approve.php?id=<?=$q['rid']?>" class="btn btn-success">Approve</a>
						     <a href="decline.php?id=<?=$q['rid']?>" class="btn btn-danger">Decline</a>

                     	<?php
                     }
                     if(($status) == 1){
                     	?>
                     	
						     <a href="decline.php?id=<?=$q['rid']?>" class="btn btn-danger">Decline</a>

                     	<?php
                     }
                     if(($status) == 2){
                     	?>
                     	<a href="approve.php?id=<?=$q['rid']?>" class="btn btn-success">Approve</a>
						     

                     	<?php
                     }

						?>

						
					</div>

                     <?php }

					?>

				  </div>
				</form>
			</div>
		</div>
    <footer>
		<div class="credit"> VELVETY SYSTEM 2021 &copy; All Rights reserved</div>
	</footer>
</body>
</html>