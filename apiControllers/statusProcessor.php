<?php

    //include api processors
    require "processor.php";
    $staffId =  $_POST['data'];

    //instantiate apiProcessor
    $Processor = new apiProcessor();

    //update status
    $Processor->staffStatusUpdate($staffId);
        

?>