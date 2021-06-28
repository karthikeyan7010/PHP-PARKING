<?php
session_start();

include_once('Customer.php');

if (!isset($_SESSION['user']) ||(trim ($_SESSION['user']) == '')){
	header('location:index.php');
}


$user = new Customer;

$sqlw1 = "SELECT * FROM customerDetails WHERE id = '".$_SESSION['user']."'";
$rowws = $user->details($sqlw1);


if(isset($_GET['wid']))
{
        $wid = $_POST['wid'];
        $amt = $_POST['walletAmt'];
	    $sid = $_SESSION['CUST_ID'];
        $user->SId($sid);

	$w = $row12['wallet'];
	$balance = $w-$amt;
	$et_time = date("h:i");

	$user->WalletUpdate($sid);

	$user->BookingUpdate($et_time,$wid);
}

?>

<!DOCTYPE html>
<html lang="en">
    <title>Customer | Book Parking Slot</title>
    
</head>

<body>
  			   	  <h3>Vehicle In List</h3>
  			   	  <a  href="customerPage.php">Logout</a>
	                          <table class="table">
	                                <thead>
	                                    <tr>
	                                      <th >#</th>
					      				 <th >Date</th>
	                                      <th >Area</th>
	                                      <th >Vehicle Type</th>
	                                      <th >Slot Type</th>
					     				  <th >In</th>
					      				  <th >Out</th>
					     				  <th >Status</th>
	                                      <th >Action</th>
	                                    </tr>
	                                  </thead>
	                                  <tbody>
	                                   <?php
	                                       $user->Cancel(); 
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


