<?php
    require_once('Includes/header.html');
    require_once('config/disburse.php');

    $dis = new disburse();    

    if (!empty($_POST))
    {
        $recipientCode = $_POST['recipient_code'];
        $fullName = $_POST['fullname'];
        $email = $_POST['email'];
        
        if(!empty($recipientCode))
        {
            $update = $dis->updateTransferRecipient($recipientCode, $fullName, $email);
            echo ' '.  $update->response->message;
            
        }
    }
?>

<h3>Update Recipient</h3>

<form method = "post" action="updateRecipient.php">
  
  <div class="form-group">
    <label for="fullname">Fullname</label>
    <input type="text" class="form-control" id="fullname" name = "fullname" placeholder="Name" >
  </div>

  <div class="form-group">
    <label for="nuban">Email</label>
    <input type="email" class="form-control" id="nuban"  name = "email" placeholder="Enter Email" >
  </div>
  
  <div class="form-group">
    <label for="recipientCode">Recipient Code or ID</label>
    <input type="text" class="form-control" id="recipientCode" name = "recipient_code" placeholder="Code or Id" required>
  </div>


  <input type="submit" class="btn btn-primary" name = "submit" value="Update Recipient">
</form>


<?php
    require_once('Includes/footer.html');
?>















    