<?php 

    require "casheirProcessor.php";

    
    $id = $_POST['id'];

    $processor = new casheirProcessor();
    echo $processor->deleteOrder($id);