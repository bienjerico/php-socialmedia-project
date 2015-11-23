<?php 
session_start();

/* if session logged in is empty or 0 , redirect to index.php */
if(empty($_SESSION['logged_in']) || $_SESSION['logged_in']==0){
	header("location: index.php");
	exit();
}

include 'config/db.php';

$search_name = strtolower($_GET['search_name']);
$user_id = $_SESSION['user_id'];


$query  = "SELECT a.id as id, a.name, a.age, a.address, b.user_id, b.status "
        . "FROM users a "
        . "LEFT JOIN users_friends b "
        . " ON a.id = b.friend_id and b.user_id='$user_id' "
        . "WHERE LCASE(a.name) LIKE '%$search_name%'";
$result = mysqli_query($db,$query);

?>


<br/>
<a href="logout.php">Logout</a>
<br/>


<a href="home.php">HOME</a>
<a href="profile.php">PROFILE</a>
<form method="get" action="search.php">
Search Name: <input type="text" id="search_name" name="search_name" value="<?php echo $_GET['search_name']; ?>"> <button type="submit">Find</button>
</form>


<?php while($row = mysqli_fetch_assoc($result)){ ?>

    Name : <?php echo $name = $row['name']; ?> 
    <br/>
    Age : <?php echo $age = $row['age']; ?>
    <br/>
    Address : <?php echo $address = $row['address']; ?>
    <br/>
    <?php if(empty($row['user_id'])){ ?>
    <a href="searchadd.php?search_id=<?php echo $row['id']; ?>&search_name=<?php echo $search_name; ?>"><button id="add-friend" name="add-friend">Add as Friend</button></a>
    <?php }else{ ?>
    <a href="searchaddcancel.php?search_id=<?php echo $row['id']; ?>&search_name=<?php echo $search_name; ?>"><button id="cancel-friend" name="cancel-friend">Cancel Friend Request</button></a>
    <?php } ?>
    <br/>

    
<?php } ?>