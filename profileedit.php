<?php 
session_start();

/* if session logged in is empty or 0 , redirect to index.php */
if(empty($_SESSION['logged_in']) || $_SESSION['logged_in']==0){
	header("location: index.php");
	exit();
}

include 'config/db.php';

$emailaddress = $_SESSION['emailaddress'];

$query  = "SELECT * FROM users WHERE emailaddress='$emailaddress'";
$result = mysqli_query($db,$query);
$row 	= mysqli_fetch_assoc($result);


if(isset($_POST['submit-btn'])){
	


	$name = $_POST['name'];
	$gender = $_POST['gender'];
	$birthday = $_POST['birthday'];
	$age = $_POST['age'];
	$address= $_POST['address'];
	$mobilenumber= $_POST['mobilenumber'];

        /* query update */
	$query = "UPDATE users SET name='$name', 
                                gender = '$gender',
                                birthday = '$birthday',
                                age = '$age',
                                address = '$address',
                                mobilenumber = '$mobilenumber',
                                updated_at = now()
				WHERE emailaddress = '$emailaddress'";
	mysqli_query($db,$query);

	/* insert the message in session */
	unset($_SESSION['name']);
        $_SESSION['name'] = $name;
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

<h2>Hello <?php echo $row['name']; ?>,</h2>



<form method="post" action="profileedit.php">

	<label>Name : </label>
        <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>">
	<br/>
	<label>Gender : </label>
        <select id="gender" name="gender">
            <option value="M" <?php echo ($row['gender']=='M') ? 'selected' : ''; ?>>M</option>
            <option value="F" <?php echo ($row['gender']=='F') ? 'selected' : ''; ?>>F</option>
        </select>
	<br/>
	<label>Birthday : </label>
	<input type="text" id="birthday" name="birthday" value="<?php echo  $row['birthday'] ?>" />
	<br/>
	<label>Age : </label>
	<input type="text" id="age" name="age" value="<?php echo  $row['age'] ?>" />
	<br/>
	<label>Email Address : </label>
	<?php echo  $row['emailaddress'] ?>
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