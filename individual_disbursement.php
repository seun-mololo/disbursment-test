<?php
    require_once('Includes/header.html');
    require_once('config/disburse.php');

    $dis = new disburse();    
    $fullDetails = $dis->getSuppliersDetails();

    $name = $dis->getSuppliersName();
    
    //create recipient
    $code = $dis->createTransferRecipient('nuban','henry','0113262585','044');

    print_r($code);
    
    //$recipientCode = $code->response->data->recipient_code;

    $recipientCode = $code->response->message;
    echo 'The message is'. $recipientCode ;

    //initiate Transfer
    //$transfer = $dis->initiateTransfer('500000','20000','RCP_yh77s1c9kfhj263');
    //echo '<pre>';
    //print_r($transfer);

    
?>

<h3>Disbursment Form</h3>
<form action="getuser.php" method = 'get'>
  <div class="form-group" >
    <label for="sel1">Suppliers list:</label>
    <?php
        echo '<select name="supplierID" class="form-control" id="sel1" width="20%" placeholder = "select" required>'; 
        echo '<option value="">Select your option</option>';       
        foreach($fullDetails as $key => $value)
        {
            //echo $value . '<br>';
            echo "<option value = ". $value['id'].">". $value['first_name'] ." ".$value['last_name']  ."</option>";
        }
        echo '</select>';
    ?>   
  <br><p id = "supdet"> Supplier Details:</p><br><br>
  <table id="dtBasicExample" class="table table-striped table-bordered" cellspacing="0" width="100%"> 

  <tbody>      
    <?php
      /*foreach($fullDetails as $key => $value)
      {
          //echo $value . '<br>';
          echo "<tr><td>". $value['first_name'] ."</td>";
          echo "<td>". $value['last_name'] ."</td>";
          echo "<td>". $value['email'] ."</td>";
          echo "<td>". $value['phone_number'] ."</td>";
          echo "<td>". $value['supplier_number'] ."</td>";
          echo "<td>". $value['account_number'] ."</td>";
          echo "<td>". $value['bank'] ."</td></tr>";
      }*/
    ?>
  </tbody>
  <tfoot>
    
  </tfoot>
  </table>


  <label for="usr">Amount:</label>
    <input type="text" name="amount" class="form-control" id="usr" required>
    <br>
    <input type="submit" name="submit" value = "Make Payment" class="btn btn-primary btn-md">
 
  </div>
</form>


<?php
    require_once('Includes/footer.html');
?>















    