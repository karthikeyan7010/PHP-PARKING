<?php
session_start();
include_once('Customer.php');



if (!isset($_SESSION['user']) || (trim($_SESSION['user']) == ''))
{
    header('location:index.php');
}

if (isset($_POST['confirmBooking']))
{
    $CArea = $_POST['confirmArea'];
    $CTVehicle = $_POST['confirmTVehicle'];
    $CSType = $_POST['confirmSType'];
    $CDate = $_POST['confirmDate'];
    $CSTime = $_POST['confirmSTime'];
    $CCTime = $_POST['confirmCTime'];
    $CPid = $_POST['confirmPid'];
    $CPAmt = $_POST['confirmPAmt'];
    $CCAmt = $_POST['confirmCancAmt'];
    $CSlot = $_POST['bookingNoSlot'];
    $CRegDate = date('d-m-Y');
    $cid = $_SESSION['CUST_ID'];

    $user =  new Customer();
    $user->Booking($CDate,$cid,$CArea,$CTVehicle,$CSType,$CSTime,$CCTime,$CSlot,$CPid,$CRegDate);

}
$user =  new Customer();
$sqlw1 = "SELECT * FROM customerDetails WHERE id = '" . $_SESSION['user'] . "'";
$rowws = $user->details($sqlw1);

?>

<!DOCTYPE html>
<html lang="en">
    <title>Customer | Book Parking Slot</title>
</head>

<body>
		<h3 align="center">Booking</h3>
		<div class="row">
		<div class="col-md-12 text-center">
             <form method="post" name="bookingForm" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype='multipart/form-data'>
              
               <div align="center">
				   Area:<select  id="bookingArea" name="bookingArea" required>
                        <option value="">Select Area</option>
							<?php
                                $user->AreaBook();
                            ?>
                        </select>
               </div><br>             
                 <div align="center">
                    Type of vehicle:<select id="bookingType" name="bookingType" required>
                        <option value="">Select type of vehicle</option>
                         <option value="simple">Simple</option>
                        <option value="heavy">Heavy</option>
                         </select>
                                   
                </div><br>
				  					
                <div align="center">
                     Date <input type="date" id="bookingDate" name="bookingDate" required>
                </div><br>
                                 
			    <div align="center">              
                Start time  <input type="time" id="bookingStartTime" name="bookingStartTime" required>
                </div><br>
                                 
                 <div align="center">
                                    
                     Cut of time :<select id="bookingTime" name="bookingTime" required>
                          <option value="">Select Cut Off Time</option>
                        </select>
                                
                </div><br>

                       
                <div align="center">
					<input type="hidden" name="bookingParkId" id="bookingParkId">
                    <button type="submit" class="btn btn-info" id="searchBooking" name="searchBooking">Search</button>
                    <a  href="customerPage.php">Logout</a>
                </div><br>
                                  
            </form>
			</div>
			</div>
               
		<div class="row">
			<div class="col-md-12 text-center">
				<hr>
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype='multipart/form-data' name="confirmBookingForm">
				<?php
if (isset($_POST['searchBooking']))
{
    $Area = $_POST['bookingArea'];
    $TypeVehicle = $_POST['bookingType'];
    $Date = $_POST['bookingDate'];
    $STime = $_POST['bookingStartTime'];
    $CTime = $_POST['bookingTime'];
    $Pid = $_POST['bookingParkId'];

    $user->Search($Pid);

    $slottype = $parking_res['slotcharge'];
    $slotperamt = $parking_res['slotperhour'];
    $slotcancamt = $parking_res['Cancellation'];

    echo "<input type='hidden' name='confirmArea' value=" . $_POST['bookingArea'] . "><input type='hidden' name='confirmTVehicle' value=" . $_POST['bookingType'] . "><input type='hidden' name='confirmSType' value=" . $slottype . "><input type='hidden' name='confirmDate' value=" . $_POST['bookingDate'] . "><input type='hidden' name='confirmSTime' value=" . $_POST['bookingStartTime'] . "><input type='hidden' name='confirmCTime' value=" . $_POST['bookingTime'] . "><input type='hidden' name='confirmPid' value=" . $_POST['bookingParkId'] . "><input type='hidden' name='confirmPAmt' value=" . $slotperamt . "><input type='hidden' name='confirmCancAmt' value=" . $slotcancamt . ">";

    echo "<p>Area : " . $_POST['bookingArea'] . " | Type of Vehicle : " . $_POST['bookingType'] . " | Date : " . $_POST['bookingDate'] . " | Start Time : " . $_POST['bookingStartTime'] . " </p>";
    
    $pslot = $parking_res['parkingslots'];

    $time = $STime + $CTime;

    $user->Slot($Date,$STime,$time,$Pid);

    echo "<button type='submit' class='btn btn-info' name='confirmBooking'>Book Now</button>";
}
?>
			   	</form>
			</div>
		</div>
        </div>
   </div>

   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
   
   <script>   
	$('#bookingArea').change(function() {

	var bookingAreaId = $(this).find(':selected').attr('data-id');

	$.ajax({
	        type:"POST",
	        url : "ajaxCall.php",
	        data : "bookingAreaId="+bookingAreaId,
	        success : function(response) {
	            $("#bookingTime").html(response);
		    $("#bookingParkId").val(bookingAreaId);
	        }
	    });
	});



   </script>

</body>

</html>
