<!DOCTYPE html>
<html lang="en">
<title>PHP Project</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/full.css">

<!-- Optional theme -->
<link rel="stylesheet" href="assets/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="assets/js/bootstrap.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<body class="full">
    
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
<!--      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>-->
      <img alt="Brand" src="assets/img/logo.png" width="150" height="50">
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <!--<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">-->
      <ul class="nav navbar-nav">
        <li><a href="home.php">Home</a></li>
        <li><a href="profile.php">Profile</a></li>
        <li><a href="friends.php">Friends</a></li>
        <li><a href="message.php">Message</a></li>
      </ul>
      <form class="navbar-form navbar-left" role="search" method="get" action="search.php">
        <div class="form-group">
          <input type="text" id="search_name" name="search_name" value="" class="form-control">
        </div>
        <button type="submit" class="btn btn-default">Find</button>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="logout.php">Logout</a></li>
      </ul>
    <!--</div> /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

    

<div class="container">