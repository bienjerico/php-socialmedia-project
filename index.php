<?php 

session_start();

/* if session logged in is empty or 0 , redirect to index.php */
if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']==1){
	header("location: home.php");
	exit();
}

include 'config/db.php';



/* user click the submit button */
if(isset($_POST['submit-login-btn'])){

	/* get the values */
	$emailaddress = $_POST['l-emailaddress'];
	$password = $_POST['l-password'];

	/* query select if username with password is existing */
	$query_cnt 	= "SELECT count(*) as cnt,name,is_admin,id FROM users WHERE emailaddress = '$emailaddress' and password=md5('$password') LIMIT 1";
	$result_cnt = mysqli_query($db,$query_cnt);
	$row_cnt    = mysqli_fetch_assoc($result_cnt);
	$cnt        = $row_cnt['cnt'];
	$name       = $row_cnt['name'];
	$is_admin   = $row_cnt['is_admin'];
	$user_id   = $row_cnt['id'];


	/* if zero, proceed to saving*/
	if($cnt>0){


		$_SESSION['user_id'] = $user_id;
		$_SESSION['name'] = $name;
		$_SESSION['emailaddress'] = $emailaddress;
		$_SESSION['is_admin'] = $is_admin;
		$_SESSION['logged_in'] = 1;


		/* redirect to register.php */
		header('location: home.php');
		exit();



	}else{

		/* insert the message in session */
		$_SESSION['message'] = "To Login, Please enter valid  username and password!";

		/* redirect to register.php */
		header('location: index.php');
		exit();

	}

	


}




/* user click the submit register button */
if(isset($_POST['submit-register-btn'])){

	/* get the values */
	$name = $_POST['r-name'];
	$emailaddress = $_POST['r-emailaddress'];
	$password = $_POST['r-password'];
	$con_password = $_POST['r-con_password'];


	/* query select if username is existing */
	$query_cnt 	= "SELECT count(*) as cnt FROM users WHERE emailaddress = '$emailaddress' LIMIT 1";
	$result_cnt = mysqli_query($db,$query_cnt);
	$row_cnt	= mysqli_fetch_assoc($result_cnt);
	$cnt 		= $row_cnt['cnt'];


	/* if zero, proceed to saving*/
	if($cnt==0){



		/* emailaddress, password and confirm passsowrd must not be empty and password must be equal to confirm password*/
		if(!empty($name) && !empty($emailaddress) && !empty($password) && !empty($con_password) && ($password==$con_password)){
			
			/* query insert to users table only emailaddress and password*/
			$query = "INSERT INTO users (`name`,`emailaddress`,`password`,`created_at`,`updated_at`) VALUES ('$name','$emailaddress',MD5('$password'),now(),now())";
			mysqli_query($db,$query);

			/* insert the message in session */
			$_SESSION['message'] = "Successfully Signed Up!";

			/* redirect to index.php */
			header('location: index.php');
			exit();


		}else{

			/* insert the message in session */
			$_SESSION['message'] = "To Sign Up, Please enter the valid data!";

			/* redirect to index.php */
			header('location: index.php');
			exit();

		}


	}else{

		/* insert the message in session */
		$_SESSION['message'] = "Email Adress is already existing!";

		/* redirect to register.php */
		header('location: index.php');
		exit();

	}

	

}



?>

<!DOCTYPE html>
<html lang="en">
<title>PHP Project</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/full.css">
<!-- Optional theme -->
<link rel="stylesheet" href="assets/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="assets/js/bootstrap.min.js"></script>
<style>
    .form-signin {
    max-width: 330px;
    padding: 15px;
    margin: 0 auto;
}
</style>
<body >
    <div class="container">

	<?php 

		/* if session message is not empty */
		if(!empty($_SESSION['message'])){ 
			echo $_SESSION['message']; 
		} 
	?>

	<form method="post" action="index.php"  class="form-signin">

		<h2 class="form-signin-heading">Please sign in</h2>
                <label for="l-emailaddress" class="sr-only">Email address</label>
                <input type="email" id="l-emailaddress" name="l-emailaddress" class="form-control" placeholder="Email address" required="" autofocus="">
                <label for="l-password" class="sr-only">Password</label>
                <input type="password" id="l-password" name="l-password" class="form-control" placeholder="Password" required="">
                <button class="btn btn-lg btn-primary btn-block" type="submit" id="submit-login-btn" name="submit-login-btn">Sign in</button>
        
                <br/>
                <h2 class="form-signup-heading">Not yet Registered? Sign Up</h2>
                <label for="r-name" class="sr-only">Name</label>
		<input type="text" id="r-name" name="r-name" value="" class="form-control" placeholder="Name"/>
		<br/>
		<label for="r-emailaddress" class="sr-only">Email address</label>
		<input type="text" id="r-emailaddress" name="r-emailaddress" value="" class="form-control" placeholder="Email address"/>
                <br/>
                <label for="r-password" class="sr-only">Password</label>
		<input type="password" id="r-password" name="r-password" value="" class="form-control" placeholder="Password"/>
		<br/>
		<label for="r-con_password" class="sr-only">Confirm Password</label>
		<input type="password" id="r-con_password" name="r-con_password" value="" class="form-control" placeholder="Confirm Password"/>
		<br/>
		<input class="btn btn-lg btn-primary btn-block" type="submit" id="submit-register-btn" name="submit-register-btn" value="Sign Up"/>
                

	</form>
        </div>
</body>
</html>

<?php 
/* remove the session message data */
unset($_SESSION['message']); 

?>

