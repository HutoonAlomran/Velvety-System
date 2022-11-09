<?php 

session_start();

	include("connection.php");

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$emp_number = $_POST['emp_number'];
		$password = md5($_POST['password']);

		if(!empty($emp_number) && !empty($password))
		{

			//read from database
			$query = "select * from employee where emp_number = '$emp_number' limit 1";
			$result = mysqli_query($conn, $query);

			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{
					$user_data = mysqli_fetch_assoc($result);
					
					if($user_data['password'] === $password)
					{
                                                                 
                                            $user_check_query = "SELECT id,emp_number,first_name,last_name,job_title FROM employee WHERE emp_number='$emp_number'";
                                            $result1 = mysqli_query($conn, $user_check_query);
                                            $user = mysqli_fetch_assoc($result1);

                                            $id=$user["id"];
                                            $emp_number=$user["emp_number"];
                                            $first_name=$user["first_name"];
                                            $last_name=$user["last_name"];
                                            $job_title=$user["job_title"];
                                            
                                            $_SESSION["id"]=$id;
                                            $_SESSION["emp_number"]=$emp_number;
                                            $_SESSION["first_name"]= $first_name;
                                            $_SESSION["last_name"]= $last_name;
                                            $_SESSION["job_title"]= $job_title;
                                            $_SESSION["role"]="employee";
                                            
                                           header("Location:EmployeeHomePage.php");
                                           
					}
				}
			}
			
			echo "wrong username or password!";
		}else
		{
			echo "Please enter valid inputs!";
		}
	}

?>




<!DOCTYPE html>
<html lang="en">
<head>
	<title>Creative system</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css.css">
<!--===============================================================================================-->
</head>
<body>

	<div class="topnav">
		<a class="active" href="index.php">Home</a>
		<a href="#news">News</a>
		<a href="#contact">Contact</a>
		<a href="#about">About</a>
	  </div>
	
	<div class="container">
		<div class="container-login">	
			<div class="wrap-login">
				<form class="login-form" method="post"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
					
					<a href="index.php" class="previous round"><</a>

					<span class="login-form-title">
						 	EMPLOYEE LOG IN
					</span>


					<div class="wrap-input">
						<input class="input" type="text" name="emp_number" placeholder="ID" required>
						<span class="focus-input"></span> 
						<span class="symbol-input">
							<i class="fa fa-envelope"></i>
						</span>
					</div>

					<div class="wrap-input">
						<input class="input" type="password" name="password" placeholder="Password" required>
						<span class="focus-input"></span>
						<span class="symbol-input">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<input type="submit" name="submit" id="submit" value="Login">
				</form>
			</div>
		</div>
	</div>

	<footer>
		<div class="credit"> VELVETY SYSTEM 2021 &copy; All Rights reserved</div>
	</footer>

</body>
</html>