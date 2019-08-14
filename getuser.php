<?php

    require_once('config/disburse.php');

    $dis = new disburse();    
    $fullDetails = $dis->getSuppliersDetails();
    $name = $dis->getSuppliersName();

    
    if(isset($_GET['id']))
    {      
        $supplierId = $dis->getSupplierById($_GET['id']);
        echo $supplierId;
    }
?>