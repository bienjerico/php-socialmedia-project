<?php 
session_start();

/* if session logged in is empty or 0 , redirect to index.php */
if(empty($_SESSION['logged_in']) || $_SESSION['logged_in']==0){
	header("location: index.php");
	exit();
}

include 'config/db.php';


?>

<?php include('header.php');?>

<h1>Hello <?php echo $_SESSION['name']; ?>!</h1>



