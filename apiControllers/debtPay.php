 <?php


    $id = $_POST['id'];
    $debt = $_POST['debt'];


?>
    
    
    <div class="error" id="error"></div>
    <p>
           <strong> Debt to pay:</strong> <span  id="debtAmt"><?php echo $debt ?></span>
        </p>
        <div class="pay_inp">
            <input type="number" min="0" placeholder="enter amount " id="debtInput" autofocus  />
        </div>

        <div class="pay-reg-box">
            <div class="regulation-cancel" onclick="hideDebtPay()">cancel</div>
            <div class="regulation-ok" onclick="submitPayment('<?php echo $id?>', '<?php echo $debt ?>')">Pay</div>
            <div style="clear:both"></div>
        </div>