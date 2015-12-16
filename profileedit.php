<?php 
session_start();

/* if session logged in is empty or 0 , redirect to index.php */
if(empty($_SESSION['logged_in']) || $_SESSION['logged_in']==0){
	header("location: index.php");
	exit();
}

include 'config/db.php';

$user_id = $_SESSION['user_id'];
$emailaddress = $_SESSION['emailaddress'];

$query  = "SELECT * FROM users WHERE emailaddress='$emailaddress'";
$result = mysqli_query($db,$query);
$row 	= mysqli_fetch_assoc($result);


if(isset($_POST['submit-btn'])){
	


	$name = $_POST['name'];
	$gender = $_POST['gender'];
	$birthday = $_POST['birthday'];
	$age = $_POST['age'];
	$address= $_POST['address'];
	$mobilenumber= $_POST['mobilenumber'];

        /* query update */
	$query = "UPDATE users SET name='$name', 
                                gender = '$gender',
                                birthday = '$birthday',
                                age = '$age',
                                address = '$address',
                                mobilenumber = '$mobilenumber',
                                updated_at = now()
				WHERE emailaddress = '$emailaddress'";
	mysqli_query($db,$query);

	/* insert the message in session */
	unset($_SESSION['name']);
        $_SESSION['name'] = $name;
        $_SESSION['message'] = "Successfully Updated!";

	/* redirect to profileedit.php */
	header('location: profileedit.php');
	exit();			


}



 if(isset($_FILES['image'])){
      $errors= "";
      $file_name = $_FILES['image']['name'];
      $file_size =$_FILES['image']['size'];
      $file_tmp =$_FILES['image']['tmp_name'];
      $file_type=$_FILES['image']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
      
      $expensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors ="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      $file_name_new = time().$file_name;
      
      if(empty($errors)==true){
         move_uploaded_file($file_tmp,"images/".$file_name_new);/* query update */
         
	$query_pic = "UPDATE users SET picture_location = 'images/$file_name_new' WHERE id = $user_id";
	mysqli_query($db,$query_pic);
        
         
         $_SESSION['message'] = "Successfully Uploaded!";
         
      }
      else{
         $_SESSION['message'] = $errors;
      }
      /* redirect to profileedit.php */
	header('location: profileedit.php');
	exit();	
      
   }
   
   

?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit Profile</title>
</head>
<body>
		
	<?php 

		/* if session message is not empty */
		if(!empty($_SESSION['message'])){ 
			echo $_SESSION['message']; 
		} 
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

<h2>Hello <?php echo $row['name']; ?>,</h2>

<img src="<?php echo $row['picture_location']; ?>" style="max-height:100px;width:100px;" >
<form action="profileedit.php" method="POST" enctype="multipart/form-data">
         <input type="file" name="image" />
         <input type="submit"/>
</form>

<br/>

<form method="post" action="profileedit.php">

	<label>Name : </label>
        <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>">
	<br/>
	<label>Gender : </label>
        <select id="gender" name="gender">
            <option value="M" <?php echo ($row['gender']=='M') ? 'selected' : ''; ?>>M</option>
            <option value="F" <?php echo ($row['gender']=='F') ? 'selected' : ''; ?>>F</option>
        </select>
	<br/>
	<label>Birthday : </label>
	<input type="text" id="birthday" name="birthday" value="<?php echo  $row['birthday'] ?>" />
	<br/>
	<label>Age : </label>
	<input type="text" id="age" name="age" value="<?php echo  $row['age'] ?>" />
	<br/>
	<label>Email Address : </label>
	<?php echo  $row['emailaddress'] ?>
	<br/>
	<label>Address : </label>
	<input type="text" id="address" name="address" value="<?php echo  $row['address'] ?>" />
	<br/>
	<label>Mobile Number : </label>
	<input type="text" id="mobilenumber" name="mobilenumber" value="<?php echo  $row['mobilenumber'] ?>" />

	<br/>
	<br/>
	<input type="submit" id="submit-btn" name="submit-btn" value="Submit"/>

</form>




</body>
</html>

<?php 
/* remove the session message data */
unset($_SESSION['message']); 
?>