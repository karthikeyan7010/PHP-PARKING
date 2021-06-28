<?php
include_once("Customer.php");
$user=new Customer();
if (isset($_POST['bookingAreaId']))
{
    
    $bookingAreaId = $_POST['bookingAreaId'];
    
    $user->CutTime($bookingAreaId);
    $cutoff = $row['cutofftime'];

    echo "<option>Select Available Time</option>";
    for ($i = 1;$i <= $cutoff;$i++)
    {
        echo "<option value=" . $i . ">" . $i . " hrs</option>";
    }
}



?>
