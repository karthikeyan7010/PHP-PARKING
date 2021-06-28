<?php
session_start();
include_once('Admin.php');

$user = new Admin();
$error="";
if(isset($_POST['login'])){
	$username = $_POST['uname'];
	$password = $_POST['upass'];

	$auth = $user->check_login($username, $password);
    if($auth){
        $_SESSION['user'] = $auth;
        header("location:Adminpage.php");
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
    <title>Admin | Book Parking Slot</title>
</head>

<body>
		<h2 align="center">Admin</h2>
            	<form method="post" action="AdminLogin.php">
		  <div align="center" >
		   
      Username: <input type="text"  placeholder="username" id="adminloginEmail" name="uname" required>
		  </div>
		  <div align="center">
		   
      Password  <input type="password"   placeholder="Password" id="adminloginPass" name="upass" required>
		  </div><br>
		  <div align="center">
		  <button type="submit" class="btn btn-primary" name="login" id="adminloginSubmit">Submit</button>
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
