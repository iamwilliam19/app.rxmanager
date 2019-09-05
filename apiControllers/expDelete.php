
<?php
    require "expenseProcessor.php";
     
    $processor = new expenseProcessor();
    $id = $_POST['id'];

    echo $processor->listDel($id);

    