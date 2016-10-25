<?php
session_start();
if(isset($_REQUEST['action'])){
	session_destroy();
	header("location:index.php");	
}
if(!isset($_SESSION['name'])){
	//header("location:index.php");
	?>
     <a href="index.php">Back to Home</a>
    <?php
	die("Un Authorized access");
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<h2>Welcome to <?php echo $_SESSION['name'];?></h2><a href="dashboard.php?action=logout">Logout</a>
</body>
</html>