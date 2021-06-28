<?php
session_start();
include_once('Admin.php');
if (!isset($_SESSION['user']) || (trim($_SESSION['user']) == ''))
{
    header('location:index.php');
}
include_once('Admin.php');
$user = new Admin();
$sql = "SELECT * FROM adminlogin WHERE id = '" . $_SESSION['user_id'] . "'";
$row = $user->details($sql);
?>

<!DOCTYPE html>
<html lang="en">
    <title>Admin | Book Parking Slot</title>
</head>

<body>

			 <h3>View Parking Slot</h3>
			 <a  href="Adminpage.php">logout</a>
			  <table class="table">
				<thead>
				    <tr>
				      <th>Area</th>
				      <th>Type of Vehicle</th>
				      <th>No. of Parking Slot</th>
				      <th>Slot Type</th>
				      <th>Charge /hr</th>
				      <th>Cancelation Charge</th>
				    </tr>
				  </thead>
				  <tbody>
					<?php
$display=new AddParking();
$display->fetchP();
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
