<?php
    require_once('Includes/header.html');
    require_once('config/disburse.php');

    $dis = new disburse();    

    if (!empty($_POST))
    {
        $recipientCode = $_POST['recipient_code'];
        
        
        if(!empty($recipientCode))
        {
            $update = $dis->deleteTransferRecipient($recipientCode);
            //print_r($update);
            echo ' '.  $update->response->message;
            
        }
    }
?>

<h3>Delete Recipient</h3>

<form method = "post" action="deleteRecipient.php">
  
  <div class="form-group">
    <label for="recipientCode">Recipient Code or ID</label>
    <input type="text" class="form-control" id="recipientCode" name = "recipient_code" placeholder="Code or Id" required>
  </div>


  <input type="submit" class="btn btn-primary" name = "submit" value="Remove Recipient">
</form>


<?php
    require_once('Includes/footer.html');
?>















    