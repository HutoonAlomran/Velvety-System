<?php 
session_start();

	include("connection.php");

        function test_input($data) {
                      $data = trim($data);
                      $data = stripslashes($data);
                      $data = htmlspecialchars($data);
                      return $data;
                      }        
        
	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
                $emp_number = test_input($_POST['emp_number']);
                $first_name = test_input($_POST['first_name']);
		$last_name = test_input($_POST['last_name']);
                $job_title = test_input($_POST['job_title']);
		$password = test_input($_POST['password']);
              

		if(!empty($emp_number)&&!empty($first_name) && !empty($last_name) && !empty($job_title) && !empty($password))
		{       
                        //sanatize user inputs  
                        $emp_number =  mysqli_real_escape_string($conn, $_REQUEST['emp_number']);
                        $first_name = mysqli_real_escape_string($conn, $_REQUEST['first_name']);
                        $last_name = mysqli_real_escape_string($conn, $_REQUEST['last_name']);
                        $job_title = mysqli_real_escape_string($conn, $_REQUEST['job_title']);
                        $password = md5(mysqli_real_escape_string($conn, $_REQUEST['password'])); //password is hashed
                        
                        
			//check existance of the user
                        $select = mysqli_query($conn, "SELECT * FROM employee WHERE emp_number = '".$_POST['emp_number']."'");
                        if(mysqli_num_rows($select)) {
                            echo "This username already exists, please login";
                        }
                        else{ //save new user
                        
                            
			$query = "insert into employee (emp_number,first_name,last_name,job_title,password) values ('$emp_number','$first_name','$last_name','$job_title','$password')";
			mysqli_query($conn, $query);

                        $user_check_query = "SELECT id,emp_number,first_name,last_name,job_title FROM employee WHERE emp_number='$emp_number'";
                        $result1 = mysqli_query($conn, $user_check_query);

                        while( $user = mysqli_fetch_assoc($result1)){
                        $id=$user["id"];
                        $emp_number=$user["emp_number"];
                        $first_name=$user["first_name"];
                        $last_name=$user["last_name"];
                        $job_title=$user["job_title"];
                        }   
                        
                        $_SESSION["id"]=$id;
                        $_SESSION["emp_number"]=$emp_number;
                        $_SESSION["first_name"]= $first_name;
                        $_SESSION["last_name"]= $last_name;
                        $_SESSION["job_title"]= $job_title;
                        $_SESSION["role"]="employee";
                         
                        header("Location:EmployeeHomePage.php");
                        die;
                        }
		}else
		{
			echo "Please enter some valid information!";
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
				
				<form class="login-form validate-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
					<a href="index.php" class="previous round"><</a>



					<span class="login-form-title">
						 	SIGN UP
					</span>
                                        <label>ID</label>
					<div class="wrap-input">
                                            <input class="input" type="text" name="emp_number" pattern="[0-9]{3,15}" title="Please enter 3-15 Digits" placeholder=" enter 3-15 Digits only" required>
						<span class="focus-input"></span> <!--for icons-->
					</div>

                                        <label>First Name</label>
					<div class="wrap-input">
						<input class="input" type="text" name="first_name" pattern="[a-zA-Z]*" title="Please enter letters only"  placeholder="letters only" required>
						<span class="focus-input"></span> <!--for icons-->
					</div>

                                        <label>Last Name</label>
					<div class="wrap-input">
						<input class="input" type="text" name="last_name" pattern="[a-zA-Z]*" title="Please enter letters only"   placeholder="letters only"  required>
						<span class="focus-input"></span> <!--for icons-->
					</div>

                                        <label>Job titles</label>
					<div class="wrap-input">
						<input class="input" type="text" name="job_title" pattern="[a-zA-Z]*" title="Please enter letters only"   placeholder="letters only" required>
						<span class="focus-input"></span> <!--for icons-->
					</div>

                                        <label>Password</label>
					<div class="wrap-input" >
						<input class="input" type="password" name="password" pattern=".{6,}" title="Please enter Six or more characters" title="1-UpperCase letter
                                                                                                                                                                        1-lower letter
                                                                                                                                                                        1- number "  placeholder="******" required>
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