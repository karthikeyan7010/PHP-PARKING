<?php
session_start();
include_once('Customer.php');

if (!isset($_SESSION['user']) || (trim($_SESSION['user']) == ''))
{
    header('location:index.php');
}
$user = new Customer();
$sql = "SELECT * FROM customerDetails WHERE id = '" . $_SESSION['user'] . "'";
$row = $user->details($sql);
?>

<!DOCTYPE html>
<html lang="en">
    <title>Customer | Book Parking Slot</title>
</head>

<body>
	      <h2 align="center">CUSTOMER</h2>
	    </div>

	   
	    <div align="center">
  	       
		    <a  href="Booking.php">Book Parking Slot</a><br>
		    <a  href="ViewBooking.php">Booking Cancel</a><br>
		    <a  href="Wallet.php">Payment</a><br>
            <a  href="Vehicleout.php">Vehicle Out</a>
	    </div>
       
	    <div class="col">
	      <div class="dropdown float-right">
		  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		    Hi, <?php echo $row['Firstname']; ?>
		  </button>
		  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
		    <a class="dropdown-item" href="Myaccount.php">My Account</a>
		     <br>
		    <a class="dropdown-item" href="Changepassword.php">Change Password</a>
		     <br>
		    <a class="dropdown-item" href="logout.php">Logout</a>

		  </div>
		  <a  href="CustomerLogin.php">Logout</a>
		</div>
	    </div>
        </div>
    </div>

   
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</body>

</html>
