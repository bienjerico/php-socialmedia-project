<?php 
session_start();

/* if session logged in is empty or 0 , redirect to index.php */
if(empty($_SESSION['logged_in']) || $_SESSION['logged_in']==0){
	header("location: index.php");
	exit();
}

include 'config/db.php';


$user_id = $_SESSION['user_id'];
$request_id = $_GET['request_id'];



    $query = "DELETE FROM users_friends WHERE id = '$request_id' ";
    mysqli_query($db,$query);


    
        $message = "Successfully Cancelled.";

?>

<br/>
<a href="logout.php">Logout</a>
<br/>


<a href="home.php">HOME</a>
<a href="profile.php">PROFILE</a>
<a href="friends.php">FRIENDS</a>
<form method="get" action="search.php">
Search Name: <input type="text" id="search_name" name="search_name" value=""> <button type="submit">Find</button>
</form>

<br/>
<?php echo $message; ?>
<br/>
<a href="friends.php"><button>Back to Friends</button></a>