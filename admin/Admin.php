<?php
include_once('db.php');

class Admin extends DbConnection
{
    public function __construct(){

        parent::__construct();
    }
    public function check_login($username, $password){

        $sql = "SELECT * FROM adminlogin WHERE username='$username' AND password='$password'";
        
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
    
      }

Class AddParking extends DbConnection
{
    public function __construct(){

        parent::__construct();
    }
    
    
    public function createParking($area,$type,$slot,$slotcharge,$slotperhour,$cancel,$cutofftime){
        $sql="INSERT INTO addparking (Area,vehicleType,parkingslots,slotcharge,slotperhour,Cancellation,cutofftime)";
        $sql .= "VALUES('$area','$type','$slot','$slotcharge','$slotperhour','$cancel','$cutofftime')";
        $res_insert=$this->connection->query($sql);
        if ($res_insert)
    {
        $success = "Record Successfully inserted.";
    }
    else
    {
        $success = "Server Problem, Try Again Later";
    }
    header("Location: AddParking.php?success=" . $success);
    
    }

    public function fetch()
    {
        $sql="SELECT * FROM customerDetails";
        $res_parking = $this->connection->query("SELECT * FROM customerDetails");
        while ($row = $res_parking->fetch_assoc())
{
?>
                                        <tr>
                                         <td><?php echo $row["id"]; ?></td>
                                         <td><?php echo $row["Firstname"] . $row['Lastname']; ?></td>
                                         <td><?php echo $row["MobileNo"]; ?></td>
                                         <td><?php echo $row["Email"]; ?></td>
                                        <?php
}

    }

    public function fetchP()
    {
        $sql="SELECT * FROM addparking";
        $res_parking = $this->connection->query($sql);
        while ($row = $res_parking->fetch_assoc())
{
?>
					 <tr>
                  <td><?=$row['Area']; ?></td>
                  <td><?=$row['vehicleType']; ?></td>
                  <td><?=$row['parkingslots']; ?></td>
                  <td><?=$row['slotcharge']; ?></td>
                  <td><?=$row['slotperhour']; ?></td>
                  <td><?=$row['Cancellation']; ?></td>

                  </tr>

					<?php
}

    }

    public  function fetchW()
    {
        $sql="SELECT * FROM customerDetails";
        $res_parking = $this->connection->query($sql);
while ($row = $res_parking->fetch_assoc())
{
?>
              <tr>
                  <td><?php echo $row["id"]; ?></td>
                  <td><?php echo $row["Firstname"] . $row['Lastname']; ?></td>
                  <td><?php echo $row["MobileNo"]; ?></td>
                  <td><?php echo $row["Email"]; ?></td>
					        <td><?php echo $row["wallet"]; ?></td>
                  <td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#addMoney<?php echo $row['id']; ?>">Add Money</button></td>
              </tr>

					 <div class="modal fade" id="addMoney<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <h5 class="modal-title" id="exampleModalLabel">Add Money to Customer Wallet</h5>
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
					      </div>
					     <form action="Wallet.php?wid=<?php echo $row['id']; ?>" method="post" name="addMoneyToWalletForm" enctype="multipart/form-data">
					      <div class="modal-body">
					          <div class="form-group">
					            <label for="recipient-name" class="col-form-label">Enter the amount(Rs.) :</label>
					            <input type="text" class="form-control" id="walletAmt" name="walletAmt" required>
						    <input type="hidden" name="wid" value="<?php echo $row['id']; ?>">
					          </div>
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					        <button type="submit" class="btn btn-primary" name="addMoneyToWallet">Add</button>
					      </div>
					      </form>
					    </div>
					  </div>
					</div>

                         <?php
}
    }

    public function update($amt,$wid)
    {
        $sql = "UPDATE customerDetails SET wallet='$amt' WHERE id='$wid'";
    $result = $this->connection->query($sql);
    if ($result)
    {
        $msg = "Amount added successfully.";
    }
    else
    {
        $msg = "Amount not added. Try Again Later.";
    }
    header("Location: Wallet.php?success=$msg");
}

        public function GetId($get_id){
        global $row;
        global $get_id;
        $get_data = $this->connection->query("SELECT * FROM customerDetails WHERE id='$get_id'");
        $row = $get_data->fetch_assoc();
        }

        public function edit($firstname,$lastname,$email,$mobileno,$vehicleno,$password,$get_id)
        {
        $sql = "UPDATE customerDetails SET ";
        $sql .= "Firstname='$firstname',Lastname='$lastname',Email='$email',MobileNo='$mobileno',VehicleNo='$vehicleno', password='$password'  WHERE id='$get_id'";

        $result = $this->connection->query($sql);
        if ($result)
        {
            $msg = "Record successfully updated.";
         }
        else
         {
             $msg = "Record not updated.";
         }

         
         }
    }
    
?>