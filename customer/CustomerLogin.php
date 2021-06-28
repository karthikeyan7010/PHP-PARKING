<?php
session_start();
include_once('Customer.php');


$user = new Customer();
$error="";
if(isset($_POST['login'])){
	$username = $_POST['uname'];
	$password = $_POST['upass'];

	$auth = $user->checkcustomer_login($username, $password);
    if($auth){
        $_SESSION['user'] = $auth;
		header('location:customerPage.php');
    }
    else{
        $error="username or password is invalid";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1" />
    <title>Custmer | Book Parking Slot</title>
</head>

<body>
		<h2 align="center">Customer Login</h2>
            	<form method="post" action="" enctype="multipart/form-data">
		  <div align="center">
		  
		  Username: <input type="text"  placeholder="username" id="custloginUsername" name="uname" required>
		  </div>
		  <div align="center" >
		  <br>
		  Password: <input type="password"   placeholder="Password" id="custloginPass" name="upass" required>
		  </div>
		   <br>
		  <div align="center">
		  <button type="submit" class="btn btn-primary" name="login" id="custloginSubmit">Login</button>
		  <a href="Register.php">Sign up</a>
		  <div>
		</form>
        <div align="center"><?php echo $error; ?></div>

		 
		</div>
        </div>
    </div>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</body>

</html>
