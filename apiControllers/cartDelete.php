<?php 

    require "casheirProcessor.php";

    
    $uname = $_POST['uname'];

    $processor = new casheirProcessor();
    echo $processor->deleteCart($uname);