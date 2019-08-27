<?php 

    require "../apiControllers/casheirProcessor.php";

   $uname = $_POST['uname'];
   if (isset($_POST['name'])) {
       $name = $_POST['name'];
   }else{
       $name = '';
   }
   if (isset($_POST['phone'])) {
        $phone = $_POST['phone'];
    }else{
        $phone = '';
    }
    if (isset($_POST['addr'])) {
        $addr = $_POST['addr'];
    }else{
        $addr = '';
    }
    if (isset($_POST['amt_paid'])) {
       $amt_paid = $_POST['amt_paid'];
    }else{
        $amt_paid = '';
    }
   $transaction = $_POST['transaction'];
   $receiptId = $_POST['receiptId'];
   $disccount = $_POST['disccount'];

    $processor = new casheirProcessor();
    echo $processor->pay($uname,$name,$addr,$phone,$transaction,$receiptId,$disccount,$amt_paid);