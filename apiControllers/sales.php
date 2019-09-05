
<?php
     //include api processors
     require "salesProcessor.php";
    $day = $_POST['day'];
    $month = $_POST['month'];
    $year = $_POST['year'];
    $processor = new salesProcessor();
    $sale = $processor->fetchSales($day,$month,$year);
?>


<table >
       

            
                <?php
                    if(count($sale) > 0):
                ?>
             <thead>
                <th>Item</th>
                <th>Item id</th>
                <th>Quantity</th>
                <th>Price</th>
            </thead>
       
                <tbody>
                <?php
                        foreach($sale as $sale):
                ?>
                <tr>
                    <td><?php echo $sale['item_name']; ?></td>
                    <td><?php echo $sale['item_id']; ?></td>
                    <td><?php echo $sale['qty']; ?></td>
                    <td><?php echo $sale['price']; ?></td>
                </tr>

                <?php 
                    endforeach;
                ?>
                    </tbody>
                <?php
                    else:
                        echo "No record found";
                    endif;
                ?>
                
            
</table>