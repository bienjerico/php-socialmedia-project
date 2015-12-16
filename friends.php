<?php 
session_start();

/* if session logged in is empty or 0 , redirect to index.php */
if(empty($_SESSION['logged_in']) || $_SESSION['logged_in']==0){
	header("location: index.php");
	exit();
}

include 'config/db.php';

$user_id = $_SESSION['user_id'];


$query_pending  = "SELECT a.*, b.name,b.id as users_id 
					FROM users_friends a 
					INNER JOIN users b ON a.user_id = b.id 
					WHERE a.friend_id = '$user_id' 
						and a.status = 0";
$result_pending = mysqli_query($db,$query_pending);


$query_request = "SELECT a.*, b.name 
			FROM users_friends a 
			INNER JOIN users b 
			ON a.friend_id = b.id 
			WHERE a.user_id = '$user_id'
			and a.status = 0";
$result_request = mysqli_query($db,$query_request);


$query_friends = "SELECT a.id,
			IF(a.user_id = '$user_id',(SELECT c.name FROM users c WHERE c.id = a.friend_id) , (SELECT c.name FROM users c WHERE c.id = a.user_id)) as name
			FROM users_friends a 
			INNER JOIN users b 
			ON a.friend_id = b.id 
			WHERE (a.user_id = '$user_id' or a.friend_id = '$user_id')
			and a.status = 1";
$result_friends = mysqli_query($db,$query_friends);


?>


<?php include('header.php');?>


<h4>Pending For Request</h4>
<?php while($row = mysqli_fetch_assoc($result_request)){ ?>
	
	<?php echo $row['name']; ?> 
	<a href="friendsrequestcancel.php?request_id=<?php echo $row['id']; ?>"><button>Cancel Pending Request</button></a>
	<br/>
<?php } ?>


<h4>Pending For Approval</h4>



<?php while($row = mysqli_fetch_assoc($result_pending)){ ?>
	
	<?php echo $row['name']; ?> 
	<a href="friendspendingaction.php?pending_id=<?php echo $row['id']; ?>&action=accept"><button>Accept</button></a>
	<a href="friendspendingaction.php?pending_id=<?php echo $row['id']; ?>&action=reject"><button>Reject</button></a>
	<br/>
<?php } ?>

<h4>Friends</h4>

<?php while($row = mysqli_fetch_assoc($result_friends)){ ?>
	
	<?php echo $row['name']; ?>
	<a href="friendsunfriend.php?friend_id=<?php echo $row['id']; ?>"><button>Unfriend</button></a>
	<br/>
<?php } ?>