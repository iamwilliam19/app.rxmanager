<?php

//include api processors
require "processor.php";

//instantiate apiProcessor
$processor = new apiProcessor();

    $code = $_POST['code'];
    $brand = $_POST['brand'];
    $prod_name = $_POST['name'];
    $expiry_date = $_POST['expiryDate'];
    $qty = $_POST['qty'];
    $unit = $_POST['unit'];
    $form = $_POST['form'];
    $price = $_POST['price'];
    $error_log = $_POST['errorLog'];
    $edit_id = $_POST['editId'];
    $category = $_POST['category'];

    echo $processor->updateRec($code,$brand,$prod_name,$expiry_date,$qty,$unit,$form,$price,$error_log,$edit_id,$category);
?>

