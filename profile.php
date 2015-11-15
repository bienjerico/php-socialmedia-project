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


?>

<br/>
<a href="logout.php">Logout</a>
<br/>


<a href="home.php">HOME</a>
<a href="profile.php">PROFILE</a>

<h2>Hello <?php echo $row['name']; ?>,</h2>



<label>Name : </label>
<?php echo $row['name'] ?>
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