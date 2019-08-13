<?php
    //include api processors
    require "processor.php";

    //instantiate apiProcessor
    $processor = new apiProcessor();
    $delete_id = $_POST['deleteId'];

   echo  $processor->delete('temp_stock',$delete_id);