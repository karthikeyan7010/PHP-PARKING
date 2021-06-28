<?php
session_start();
if (!isset($_SESSION['user']) ||(trim ($_SESSION['user']) == '')){
	header('location:index.php');
}
include_once('Customer.php');

$user = new Customer();
$sql = "SELECT * FROM customerDetails WHERE id = '".$_SESSION['user']."'";
$row = $user->details($sql);


if(isset($_GET['wid']))
{
        $wid = $_POST['wid'];
        $amt = $_POST['walletAmt'];
	    $sid = $_SESSION['user'];

        $user->wallet($wid);
}

?>

<!DOCTYPE html>
<html lang="en">
    <title>Customer | Book Parking Slot</title>
</head>

<body>

  			   	  <h3>View Booking</h3>
  			   	  <a  href="customerPage.php">Logout</a>
	                          <table class="table">
	                                <thead>
	                                    <tr>
	                                      <th >#</th>
					     				 <th >Date</th>
	                                      <th >Area</th>
	                                      <th >Vehicle Type</th>
	                                      <th >Slot Type</th>
					     				 <th >Status</th>
					      					<th >Amt</th>
	                                      <th >Action</th>
	                                    </tr>
	                                  </thead>
	                                  <tbody>
	                                   <?php
	                                   $user->wallet1();     
	                                        ?>
	                                </tbody>
	                          </table>

			</div>
                </div>
        </div>
   </div>

     
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


</body>

</html>


