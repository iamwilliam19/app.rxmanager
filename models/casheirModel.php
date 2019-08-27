<?php 

    require "../apiControllers/casheirProcessor.php";

    $prod = $_POST['product'];
    $qty = $_POST['qty'];

    $processor = new casheirProcessor();
    echo $processor->validate($prod, $qty);