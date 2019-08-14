<?php
    require_once('Includes/header.html');
    require_once('config/disburse.php');

    $dis = new disburse();    
    $fullDetails = $dis->getSuppliersDetails();
    $name = $dis->getSuppliersName();
    //echo '<pre>';
    //print_r($result);
?>

<h3>Disbursment Form</h3>
<div class="form-group" >
  <!--<label for="sel1">Suppliers list:</label>-->
  <?php
      /*echo '<select class="form-control" id="sel1" width="20%" placeholder = "select" required>';
      
      foreach($fullDetails as $key => $value)
      {
          //echo $value . '<br>';
          echo "<option value = ". $value['id'].">". $value['first_name'] ." ".$value['last_name']  ."</option>";
      }
      echo '</select>';*/
  ?>
  
</div>


<p>All Suppliers</p>
<table id="dtBasicExample" class="table table-striped table-bordered" cellspacing="0" width="100%"> 
  <thead>
  <tr>
      <th>First Name
      </th>
      <th>Last Name
      </th>
      <th>Email
      </th>
      <th>Phone Number
      </th>
      <th>Supplier Number
      </th>
      <th>Account Number
      </th>
      <th>Bank
      </th>
      <th>Amount
      </th>
    </tr>
  </thead>
  <tbody>
      
    <?php
      foreach($fullDetails as $key => $value)
      {
          //echo $value . '<br>';
          echo "<tr><td>". $value['first_name'] ."</td>";
          echo "<td>". $value['last_name'] ."</td>";
          echo "<td>". $value['email'] ."</td>";
          echo "<td>". $value['phone_number'] ."</td>";
          echo "<td>". $value['supplier_number'] ."</td>";
          echo "<td>". $value['account_number'] ."</td>";
          echo "<td>". $value['bank'] ."</td>";
          echo '<td><input type="text" name="amount" class="form-control" id="usr" required></td></tr>';
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

<button type="button" class="btn btn-primary btn-md">Submit</button>

<?php
    require_once('Includes/footer.html');
?>















    