<?php 
session_start();

/* if session logged in is empty or 0 , redirect to index.php */
if(empty($_SESSION['logged_in']) || $_SESSION['logged_in']==0){
	header("location: index.php");
	exit();
}

include 'config/db.php';

$user_id = $_SESSION['user_id'];
$search_name = strtolower($_GET['search_name']);
$user_id = $_SESSION['user_id'];


$query  = "SELECT a.id as id, a.name, a.age, a.address, b.user_id, b.status, b.id as users_friends_id "
        . "FROM users a "
        . "LEFT JOIN users_friends b "
        . " ON a.id = b.friend_id and b.user_id = '$user_id'    "
        . "WHERE LCASE(a.name) LIKE '%$search_name%' "
        . " and a.id != '$user_id' ";
$result = mysqli_query($db,$query);

?>
<?php include('header.php');?>

<?php while($row = mysqli_fetch_assoc($result)){ ?>

    Name : <?php echo $name = $row['name']; ?> 
    <br/>
    Age : <?php echo $age = $row['age']; ?>
    <br/>
    Address : <?php echo $address = $row['address']; ?>
    <br/>
    <?php if($row['status']==0){ ?>
        <?php if(empty($row['user_id'])){ ?>
        <a href="searchadd.php?search_id=<?php echo $row['id']; ?>&search_name=<?php echo $search_name; ?>"><button id="add-friend" name="add-friend" class="btn btn-success ">Add as Friend</button></a>
        <?php }else{ ?>
        <a href="searchaddcancel.php?users_friends_id=<?php echo $row['users_friends_id']; ?>&search_name=<?php echo $search_name; ?>"><button id="cancel-friend" name="cancel-friend" class="btn btn-danger ">Cancel Friend Request</button></a>
        <?php } ?>
        <?php }else{
            echo "Friend";
        } ?>
    <br/>

    
<?php } ?>

    
<?php include('footer.php');?>