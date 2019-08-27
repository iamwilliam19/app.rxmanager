<?php
 require "casheirProcessor.php";
     
 $processor = new casheirProcessor();
 $receipt_id = $_POST['receiptId'];

 //get sales
 $receipt = $processor->getReceipt($receipt_id);

 //get other details
 $receipt_detail = $processor->getReceiptDetail($receipt_id);
?>

<div class="rec_title">
            AD WILLIAMS PHARMACY LTD
        </div>

        <div class="contact">
            75 Limca road, Nkpor
        </div>
        <div class="contact">
            pharmadwilliams@yahoo.com
        </div>
        <div class="contact">
            08034226206
        </div>

        <div class="rec_title trans">
        <?php echo strtoupper($receipt_detail->payment_form) ?> TRANSACTION
        </div>

        <div class="rec_acc">
            <span>Receipt ID:</span> JFJH7878
        </div>
        <div class="rec_acc">
            <span>Date:</span> <?php echo $receipt_detail->date ?>
        </div>

       <div class="sale_rec">
            <div class="sel_rec_title">
                <div class="rec_title_sub">
                    <strong>Item</strong>
                </div>
                <div class="rec_title_sub">
                    <strong>Qty</strong>
                </div>
                <div class="rec_title_sub">
                    <strong>Price</strong>
                </div>
                <div style="clear:both"></div>
            </div>
<?php

    foreach($receipt as $receipt):
?>
            <div class="sel_rec_body">
                <div class="rec_title_sub">
                    <?php echo $receipt['item_name'] ?>
                </div>
                <div class="rec_title_sub">
                <?php echo $receipt['qty'] ?>
                </div>
                <div class="rec_title_sub">
                <?php echo $receipt['price'] ?>
                </div>
                <div style="clear:both"></div>
            </div>
  <?php 
    endforeach;
  ?>         

            <div class="sel_rec_others_cont">
                <div class="sel_rec_others">
                    <div class="rec_title_sub">
                        <strong> Total: </strong>
                    </div>
                    <div class="rec_title_sub">
                        
                    </div>
                    <div class="rec_title_sub">
                        <?php echo $receipt_detail->total_price ?>
                    </div>
                    <div style="clear:both"></div>
                </div>

                <div class="sel_rec_others">
                    <div class="rec_title_sub">
                        <strong> Disccount: </strong>
                    </div>
                    <div class="rec_title_sub">
                        
                    </div>
                    <div class="rec_title_sub">
                    <?php echo  '% '.$receipt_detail->disccount ?>
                    </div>
                    <div style="clear:both"></div>
                </div>

                <div class="sel_rec_others">
                    <div class="rec_title_sub">
                        <strong> Net price: </strong>
                    </div>
                    <div class="rec_title_sub">
                        
                    </div>
                    <div class="rec_title_sub">
                    <?php echo $receipt_detail->net_price ?>
                    </div>
                    <div style="clear:both"></div>
                </div>
                <div class="sel_rec_others">
                    <div class="rec_title_sub">
                        <strong> Amount paid: </strong>
                    </div>
                    <div class="rec_title_sub">
                        
                    </div>
                    <div class="rec_title_sub">
                    <?php 
                        if($receipt_detail->amt_paid == ''){
                            echo $receipt_detail->net_price;
                        }else {
                            echo $receipt_detail->amt_paid;
                        }
                    ?>
                    </div>
                    <div style="clear:both"></div>
                </div>

                <div class="sel_rec_others">
                    <div class="rec_title_sub">
                        <strong> Balance: </strong>
                    </div>
                    <div class="rec_title_sub">
                        
                    </div>
                    <div class="rec_title_sub">
                    <?php 
                        if($receipt_detail->amt_remaining  == ''){
                            echo 0;
                        }else {
                            echo $receipt_detail->amt_remaining;
                        }
                    ?>
                    </div>
                    <div style="clear:both"></div>
                </div>
            </div >
       </div>