<?php
session_start();
include "connection.php";
$id=$_SESSION['id'];
$role=$_SESSION['role'];
 if(empty($role)){
     header('Location: index.php');
 }
 
 ?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>VELVETY SYSTEM</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/manger_form.css">
<!--===============================================================================================-->
</head>

<body>

	<div class="topnav">
		<a class="active" href="index.php">Home</a>
		<a href="#news">News</a>
		<a href="#contact">Contact</a>
		<a href="#about">About</a>
	  </div>
	
		<div class="container-login100">

			<div class="wrap-login100">
		
				<form method="POST" action="new_request.php" enctype="multipart/form-data">

					<span>
						Add New Request
					</span>
					<input type="hidden" name="emp_id"  value="<?=$id?>"> 


					<div>
						<?php
                            include "connection.php";
                            $result=mysqli_query($conn,"SELECT * FROM service");
                            
                            ?>
                              <p>
                                <select name="service" class="input100">
                                  <option value="" >--Select service--</option>
                                  <?php
                                    while($row = mysqli_fetch_array($result))
                                    { ?>
                                  <option value="<?=$row['id']?>"><?=$row['type']?></option>"
                                  <?php  }
                                  ?>        
                                </select>
                              </p>
					</div>

					<br>

					<div>
						<input class="input100" type="text" placeholder="Description" name="description">	
					</div>

					<br>

					<div class="files">
						<label>Add Attachment1: </label>
						<input type="file" name="uploadfile">
						<br>
						<br>
						<label>Add Attachment2: </label>
						<input type="file" name="uploadfile2">
					</div>

					<br>
                    <br>

						<button class="btn login100-form-btn" type="submit" name="submit">Submit</button>

				</form>

			</div>
		</div>

	
		<footer>
			<div class="credit"> VELVETY SYSTEM 2021 &copy; All Rights reserved</div>
		</footer>


</body>
</html>