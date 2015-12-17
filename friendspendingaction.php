<?php 
session_start();

/* if session logged in is empty or 0 , redirect to index.php */
if(empty($_SESSION['logged_in']) || $_SESSION['logged_in']==0){
	header("location: index.php");
	exit();
}

include 'config/db.php';


$user_id = $_SESSION['user_id'];
$pending_id = $_GET['pending_id'];
$action = $_GET['action'];


$message = "Something went wrong. Please try again.";
if($action=='accept'){
	$query = "UPDATE users_friends SET status = 1, accepted_at = now() WHERE id = '$pending_id'";
	mysqli_query($db,$query);
	$message = "Successfully Accepted.";
}

if($action=='reject'){
	$query = "DELETE FROM users_friends WHERE id = '$pending_id'";
	mysqli_query($db,$query);
	$message = "Successfully Rejected.";
}


?>
<?php include('header.php');?>

<br/>
<?php echo $message; ?>
<br/>
<a href="friends.php"><button>Back to Friends</button></a>

<?php include('footer.php');?>