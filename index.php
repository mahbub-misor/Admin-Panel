<?php
session_start();
include("php74.php");
if(isset($_REQUEST['signin'])){
	extract($_REQUEST);
	if($obj->login("users","*","username='$username'")!=false){
		$user_info=$obj->login("users","*","username='$username'");
		$password2=$user_info['password'];
		if(password_verify ($password , $password2)){
			
			$_SESSION['name']=$user_info['name'];
			header("location:dashboard.php");
			
		}
		else{
		$msg="Invalide Username/Password";		
		}
		
		
	}
	else{
			$msg="Invalide Username/Password";	
		}
}

if(isset($_SESSION['name'])){
	header("location:dashboard.php");
}
//Username: admin
//Passwor: rasmuslerdorf




if (isset($_REQUEST['signup'])) {
	/*echo "<pre>";
	print_r($_REQUEST);
	echo "</pre>";*/
	extract($_REQUEST);
    //$hash_password = $obj->encryptPassword($password);
    $hash_password = password_hash("$password",PASSWORD_DEFAULT);
	if ($obj->Insert("users","name='$name',username='$username',email='$email',password='$hash_password'")) {
		$msg = "<br>Insert Success!!";
	}
	else{
		$msg = "Insert Fail..";
	}

}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Admin Login</title>
<link rel="stylesheet" type="text/css" href="<?php echo $obj->current_url();?>assets/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<?php
echo @$msg;
?>

<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <div class="account-wall">
                <div id="my-tab-content" class="tab-content">
						<div class="tab-pane active" id="login">
               		    <img class="profile-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120"
                    alt="">
               			<form class="form-signin" action="index.php" method="post">
               				<input type="text" name="username" class="form-control" placeholder="Username" required autofocus>
               				<input type="password" name="password" class="form-control" placeholder="Password" required>
               				<input type="submit" name="signin" class="btn btn-lg btn-default btn-block" value="Sign In" />
               			</form>
               			<div id="tabs" data-tabs="tabs">
               				<p class="text-center"><a href="#register" data-toggle="tab">Need an Account?</a></p>
               				<p class="text-center"><a href="#select" data-toggle="tab">Select Account</a></p>
              				</div>
						</div>
						<div class="tab-pane" id="register">
							<form class="form-signin" action="index.php" method="post">
								<input type="text" name="name" class="form-control" placeholder="Name ..." required autofocus>
								<input type="text" name="username" class="form-control" placeholder="User Name ..." required autofocus>
								<input type="email" name="email" class="form-control" placeholder="Emaill Address ..." required>
								<input type="password" name="password" class="form-control" placeholder="Password ..." required>
								<input type="submit" name="signup" class="btn btn-lg btn-default btn-block" value="Sign Up" />
							</form>
							<div id="tabs" data-tabs="tabs">
               			<p class="text-center"><a href="#login" data-toggle="tab">Have an Account?</a></p>
              			</div>
						</div>
						<div class="tab-pane" id="select">
							<div id="tabs" data-tabs="tabs">
								<div class="media account-select">
									<a href="#user1" data-toggle="tab">
										<div class="pull-left">		
											<img class="select-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120"
                    alt="">
										</div>	 
										<div class="media-body">
											<h4 class="select-name">User Name 1</h4>
										</div>
									</a>
								</div>
                                <hr />
								<div class="media account-select">
									<a href="#user2" data-toggle="tab">
										<div class="pull-left">		
											<img class="select-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120"
                    alt="">
										</div>	 
										<div class="media-body">
											<h4 class="select-name">User Name 2</h4>
										</div>
									</a>
								</div>
                                <hr />
               			<p class="text-center"><a href="#login" data-toggle="tab">Back to Login</a></p>
              			</div>
						</div>
						<div class="tab-pane" id="user1">
							<img class="profile-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120"
                    alt="">
							<h3 class="text-center">User Name 1</h3>
							<form class="form-signin" action="" method="">
								<input type="hidden" class="form-control" value="User Name">
								<input type="password" class="form-control" placeholder="Password" autofocus required>
								<input type="submit" class="btn btn-lg btn-default btn-block" value="Sign In" />
							</form>
							<p class="text-center"><a href="#login" data-toggle="tab">Back to Login</a></p>
               		<p class="text-center"><a href="#select" data-toggle="tab">Select another Account</a></p>
						</div>
						<div class="tab-pane" id="user2">
							<img class="profile-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120"
                    alt="">
							<h3 class="text-center">User Name 2</h3>
							<form class="form-signin" action="" method="">
								<input type="hidden" class="form-control" value="User Name">
								<input type="password" class="form-control" placeholder="Password" autofocus required>
								<input type="submit" class="btn btn-lg btn-default btn-block" value="Sign In" />
							</form>
							<p class="text-center"><a href="#login" data-toggle="tab">Back to Login</a></p>
               		<p class="text-center"><a href="#select" data-toggle="tab">Select another Account</a></p>
						</div>
					</div>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="<?php echo $obj->current_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>