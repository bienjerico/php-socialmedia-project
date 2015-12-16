<?php 
session_start();

/* if session logged in is empty or 0 , redirect to index.php */
if(empty($_SESSION['logged_in']) || $_SESSION['logged_in']==0){
	header("location: index.php");
	exit();
}

include 'config/db.php';


$user_id = $_SESSION['user_id'];
$users_friends_id = strtolower($_GET['users_friends_id']);
$search_name = strtolower($_GET['search_name']);



    $query = "DELETE FROM users_friends WHERE id = '$users_friends_id' ";
    mysqli_query($db,$query);


    
        $message = "Successfully Cancelled.";

?>

<?php include('header.php');?>

<br/>
<?php echo $message; ?>
<br/>
<a href="search.php?search_name=<?php echo $search_name; ?>"><button>Back to Search</button></a>

