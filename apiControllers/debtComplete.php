<?php
    //include debt model
    require "debtProcessor.php";
     
    $processor = new DebtProcessor();

    $id = $_POST['id'];
    $debt = $_POST['debt'];
    $amt = $_POST['amt'];

    echo $processor->debtClear($id,$amt);