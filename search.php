<?php 
session_start();

/* if session logged in is empty or 0 , redirect to index.php */
if(empty($_SESSION['logged_in']) || $_SESSION['logged_in']==0){
	header("location: index.php");
	exit();
}

include 'config/db.php';

$search_name = strtolower($_GET['search_name']);

$query  = "SELECT a.id as id, a.name, a.age, a.address, b.user_id, b.status "
        . "FROM users a "
        . "LEFT JOIN users_friends b "
        . " ON a.id = b.user_id "
        . "WHERE LCASE(a.name) LIKE '%$search_name%'";
$result = mysqli_query($db,$query);

?>

<?php while($row = mysqli_fetch_assoc($result)){ ?>

    Name : <?php echo $name = $row['name']; ?> 
    <br/>
    Age : <?php echo $age = $row['age']; ?>
    <br/>
    Address : <?php echo $address = $row['address']; ?>
    <br/>
    <?php if(empty($row['status'])){ ?>
    <a href="searchadd.php?search_id=<?php echo $row['id']; ?>&search_name=<?php echo $search_name; ?>"><button id="add-friend" name="add-friend">Add as Friend</button></a>
    <?php }else{ ?>
    <a href="searchadd.php?search_id=<?php echo $row['id']; ?>&search_name=<?php echo $search_name; ?>"><button id="cancel-friend" name="cancel-friend">Cancel</button></a>
    <?php } ?>
    <br/>

    
<?php } ?>