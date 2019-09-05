<?php
    require "expenseProcessor.php";
     
    $processor = new expenseProcessor();
    $date = $_POST['date'];
    $month = $_POST['month'];
    $year = $_POST['year'];

    $exp = $processor->listExp($date,$month,$year);

    if(count($exp) > 0):

?>
    <div class="other_exp_sec"><strong>Expense details</strong></div>
            <div class="exp_sec_sub1 "><strong>Purpose</strong></div>
            <div class="exp_sec_sub2"><strong>Amount</strong></div>
            <div class="exp_sec_sub3"></div>
                <div style="clear:both"></div>
            <div class=" top"></div>
            <?php
                $total = 0;
                foreach($exp as $exp):
                    $total += $exp['amount'];
            ?>
            <div class="exp_sec_sub1"><?php echo $exp['reason'] ?></div>
            <div class="exp_sec_sub2"><?php echo $exp['amount'] ?></div>
            <div class="exp_sec_sub3">
            <div class='list-but' data-delete="<?php echo $exp['id'] ?>"  >
                  <i class='fas fa-window-close rec-cancel' title="Delete" data-delete="<?php echo $exp['id'] ?>" data-day="<?php echo $exp['day'] ?>" data-month ="<?php echo $exp['month'] ?>" data-year ="<?php echo $exp['year'] ?>" onclick="deleteExp(event)"></i>
             </div>
            </div>
            <?php endforeach ?>

            
            <div style="clear:both"></div>
            <div class=" top"></div>
            <div class="exp_sec_sub1 "><strong>Total</strong></div>
            <div class="exp_sec_sub2"><strong><?php echo $total ?></strong></div>
            <div class="exp_sec_sub3"></div>

            <div style="clear:both"></div>

        <?php
        else:
            echo "No expense recorded";
        endif;

        ?>