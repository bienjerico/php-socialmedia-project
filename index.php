<?php 

session_start();

/* if session logged in is empty or 0 , redirect to index.php */
if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']==1){
	header("location: home.php");
	exit();
}

include 'config/db.php';



/* user click the submit button */
if(isset($_POST['submit-btn'])){

	/* get the values */
	$username = $_POST['username'];
	$password = $_POST['password'];
	$user 	  = $_POST['user'];

	$is_admin = 0;
	if($user=='admin'){
		$is_admin = 1;
	}




	/* query select if username with password is existing */
	$query_cnt 	= "SELECT count(*) as cnt FROM users WHERE username = '$username' and password=md5('$password') and is_admin='$is_admin' LIMIT 1";
	$result_cnt = mysqli_query($db,$query_cnt);
	$row_cnt	= mysqli_fetch_assoc($result_cnt);
	$cnt 		= $row_cnt['cnt'];


	/* if zero, proceed to saving*/
	if($cnt>0){


		$_SESSION['username'] = $username;
		$_SESSION['logged_in'] = 1;


		/* redirect to register.php */
		header('location: home.php');
		exit();



	}else{

		/* insert the message in session */
		$_SESSION['message'] = "Please enter valid  username and password!";

		/* redirect to register.php */
		header('location: index.php');
		exit();

	}

	


}




?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body>


<?php if(isset($_GET['user']) && $_GET['user']=='admin'){ ?>
<a href="index.php">Login as Guest</a>
<?php }else{ ?>
<a href="index.php?user=admin">Login as Admin</a>
<?php } ?>
<br/>

	<?php 

		/* if session message is not empty */
		if(!empty($_SESSION['message'])){ 
			echo $_SESSION['message']; 
		} 
	?>

	<form method="post" action="index.php">

		<label>Username</label>
		<input type="text" id="username" name="username" value=""/>
		<br/>
		<label>Password</label>
		<input type="text" id="password" name="password" value=""/>
		<br/>
		<input type="hidden" id="user"  name="user" value="<?php echo isset($_GET['user']) ? 'admin' :  ''; ?>"/>
		<input type="submit" id="submit-btn" name="submit-btn" value="Submit"/>
		<a href="register.php">Not yet Registered?</a>

	</form>
</body>
</html>


<?php 
/* remove the session message data */
unset($_SESSION['message']); 
?>

