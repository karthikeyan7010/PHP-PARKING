<?php
session_start();
include_once('Admin.php');
if (!isset($_SESSION['user']) || (trim($_SESSION['user']) == ''))
{
    header('location:index.php');
}

if (isset($_POST['addParking']))
{
    $area = $_POST['Area'];
    $type = $_POST['vehicleType'];
    $slot = $_POST['parkingslots'];
    $slotcharge = $_POST['slotcharge'];
    $slotperhour = $_POST['slotperhour'];
    $cancel = $_POST['Cancellation'];
    $cutofftime = $_POST['cutofftime'];

    $add= new AddParking();
    $add->createParking($area,$type,$slot,$slotcharge,$slotperhour,$cancel,$cutofftime);
}
$user = new Admin();
$sql = "SELECT * FROM adminlogin WHERE id = '" . $_SESSION['user'] . "'";
$row = $user->details($sql);

?>

<!DOCTYPE html>
<html lang="en">
    <title>Admin | Book Parking Slot</title>
</head>

<body>
    <center>
				<h3>Add Parking Slot</h3>
				<form method="post" name="addParkingForm" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype='multipart/form-data'>
        <div><br>
       Area:<input type="text" name="Area"> 
    </div>
    <div><br>
        Type of  Vehicle:<select name="vehicleType" id="vehicleType">
            <option value="simple">Simple</option>
            <option value="Heavy">Heavy</option>
            </select>
    </div> <br>
    <div>
        No of Parking slot:<input type="number" id="number" name="parkingslots"> 
    </div> <br>
    <div>
        Slot charge:<select name="slotcharge" id="slotcharge">
            <option value="free">free</option>
            <option value="paid">paid</option>
            </select>
    </div><br>
    <div>
    <div>
        Slot charge per hour:<input type="number" id="number" name="slotperhour"> 
    </div> <br>
        
    <div>
        Cancellation charge:<input type="number" id="number" name="Cancellation"> 
    </div> <br>
        <div>
    cut off time:<select name="cutofftime" id="cutofftime">
            <option value="1hr">1 hour</option>
            <option value="2hr">2 hours</option>
            <option value="3hr">3 hours</option>
            <option value="4hr">more than 3 hours</option>
            </select>
        </div>
          <div>
            <button type="submit" id="addParking" name="addParking">Add</button>
            <a  href="Adminpage.php">logout</a>
				  </div>
				</form>
        </center>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


</body>

</html>
