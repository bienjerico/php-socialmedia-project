<?php 
session_start();

/* if session logged in is empty or 0 , redirect to index.php */
if(empty($_SESSION['logged_in']) || $_SESSION['logged_in']==0){
	header("location: index.php");
	exit();
}

include 'config/db.php';

$username = $_SESSION['username'];

$query  = "SELECT * FROM users WHERE username='$username'";
$result = mysqli_query($db,$query);
$row 	= mysqli_fetch_assoc($result);


if(isset($_POST['submit-btn'])){
	


	$firstname = $_POST['firstname'];
	$middlename = $_POST['middlename'];
	$lastname = $_POST['lastname'];
	$gender = $_POST['gender'];
	$birthday = $_POST['birthday'];
	$age = $_POST['age'];
	$emailaddress= $_POST['emailaddress'];
	$address= $_POST['address'];
	$mobilenumber= $_POST['mobilenumber'];

	/* query update */
	$query = "UPDATE users SET firstname='$firstname', 
								middlename = '$middlename',
								lastname = '$lastname',
								gender = '$gender',
								birthday = '$birthday',
								age = '$age',
								emailaddress = '$emailaddress',
								address = '$address',
								mobilenumber = '$mobilenumber',
								updated_at = now()
				WHERE username = '$username'";
	mysqli_query($db,$query);

	/* insert the message in session */
	$_SESSION['message'] = "Successfully Updated!";

	/* redirect to profileedit.php */
	header('location: profileedit.php');
	exit();			


}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit Profile</title>
</head>
<body>
		
	<?php 

		/* if session message is not empty */
		if(!empty($_SESSION['message'])){ 
			echo $_SESSION['message']; 
		} 
	?>

<br/>
<a href="logout.php">Logout</a>
<br/>


<a href="home.php">HOME</a>
<a href="profile.php">PROFILE</a>

<h2>Hello <?php echo $row['username']; ?>,</h2>



<form method="post" action="profileedit.php">

	<label>Username : </label>
	<?php echo $row['username']; ?>
	<br/>
	<label>Firstname : </label>
	<input type="text" id="firstname" name="firstname" value="<?php echo  $row['firstname'] ?>" />
	<br/>
	<label>Middlename : </label>
	<input type="text" id="middlename" name="middlename" value="<?php echo  $row['middlename'] ?>" />
	<br/>
	<label>Lastname : </label>
	<input type="text" id="lastname" name="lastname" value="<?php echo  $row['lastname'] ?>" />
	<br/>
	<label>Gender : </label>
	<input type="text" id="gender" name="gender" value="<?php echo  $row['gender'] ?>" />
	<br/>
	<label>Birthday : </label>
	<input type="text" id="birthday" name="birthday" value="<?php echo  $row['birthday'] ?>" />
	<br/>
	<label>Age : </label>
	<input type="text" id="age" name="age" value="<?php echo  $row['age'] ?>" />
	<br/>
	<label>Email Address : </label>
	<input type="text" id="emailaddress" name="emailaddress" value="<?php echo  $row['emailaddress'] ?>" />
	<br/>
	<label>Address : </label>
	<input type="text" id="address" name="address" value="<?php echo  $row['address'] ?>" />
	<br/>
	<label>Mobile Number : </label>
	<input type="text" id="mobilenumber" name="mobilenumber" value="<?php echo  $row['mobilenumber'] ?>" />

	<br/>
	<br/>
	<input type="submit" id="submit-btn" name="submit-btn" value="Submit"/>

</form>


</body>
</html>

<?php 
/* remove the session message data */
unset($_SESSION['message']); 
?>