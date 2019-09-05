<?php

    //include api processors
    require "processor.php";

    //instantiate apiProcessor
    $processor = new apiProcessor();
    //get matching product

    $code = $_POST['code'];
    $match =  $processor->getMatch($code);
    //header("Content-Type: application/json");
    echo $match;
    ?>

    