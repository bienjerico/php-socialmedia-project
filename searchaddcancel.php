<<<<<<< HEAD
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

=======
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

<br/>
<a href="logout.php">Logout</a>
<br/>


<a href="home.php">HOME</a>
<a href="profile.php">PROFILE</a>
<a href="friends.php">FRIENDS</a>
<form method="get" action="search.php">
Search Name: <input type="text" id="search_name" name="search_name" value="<?php echo $search_name; ?>"> <button type="submit">Find</button>
</form>

<br/>
<?php echo $message; ?>
<br/>
<a href="search.php?search_name=<?php echo $search_name; ?>"><button>Back to Search</button></a>
>>>>>>> 1a229e4230cd2399305a7dbad41c63856bcdd0e5
