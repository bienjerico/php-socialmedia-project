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


?>

<br/>
<a href="logout.php">Logout</a>
<br/>


<a href="home.php">HOME</a>
<a href="profile.php">PROFILE</a>

<h2>Hello <?php echo $row['username']; ?>,</h2>



<label>Username : </label>
<?php echo $row['username'] ?>
<br/>
<label>Firstname : </label>
<?php echo  $row['firstname'] ?>
<br/>
<label>Middlename : </label>
<?php echo $row['middlename'] ?>
<br/>
<label>Lastname : </label>
<?php echo  $row['lastname'] ?>
<br/>
<label>Gender : </label>
<?php echo  $row['gender'] ?>
<br/>
<label>Birthday : </label>
<?php echo  $row['birthday'] ?>
<br/>
<label>Age : </label>
<?php echo  $row['age'] ?>
<br/>
<label>Email Address : </label>
<?php echo $row['emailaddress'] ?>
<br/>
<label>Address : </label>
<?php echo  $row['address'] ?>
<br/>
<label>Mobile Number : </label>
<?php echo  $row['mobilenumber'] ?>

<br/>
<br/>
<a href="profileedit.php">Edit</a>