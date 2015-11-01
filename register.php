<?php 

session_start();

/* if session logged in is empty or 0 , redirect to index.php */
if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']==1){
	header("location: index.php");
	exit();
}



include 'config/db.php';



/* user click the submit button */
if(isset($_POST['submit-btn'])){

	/* get the values */
	$username = $_POST['username'];
	$password = $_POST['password'];
	$con_password = $_POST['con_password'];


	/* query select if username is existing */
	$query_cnt 	= "SELECT count(*) as cnt FROM users WHERE username = '$username' LIMIT 1";
	$result_cnt = mysqli_query($db,$query_cnt);
	$row_cnt	= mysqli_fetch_assoc($result_cnt);
	$cnt 		= $row_cnt['cnt'];


	/* if zero, proceed to saving*/
	if($cnt==0){



		/* username, password and confirm passsowrd must not be empty and password must be equal to confirm password*/
		if(!empty($username) && !empty($password) && !empty($con_password) && ($password==$con_password)){
			
			/* query insert to users table only username and password*/
			$query = "INSERT INTO users (`username`,`password`,`created_at`,`updated_at`) VALUES ('$username',MD5('$password'),now(),now())";
			mysqli_query($db,$query);

			/* insert the message in session */
			$_SESSION['message'] = "Successfully Registered!";

			/* redirect to register.php */
			header('location: register.php');
			exit();


		}else{

			/* insert the message in session */
			$_SESSION['message'] = "Please enter the valid data!";

			/* redirect to register.php */
			header('location: register.php');
			exit();

		}


	}else{

		/* insert the message in session */
		$_SESSION['message'] = "Username is already existing!";

		/* redirect to register.php */
		header('location: register.php');
		exit();

	}

	


}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
</head>
<body>

	<?php 

		/* if session message is not empty */
		if(!empty($_SESSION['message'])){ 
			echo $_SESSION['message']; 
		} 
	?>

	<form method="post" action="register.php">
		
		<label>Username</label>
		<input type="text" id="username" name="username" value=""/>
		<br/>
		<label>Password</label>
		<input type="password" id="password" name="password" value=""/>
		<br/>
		<label>Confirm Password</label>
		<input type="password" id="con_password" name="con_password" value=""/>
		<br/>
		<input type="submit" id="submit-btn" name="submit-btn" value="Submit"/>
		<a href="index.php">Back to Login</a>

	</form>
		
</body>
</html>

<?php 
/* remove the session message data */
unset($_SESSION['message']); 
?>