<?php
include("Customer.php");

if(isset($_POST['custregSubmit']))
{
	$firstname=$_POST['Firstname'];
  	$lastname=$_POST['Lastname'];
 	 $email=$_POST['Email'];
 	 $mobileno=$_POST['MobileNo'];
  	$vehicleno=$_POST['VehicleNo'];
  	$password=$_POST['password'];

	$user=new Customer();
    $user->Registor($firstname,$lastname,$email,$mobileno,$vehicleno,$password);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1" />
    <title>Customer | Book Parking Slot</title>
    
    
</head>

<body>
    
		<h2 align="center">Register</h2>
		<form name="custregForm" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
		<div align="center">        
    First Name:<input type="text" name="Firstname" required><br><br>

    </div>
    <div align="center">
    Last Name:<input type="text" name="Lastname" required><br><br>
    </div>
    <div align="center">
    Password:<input type="password" name="password" required><br><br>
    </div>
    <div align="center">
    Email:<input type="email" name="Email" required><br><br>
    </div>
    <div align="center">
    Mobile Number:<input type="number" name="MobileNo" required><br><br>
    </div>
    <div align="center">
    VehicleNo:<input type="text" name="VehicleNo" required><br><br>
    </div>
    <div align="center">
		  <button type="submit" class="btn btn-primary" name="custregSubmit">Register</button>
		</form>
		</div>
        </div>
    </div>
    
</body>

</html>



