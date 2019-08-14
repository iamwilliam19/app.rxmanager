<?php 

    $code = $_POST['code'];
    $name = $_POST['name'];
    $brand = $_POST['brand'];
    $category = $_POST['category'];
    $unit = $_POST['unit'];
    $form = $_POST['form'];
    $price = $_POST['price'];


    //include api processors
    require "productProcessor.php";

    //instantiate apiProcessor
    $processor = new  productProcessor();

    echo $processor->updateProduct($code,$name,$brand,$category,$unit,$form,$price);
