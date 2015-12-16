<?php 
session_start();

/* if session logged in is empty or 0 , redirect to index.php */
if(empty($_SESSION['logged_in']) || $_SESSION['logged_in']==0){
	header("location: index.php");
	exit();
}

include 'config/db.php';


$user_id = $_SESSION['user_id'];


$query_friends = "SELECT a.id,
			IF(a.user_id = '$user_id',(SELECT c.name FROM users c WHERE c.id = a.friend_id) , (SELECT c.name FROM users c WHERE c.id = a.user_id)) as name,
			IF(a.user_id = '$user_id',(SELECT  d.id FROM users d WHERE d.id = a.friend_id) , (SELECT d.id FROM users d WHERE d.id = a.user_id)) as friend_id,
                        (SELECT count(*) FROM users_messenger e WHERE e.sender_id = IF(a.user_id = '$user_id',(SELECT  d.id FROM users d WHERE d.id = a.friend_id) , (SELECT d.id FROM users d WHERE d.id = a.user_id)) AND e.receiver_id = $user_id AND e.view_tag = 0) as  message_count
			FROM users_friends a 
			INNER JOIN users b 
			ON a.friend_id = b.id 
			WHERE (a.user_id = '$user_id' or a.friend_id = '$user_id')
			and a.status = 1";
$result_friends = mysqli_query($db,$query_friends);


?>



<?php include('header.php');?>


<?php while($row = mysqli_fetch_assoc($result_friends)){ ?>
	
	<?php echo $row['name']; ?>
        <?php if($row['message_count']>0){ echo '('.$row['message_count'].')'; } ?>
	<a href="messagefriend.php?friend_id=<?php echo $row['friend_id']; ?>"><button>Message</button></a>
	<br/>
<?php } ?>

        