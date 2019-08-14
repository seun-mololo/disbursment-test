<?php
    require_once('Includes/header.html');
    require_once('config/disburse.php');
?>

<h3>List All Recipients</h3>


<p>All Suppliers</p>
<table id="dtBasicExample" class="table table-striped table-bordered" cellspacing="0" width="100%"> 
  <thead>
  <tr>
      <th>Date Created
      </th>
      <th>Currency
      </th>
      <th>Id
      </th>
      <th>Recipient Name
      </th>
      <th>Recipient Code
      </th>
      <th>Type
      </th>
      <th>Last Update
      </th>
      <th>Account Number
      </th>
      <th>Account Name
      </th>
      <th> Bank name
      </th>
      </tr>
  </thead>
  <tbody>
      
    <?php
    $dis = new disburse();    
    $fullDetails = $dis->listTransferRecipient();
    $message = $fullDetails->response->message;
    echo 'The message is '.$message;

    //$name = $dis->getSuppliersName();
    echo '<pre>';
    //print_r($fullDetails->response->data);

    foreach($fullDetails->response->data as $key => $value )
    {

        echo "<tr><td>". $value->createdAt ."</td>";
        echo "<td>". $value->currency ."</td>";
        echo "<td>". $value->id ."</td>";
        echo "<td>". $value->name ."</td>";
        echo "<td>". $value->recipient_code ."</td>";
        echo "<td>". $value->type ."</td>";
        echo "<td>". $value->updatedAt ."</td>";
        echo "<td>". $value->details->account_number."</td>";
        echo "<td>". $value->details->account_name ."</td>";
        echo "<td>". $value->details->bank_name ."</td>";
    }
    ?>
  </tbody>
  <tfoot>
    
  </tfoot>
</table>


<!--<div class="form-group">
  <label for="usr">Amount:</label>
  <input type="text" class="form-control" id="usr" required>
</div>-->


<?php
    require_once('Includes/footer.html');
?>















    