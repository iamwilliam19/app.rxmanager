<?php

    //include api processors
    require "processor.php";

    //instantiate apiProcessor
    $processor = new apiProcessor();
    $idValue = $_POST['idValue'];

    //fetch matchin data
    $processor->stockDetails($idValue);
    
