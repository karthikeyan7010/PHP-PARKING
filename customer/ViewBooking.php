<?php
session_start();

include('Customer.php');

if (!isset($_SESSION['user']) ||(trim ($_SESSION['user']) == '')){
	header('location:index.php');
}

$user = new Customer();
$sql = "SELECT * FROM customerDetails WHERE id = '".$_SESSION['user']."'";
$row = $user->details($sql);


if(isset($_GET['wid']))
{
        $wid = $_GET['wid'];
        $amt = $_POST['cancelAmt'];
	    $reason = $_POST['reason'];
	    $parkCharge = $_POST['parkingcharge'];
        $user->SId($sid);
        $w = $row12['wallet'];
        $balance = $w-+ ($parkCharge-$amt);
        $user->Cancel1($amt,$reason,$wid);

        $user->WalletUpdate($sid);

        if ($result) {
                $msg = "Booking Cancelled successfully.";
        }
        else
        {
                $msg = "Booking not Cancel. Try Again Later.";
        }
        header("Location: ViewBooking.php?success=$msg");
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
					     				 <th >Payment Status</th>
	                                      <th >Action</th>
	                                    </tr>
	                                  </thead>
	                                  <tbody>
	                                   <?php
                                        $user->ViewBook();
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


