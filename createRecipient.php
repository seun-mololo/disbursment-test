<?php
    require_once('Includes/header.html');
    require_once('config/disburse.php');

    $dis = new disburse();    

    if (!empty($_POST))
    {
        $acctNum = $_POST['account_number'];
        $fullName = $_POST['fullname'];
        $type = 'nuban';
        $bankCode = '044';

        if(!empty($acctNum) && !empty($fullName))
        {
            $code = $dis->createTransferRecipient($type,$fullName,$acctNum,$bankCode);
            
            $message = $code->response->message;
            $status = $code->response->status;
            if(!empty($status))
            {
                $recipientCode = $code->response->data->recipient_code;
                echo '<p>The Recipient Code is '. $recipientCode .'</p>' ;
            }
            echo '<p>'.$message .'</p>';
            
        }
    }  
?>

<h3>Create Recipient</h3>

<form method = "post" action="createRecipient">
  <div class="form-group">
    <label for="nuban">Account Number</label>
    <input type="number" class="form-control" id="nuban"  name = "account_number" placeholder="Enter nuban acct" required maxlength="10">
     </div>
  <div class="form-group">
    <label for="fullname">Fullname</label>
    <input type="text" class="form-control" id="fullname" name = "fullname" placeholder="Fullname" required>
  </div>
  
  <input type="submit" class="btn btn-primary" name = "submit" value="Create Recipient">
</form>


<?php
    require_once('Includes/footer.html');
?>















    