<?php

    //include api processors
    require "productProcessor.php";

    //instantiate apiProcessor
    $processor = new  productProcessor();
    $id = $_POST['id'];
    $batch = $processor->getBatch($id);
?>


<span class="stock_error batch-expiryError"></span>
                <div class="prod-list-box">
                    <label for="expiry-date">Expiry date</label>
                    <div class="list-input">
                        <input  type="text" placeholder="MM/YY" name="date" id="batch-expiry-date" value="<?php echo $batch->expiryDate ?>" />
                        <span><i class="fas fa-calendar-alt"></i></span>
                        <div style="clear:both"></div>
                    </div>
                </div>


                <span class="stock_error batchsecError"></span>
                <div class="prod-list-box">
                    <label for="name">Quanity</label>
                    <div class="list-input">
                        <input type="number" name="qty" id="batch-qty" placeholder="enter product quantity" value="<?php echo $batch->quantity ?>" />
                        <span><i class="fas fa-pencil-alt"></i></span>
                        <div style="clear:both"></div>
                    </div>
                </div>

                <div class="regulation-box">
                    <div class="regulation-cancel" onclick="hideBatchEdit()">cancel</div>
                    <div class="regulation-ok" onclick="submitBatch('<?php echo $id ?>')">OK</div>
                    <div style="clear:both"></div>
                </div>