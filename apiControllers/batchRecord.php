<?php

    //include api processors
    require "productProcessor.php";

    //instantiate apiProcessor
    $processor = new  productProcessor();

    $qty = $_POST['qty'];
    $id = $_POST['id'];
    $expiryDate = $_POST['expiryDate'];

    echo $processor->updateBatch($id,$qty, $expiryDate);