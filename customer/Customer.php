
<?php 
include_once("db.php");
class Customer extends DbConnection{

    public function __construct(){

        parent::__construct();
    }
    
    public function checkcustomer_login($username, $password){

      $sql = "SELECT * FROM customerDetails WHERE Firstname='$username' AND password='$password'";
	  
        $query = $this->connection->query($sql);
    
		 
        if($query->num_rows > 0){
           $row = $query->fetch_array();
		  
            return $row['id'];
			
        }
        else{
			
            return false;
        }
		
    }
        
    public function details($sql){

        $query = $this->connection->query($sql);
        
        $row = $query->fetch_array();
            
        return $row;       
    }
    
    public function Booking($CDate,$cid,$CArea,$CTVehicle,$CSType,$CSTime,$CCTime,$CSlot,$CPid,$CRegDate){
        $sql = $this->connection->query("INSERT INTO booking (date,cid,status,area,vehicle_type,slot_type,st_time,cut_time,slot_no,amt,amt_status,pid,regdate) VALUES ('$CDate','$cid','Booked','$CArea','$CTVehicle','$CSType','$CSTime','$CCTime','$CSlot','$CPAmt','','$CPid','$CRegDate')");
    if ($sql)
    {
        $success = "Slot Successfully booked.";
    }
    else
    {
        $success = "Server Problem, Try Again Later";
    }
    header("Location: Wallet.php?success=" . $success);

    }
    public function AreaBook()
    {
        $sql = $this->connection->query("SELECT  Area,id FROM addparking");
        while ($res = $sql->fetch_assoc())
{
?>
								<option data-id="<?php echo $res['id']; ?>" value="<?php echo $res['Area']; ?>"><?php echo $res['Area']; ?></option>
							<?php
}
    }

    public function Search($Pid){
        global $parking_res;
        $parking_sql = $this->connection->query("SELECT * FROM addparking WHERE id='$Pid'");
        $parking_res = $parking_sql->fetch_assoc();
    
    }

    public function Slot($Date,$STime,$time,$Pid)
    {
        global $pslot;
        for ($i = 1;$i <= $pslot;$i++)
    {
        $book_chk_sql = $this->connection->query("SELECT * FROM booking WHERE date='$Date' AND st_time BETWEEN '$STime' AND '$time' AND pid='$Pid' AND slot_no='$i' AND status='Booked'");
?>
							<div class="alert alert-<?php if ($book_chk_sql->num_rows > 0)
        {
            echo 'success';
        }
        else
        {
            echo 'dark';
        } ?> col-md-2 float-left ml-4" role="alert"><input type="radio" name="bookingNoSlot" value="<?php echo $i; ?>" <?php if ($book_chk_sql->num_rows > 0)
        {
            echo "disabled";
        } ?>> Slot <?php echo $i; ?></div>
						<?php
    }
    }


    public function CutTime($bookingAreaId){
        global $row;
        $sql = $this->connection->query("SELECT * FROM addparking WHERE id='$bookingAreaId'");
        $row = $sql->fetch_assoc();
    }

    public function wallet($wid){
        $sql = "UPDATE booking SET amt_status='PAID' WHERE id='$wid'";
        $result = $this->connection->query($sql);

        if ($result) {
                $msg = "Amount paid successfully.";
        }
        else
        {
                $msg = "Amount not paid. Try Again Later.";
        }
        header("Location: Wallet.php?success=$msg");
    }
    
    public function wallet1(){
        $res_parking = $this->connection->query("SELECT * FROM booking");
	                                        while($row = $res_parking->fetch_assoc()) {
	                                        ?>
	                                        <tr>
	                                         <td><?php echo $row["id"]; ?></td>
											 <td><?php echo $row["date"]; ?></td>
	                                         <td><?php echo $row["area"]; ?></td>
	                                         <td><?php echo $row["vehicle_type"]; ?></td>
	                                         <td><?php echo $row["slot_type"]; ?></td>
						 						<td><?php echo $row["status"]; ?></td>
						 					<td><?php echo $row["cut_time"] * $row["amt"]; ?></td>
	                                         <td><?php if($row['amt_status'] == ""){ if($row['slot_type'] == "paid"){ ?> <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addMoney<?php echo $row['id']; ?>">Pay Now</button> <?php }}else{ echo "<b class='text-danger'>PAID</b>"; } ?> </td>
	                                        </tr>

						  
	                                         <div class="modal fade" id="addMoney<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	                                          <div class="modal-dialog" role="document">
	                                            <div class="modal-content">
	                                              <div class="modal-header">
	                                                <h5 class="modal-title" id="exampleModalLabel">Offline Payment</h5>
	                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                                                  <span aria-hidden="true">&times;</span>
	                                                </button>
	                                              </div>
	                                             <form action="Wallet.php?wid=<?php echo $row['id']; ?>" method="post" name="addMoneyToWalletForm" enctype="multipart/form-data">
	                                              <div class="modal-body">
	                                                  <div class="form-group">
	                                                    <label for="recipient-name" class="col-form-label">Paid amount(Rs.) :</label>
	                                                    <input type="text" class="form-control" id="walletAmt" name="walletAmt" required value="<?php echo $row['cut_time'] * $row['amt']; ?>" readonly>
	                                                    <input type="hidden" name="wid" value="<?php echo $row['id']; ?>">
	                                                  </div>
	                                              </div>
	                                              <div class="modal-footer">
	                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	                                                <button type="submit" class="btn btn-primary" name="addMoneyToWallet">Confirm</button>
	                                              </div>
	                                              </form>
	                                            </div>
	                                          </div>
	                                        </div>

	                                        <?php
	                                        }
    }
    
    public function GetId()
    {
        global $row;
        $get_id = $_SESSION['user'];
        $get_data = $this->connection->query("SELECT * FROM customerDetails WHERE id='$get_id'");
        $row = $get_data->fetch_assoc();
    }

    public function edit($firstname,$lastname,$email,$mobileno,$vehicleno,$password,$Uid){
        $sql = "UPDATE customerDetails SET ";
        $sql .= "Firstname='$firstname',Lastname='$lastname',Email='$email',MobileNo='$mobileno',VehicleNo='$vehicleno', password='$password'  WHERE id='$Uid'";

    $result = $this->connection->query($sql);
    if ($result)
    {
        $msg = "Record successfully updated.";
    }
    else
    {
        $msg = "Record not updated.";
    }


	header("Location: Myaccount.php");
}

    public function SId($sid){
        global $row12;
        $res_parking = $this->connection->query("SELECT * FROM customerDetails where id='$sid' ");
        $row12 = $res_parking->fetch_assoc();
    }

    public function WalletUpdate($sid){
        $wallet_update = "UPDATE customerDetails SET wallet='$balance' WHERE id='$sid'";
	    $this->connection->query($wallet_update);
    }
    

    public function BookingUpdate($et_time,$wid){
        $sql = "UPDATE booking SET status='OUT',et_time='$et_time' WHERE id='$wid'";
        $result = $this->connection->query($sql);

        if ($result) {
                $msg = "Vehicle Out successfully.";
        }
        else
        {
                $msg = "Vehicle Not Out. Try Again Later.";
        }
        header("Location: Vehicleout.php?success=$msg");
    }

    public function Cancel(){
        $res_parking = $this->connection->query("SELECT * FROM booking WHERE status!='Cancelled'");
	                                        while($row = $res_parking->fetch_assoc()) {
	                                        ?>
	                                        <tr>
	                                         <td><?php echo $row["id"]; ?></td>
						 <td><?php echo $row["date"]; ?></td>
	                                         <td><?php echo $row["area"]; ?></td>
	                                         <td><?php echo $row["vehicle_type"]; ?></td>
	                                         <td><?php echo $row["slot_type"]; ?></td>
						 <td><?php echo $row["st_time"]; ?></td>
						 <td><?php echo $row["et_time"]; ?></td>
						 <td><?php echo $row["status"]; ?></td>
	                                         <td><?php if($row['status'] != "OUT"){ ?>  <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addMoney<?php echo $row['id']; ?>">Out</button> <?php } ?> </td>
	                                        </tr>

						 
	                                         <div class="modal fade" id="addMoney<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	                                          <div class="modal-dialog" role="document">
	                                            <div class="modal-content">
	                                              <div class="modal-header">
	                                                <h5 class="modal-title" id="exampleModalLabel">Vehicle Out</h5>
	                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                                                  <span aria-hidden="true">&times;</span>
	                                                </button>
	                                              </div>
	                                             <form action="Vehicleout.php?wid=<?php echo $row['id']; ?>" method="post" name="addMoneyToWalletForm" enctype="multipart/form-data">
	                                              <div class="modal-body">
	                                                  <div class="form-group">
	                                                    <label for="recipient-name" class="col-form-label">Deduct amount(Rs.) :</label>
	                                                    <input type="text" class="form-control" id="walletAmt" name="walletAmt" required value="<?php echo $row['cut_time'] * $row['amt']; ?>" readonly>
	                                                    <input type="hidden" name="wid" value="<?php echo $row['id']; ?>">
	                                                  </div>
	                                              </div>
	                                              <div class="modal-footer">
	                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	                                                <button type="submit" class="btn btn-primary" name="addMoneyToWallet">Confirm</button>
	                                              </div>
	                                              </form>
	                                            </div>
	                                          </div>
	                                        </div>

	                                        <?php
	                                        }
    }

    public function Cancel1($amt,$reason,$wid){
        global $result;
        $sql = "UPDATE booking SET status='Cancelled',canc_charge='$amt',canc_reason='$reason' WHERE id='$wid'";
        $result = $this->connection->query($sql);
    }

    public function ViewBook(){
        $todayDate = date('Y-m-d');
	                                        $res_booking = $this->connection->query("SELECT * FROM booking Where date > $todayDate");
	                                        while($row = $res_booking->fetch_assoc()) {
	                                        ?>
	                                        <tr>
	                                         <td><?php echo $row["id"]; ?></td>
											 <td><?php echo $row["date"]; ?></td>
	                                         <td><?php echo $row["area"]; ?></td>
	                                         <td><?php echo $row["vehicle_type"]; ?></td>
	                                         <td><?php echo $row["slot_type"]; ?></td>
												 <td><?php echo $row["status"]; ?></td>
						 						<td><?php echo $row["amt_status"]; ?></td>
	                                         <td><?php if($row['status'] != "Cancelled"){ ?> <button type="button" class="btn btn-info" data-toggle="modal" data-target="#cancelBooking<?php echo $row['id']; ?>">Booking Cancel</button>  <?php } else { echo "<b class='text-danger'>Cancelled</b>"; } ?> </td>
	                                        </tr>

						<?php
							$pid = $row['pid'];
							$res_parking = $this->connection->query("SELECT * FROM addparking Where id='$pid'");
		                                        $row_park = $res_parking->fetch_assoc();
						 ?>
                                                 <div class="modal fade" id="cancelBooking<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                  <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                      <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Booking Cancel</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                        </button>
                                                      </div>
                                                     <form action="ViewBooking.php?wid=<?php echo $row['id']; ?>" method="post" name="bookingCancelForm" enctype="multipart/form-data">
                                                      <div class="modal-body">
                                                          <div class="form-group">
                                                            <label for="recipient-name" class="col-form-label">Cancel Amount (Rs.) :</label>
                                                            <input type="text" class="form-control" id="cancelAmt" name="cancelAmt" required value="<?php echo $row_park['Cancellation'];  ?>" readonly>
                                                            <input type="hidden" name="wid" value="<?php echo $row['id']; ?>">
							    <input type="hidden" name="parkingcharge" value="<?php echo $row['amt']; ?>">
                                                          </div>
							  <div class="form-group">
                                                            <label for="recipient-name" class="col-form-label">Reason :</label>
                                                            <input type="text" class="form-control" id="reason" name="reason">
                                                          </div>
                                                      </div>
                                                      <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary" name="bookingCancelConfirm">Confirm</button>
                                                      </div>
                                                      </form>
                                                    </div>
                                                  </div>
                                                </div>

	                                        <?php
	                                        }
    }

    public function ChangePassword($newPass,$conPass,$sid){
        if ($newPass == $conPass)
        {
            $sid = $_SESSION['user'];
            $sql = "UPDATE customerDetails SET password='$conPass' WHERE id='$sid'";
             $result = $this->connection->query($sql);
        if ($result)
        {
            $msg = "Password updated successfully.";
        }
        else
        {
            $msg = "Password not updated, try again later.";
        }

    }
else
{
    $msg = "Confirm Password Mismatch, Reenter Correct New Password.";
}
    
    
}

public function Registor($firstname,$lastname,$email,$mobileno,$vehicleno,$password)
{

  $query="INSERT INTO customerDetails (Firstname,Lastname,Email,MobileNo,VehicleNo,password)";
  $query.="VALUES('$firstname','$lastname','$email','$mobileno','$vehicleno','$password')";
$result = $this->connection->query($query);
if ($result) {
  $msg = "Record inserted successfully. You can login now.";
}
else
{
  $msg = "Record insert unsuccessfully. Try Again Later.";
}
}
}

?>