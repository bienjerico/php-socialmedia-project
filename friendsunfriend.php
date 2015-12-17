<?php 
session_start();

/* if session logged in is empty or 0 , redirect to index.php */
if(empty($_SESSION['logged_in']) || $_SESSION['logged_in']==0){
	header("location: index.php");
	exit();
}

include 'config/db.php';


$user_id = $_SESSION['user_id'];
$friend_id = $_GET['friend_id'];




	$query = "DELETE FROM users_friends WHERE id = '$friend_id'";
	mysqli_query($db,$query);
	$message = "Successfully Unfriend";


?>
<?php include('header.php');?>

<br/>
<?php echo $message; ?>
<br/>
<a href="friends.php"><button class="btn btn-warning btn-sm">Back to Friends</button></a>

<?php include('footer.php');?>