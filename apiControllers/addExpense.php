<?php

require "expenseProcessor.php";
     
$processor = new expenseProcessor();

$amt = $_POST['amt'];
$purp = $_POST['purpose'];
echo $processor->addExp($amt,$purp);