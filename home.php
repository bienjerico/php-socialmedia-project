<?php 
session_start();

/* if session logged in is empty or 0 , redirect to index.php */
if(empty($_SESSION['logged_in']) || $_SESSION['logged_in']==0){
	header("location: index.php");
	exit();
}

include 'config/db.php';


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

<h1>Hello <?php echo $_SESSION['name']; ?>!</h1>



