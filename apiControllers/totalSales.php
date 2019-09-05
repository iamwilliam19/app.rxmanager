<?php
     //include api processors
     require "salesProcessor.php";
    $day = $_POST['day'];
    $month = $_POST['month'];
    $year = $_POST['year'];
    $processor = new salesProcessor();
    $sale = $processor->totalSales($day,$month,$year);

    $exp = $processor->totalExp($day,$month,$year);
?>


<table >
    <?php
        if(count($sale) > 0):
            $total = 0;
            $disccount = 0;
            $debt = 0 ;
            foreach($sale as $sale){
                $total += $sale['total_price'];
                $disccount += $sale['total_price'] - $sale['net_price'];
                if($sale['amt_remaining'] != ''){
                    $debt += $sale['amt_remaining']; 
                }
            }
            $total_exp = 0;
            foreach($exp as $exp){
                $total_exp += $exp['amount'];
            }

            $net = $total - ($disccount + $debt + $total_exp);

            
    ?>
            
            <tr>
                <td><strong>Total</strong></td>
                <td></td>
                <td></td>
                <td><?php echo $total; ?></td>
            </tr>

            <tr>
                <td><strong>Total disccounts</strong></td>
                <td></td>
                <td></td>
                <td><?php echo $disccount; ?></td>
            </tr>
            <tr>
                <td><strong>Total debt</strong></td>
                <td></td>
                <td></td>
                <td><?php echo $debt; ?></td>
            </tr>
            <tr>
                <td><strong>Expenses</strong></td>
                <td></td>
                <td></td>
                <td><?php echo $total_exp ?></td>
            </tr>

            <tr>
                <td><strong>Net </strong></td>
                <td></td>
                <td></td>
                <td><?php echo $net ?></td>
            </tr>

    <?php

        else:
            echo "No record found";
        endif;
    ?>
        
    </table>