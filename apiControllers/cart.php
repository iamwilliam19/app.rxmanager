<?php 
     require "casheirProcessor.php";
     
     $processor = new casheirProcessor();

     $data = $processor->fetchCart();

     //count array elements
     $elements = count($data);
     if ($elements > 0) {
          ?>
<div class='list-cont' >
          <div class='cart-name'>
               <strong>Product</strong>
          </div>
          <div class='cart-qty'>
          <strong>Qty</strong>
          </div>
          <div class='cart-price'>
          <strong>Price</strong>
          </div>
          <div class='cart-other' >
               
           </div>
          <div style='clear:both'></div>
      </div>
          <?php
          $price = 0;
          $qty = 0;
         //interate over the head array
         foreach ($data as $detail):
         //make an object or the details
         $price += $detail['price'];
         $qty += $detail['qty'];
         ?>
  
                  <div class='list-cont' data-id="<?php echo $detail['id'] ?>">
                      <div class='cart-name'>
                          <?php echo $detail['item_name'] ?>
                      </div>
                      <div class='cart-qty'>
                      <?php echo $detail['qty'] ?>
                      </div>
                      <div class='cart-price'>
                      <?php echo $detail['price'] ?>
                      </div>
                      <div class='cart-other' >
                          <div class='list-but' data-delete="<?php echo $detail['id'] ?>"  >
                              <i class='fas fa-window-close rec-cancel' title="Delete" data-delete="<?php echo $detail['id'] ?>" onclick="deleteOrder(event)"></i>
                          </div>
                      </div>
                      <div style='clear:both'></div>
                  </div>
  
         <?php
  
           endforeach;
           ?>
               <div class='list-cont' >
          <div class='cart-name'>
               <strong>Total</strong>
          </div>
          <div class='cart-qty'>
          <strong><?php echo $qty ?></strong>
          </div>
          <div class='cart-price total'>
          <strong><?php echo $price ?></strong>
          </div>
          <div class='cart-other' >
               
           </div>
          <div style='clear:both'></div>
      </div>

      <div class='list-cont' >
          <div class='cart-name'>
               <strong>Disccount</strong>
          </div>
          <div class='cart-qty'>
          
          </div>
          <div class='cart-price'>
          <input type="number" step="5" value="0" min="0" class="disccount" oninput="updateNet(event)" />
          </div>
          <div class='cart-other' >
               
           </div>
          <div style='clear:both'></div>
      </div>

      <div class='list-cont' >
          <div class='cart-name'>
               <strong>Net price</strong>
          </div>
          <div class='cart-qty'>
          
          </div>
          <div class='cart-price net'>
          <strong><?php echo $price ?></strong>
          </div>
          <div class='cart-other' >
               
           </div>
          <div style='clear:both'></div>
      </div>

      <div class='list-cont' >
          <div class='cart-name'>
               <strong>Transaction type</strong>
          </div>
          <div class='cart-qty'>
          
          </div>
          <div class='cart-price cart-drop'>
          <select id="transaction" onchange="showCustBox(event)">
               <option value="select">Payment form</option>
               <option value = "cash">Cash</option>
               <option value = "credit">Credit</option>
          </select>
          </div>
          <div class='cart-other' >
               
           </div>
          <div style='clear:both'></div>
      </div>
           
           <div class="credit-box">
           <div class="error" id="error"></div>
           <label for="name">Name:</label>
        <input type="text" placeholder="Enter customer name" name="name" value="" id="name" />

        <label for="addr">Address:</label>
        <input type="text" placeholder="Enter customer address" name="addr" value="" id="addr" />

        <label for="phone">Phone number:</label>
        <input type="tele" placeholder="Enter Customer Phone number" name="phone" value="" id="phone" />

        <label for="phone">Amount paid:</label>
        <input type="number" placeholder="Enter amount paid" name="amt" value="" id="amt_paid" />
           </div>

              <div class="complete-box">
              <div class="complete-done" data-done="<?php echo $detail['reg_uname'] ?>" onclick="pay(event)">Pay</div>
              <div class="complete-delete" data-delete="<?php echo $detail['reg_uname'] ?>" onclick="cartDelete(event)">Delete List</div>
                  <div style="clear:both"></div>
              </div>
           <?php
     }else{
         echo "Cart is empty ";
     }
  