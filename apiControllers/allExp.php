<?php
    require "expenseProcessor.php";
     
    $processor = new expenseProcessor();
    

    $exp = $processor->allExp();

    if(count($exp) > 0):

?>

 <div class="other_exp_sec"><strong>Expense records</strong></div>
            <div class="exp_sec_sub1 "><strong>Date</strong></div>
            <div class="exp_sec_sub2"><strong>Amount</strong></div>
            <div class="exp_sec_sub3"></div>
                <div style="clear:both"></div>
            <div class=" top"></div>
            <?php 
                foreach($exp as $exp):
                    $date = $exp['day']. '/'.$exp['month']. '/'.$exp['year'];
            ?>
            <div class="exp_sec_sub1"> <?php echo $date; ?> </div>
            <div class="exp_sec_sub2"><?php echo $exp['sum(amount)'] ?></div>
            <div class="exp_sec_sub3" data-date="<?php $exp['day'] ?>">
            <div class="more" data-date="<?php echo $exp['day'] ?>" data-month ="<?php echo $exp['month'] ?>" data-year ="<?php echo $exp['year'] ?>" onclick="moreExp(event)">more</div>
            </div>
            <?php 
                endforeach;
            ?>

            
            <div style="clear:both"></div>
            <!--
            <div class=" top"></div>
            <div class="exp_sec_sub1 "><strong>Total</strong></div>
            <div class="exp_sec_sub2"><strong>1000</strong></div>
            <div class="exp_sec_sub3"></div>

            <div style="clear:both"></div>
            -->


            <?php
        else:
            echo "No expense recorded";
        endif;

        ?>