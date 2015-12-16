<?php 
session_start();

/* if session logged in is empty or 0 , redirect to index.php */
if(empty($_SESSION['logged_in']) || $_SESSION['logged_in']==0){
	header("location: index.php");
	exit();
}

include 'config/db.php';


$user_id = $_SESSION['user_id'];
$friend_id = $_GET['friend_id'];

    $query  = "SELECT * FROM users WHERE id=$friend_id LIMIT 1";
    $result = mysqli_query($db,$query);
    $row    = mysqli_fetch_assoc($result);
    
$query_msg_cnt = "SELECT count(*) as msg_cnt FROM users_messenger WHERE view_tag=0 AND receiver_id = $user_id and sender_id = $friend_id";
$result_msg_cnt = mysqli_query($db,$query_msg_cnt);
$msg_cnt    = mysqli_fetch_assoc($result_msg_cnt);    

if($msg_cnt['msg_cnt']>0){
    
    $update_viewtag = "UPDATE users_messenger SET view_tag = 1 WHERE view_tag=0 AND receiver_id = $user_id and sender_id = $friend_id";    
    mysqli_query($db,$update_viewtag);
 
}
  
if(isset($_POST['send-btn'])){
    $message = $_POST['message_txt'];
    
    $query = "INSERT INTO users_messenger (`sender_id`,`receiver_id`,`message`,`created_at`) VALUES ('$user_id','$friend_id','$message',now())";
    mysqli_query($db,$query);
    
    header("Location: ".$_SERVER['PHP_SELF'].'?friend_id='.$friend_id);
    exit();
}
 

$query_msg = "SELECT * FROM users_messenger WHERE (sender_id = $user_id AND receiver_id = $friend_id) OR (sender_id = $friend_id AND receiver_id = $user_id)";
$result_msg = mysqli_query($db,$query_msg);

?>


<?php include('header.php');?>


<?php while($msgr = mysqli_fetch_assoc($result_msg)){ ?>
    
    <?php if($msgr['sender_id']==$user_id){ ?>   
    
    <div style="text-align: right;">
        <?php echo $msgr['message']; ?>
        <br/>
        <span style="font-size: 8px;">Me : <?php echo $msgr['created_at']; ?></span>
        <br/>
    </div>    
    <?php } else {?>
    <div style="text-align: left;">
        <?php echo $msgr['message']; ?>
        <br/>
        <span style="font-size: 8px;"><?php echo $row['name'] ?> : <?php echo $msgr['created_at']; ?></span>
        <br/>
    </div> 
    <?php } ?>

<?php } ?>


<form action="<?php echo $_SERVER['PHP_SELF'].'?friend_id='.$friend_id; ?>" method="POST">
Send Message to <?php echo $row['name']; ?>
<textarea id="message_txt" name="message_txt"></textarea>
<button type="submit" id="send-btn" name="send-btn">Send</button>
</form>  