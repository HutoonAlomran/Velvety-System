<?php 

session_start();

	include("connection.php");

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$username = $_POST['username'];
		$password = md5($_POST['password']);

		if(!empty($username) && !empty($password))
		{

			//read from database
			$query = "select * from manager where username = '$username' limit 1";
			$result = mysqli_query($conn, $query);

			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{
					$user_data = mysqli_fetch_assoc($result);
					
					if($user_data['password'] === $password)
					{
                                                                 
                                            $user_check_query = "SELECT id,first_name,last_name,username FROM manager WHERE username='$username'";
                                            $result1 = mysqli_query($conn, $user_check_query);
                                            $user = mysqli_fetch_assoc($result1);

                                            $id=$user["id"];
                                            $username=$user["username"];
                                            $first_name=$user["first_name"];
                                            $last_name=$user["last_name"];
                                       
                                            $_SESSION["id"]=$id;
                                            $_SESSION["username"]=$username;
                                            $_SESSION["first_name"]= $first_name;
                                            $_SESSION["last_name"]= $last_name;
                                            $_SESSION["role"]="Manager";
                                            
                                           header("Location:managerHomePage.php");
                                          
					}
				}
			}
			
			echo "wrong email or passowrd!";
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
						 	MANAGER LOG IN
					</span>


					<div class="wrap-input">
						<input class="input" type="text" name="username" placeholder="username">
						<span class="focus-input"></span> 
						<span class="symbol-input">
							<i class="fa fa-envelope"></i>
						</span>
					</div>

					<div class="wrap-input" data-validate = "Password is required">
						<input class="input" type="password" name="password" placeholder="Password">
						<span class="focus-input"></span>
						<span class="symbol-input">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
						 
						<input type="submit" value="Login" class="login100-form-btn">
				</form>
			</div>
		</div>
	</div>

	<footer>
		<div class="credit"> VELVETY SYSTEM 2021 &copy; All Rights reserved</div>
	</footer>

</body>
</html>