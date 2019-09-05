<?php

    require "expiredProcessor.php";

    $id = $_POST['id'];
    $processor = new expProcessor();

    echo $processor->delExp($id);