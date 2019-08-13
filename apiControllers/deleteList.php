<?php
    //include api processors
    require "processor.php";

    //instantiate apiProcessor
    $processor = new apiProcessor();
    $uname = $_POST['uname'];

   echo  $processor->deleteList($uname);