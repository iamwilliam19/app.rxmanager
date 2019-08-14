<?php


    //include api processors
    require "processor.php";

    //instantiate apiProcessor
    $processor = new apiProcessor();

    $code = trim($_POST['code']);
    $name = trim($_POST['name']);
    $brand = trim($_POST['brand']);
    $category = trim($_POST['category']);
    $expiryDate = trim($_POST['expiryDate']);
    $qty = trim($_POST['qty']);
    $unit = trim($_POST['unit']);
    $form = trim($_POST['form']);
    $price = trim($_POST['price']);
    $errorLog = trim($_POST['errorLog']);
    
    
      echo  $processor->validateProduct($code, $name, $brand, $category, $expiryDate, $qty, $unit, $form, $price, $errorLog);

   
