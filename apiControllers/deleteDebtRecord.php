<?php

    //include debt model
    require "debtProcessor.php";
     
    $processor = new DebtProcessor();

    $id = $_POST['id'];
    echo $processor->deleteDebt($id);

    