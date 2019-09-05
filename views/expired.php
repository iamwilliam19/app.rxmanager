<?php

    require "models/expiredModel.php";
    $processor = new expiredProcessor();
    $exp = $processor->getExpiredProduct();
    date_default_timezone_set('Africa/Lagos');
            $m = date('m') ;
            
   
?>



<main class="display-main">
    
    <div class=" page-title dashboard">
        Expired Products
  </div>

  <section class="expired_box">
      <?php 
        if(count($exp) > 0):
            
      ?>
    <table>
        <th>Item name</th>
        <th>Item id</th>
        <th>Batch id</th>
        <th>Time remaining</th>
        <th>Delete</th>

        <?php
            foreach($exp as $exp):
        ?>
            <tr>
            <td><?php echo $exp['item_name'] ?></td>
            <td><?php echo $exp['item_id'] ?></td>
            <td><?php echo $exp['batch_id'] ?></td>
            <td>
                <?php
                    if(($exp['exp_month'] - $m ) < 0) {
                        echo "<span style='color:red'>Expired</span>";
                    }else {
                        $time = $exp['exp_month'] - $m ;
                        if($time > 1){
                            echo "<span style='color:green'>".$time ." months</span>";
                        }else{
                            echo "<span style='color:green'>".$time ." month</span>";
                        }
                    }
                ?>
            </td>

            <td >
            <div class='list-but' data-delete="<?php echo $exp['id'] ?>"  >
                  <i class='fas fa-window-close rec-cancel' title="Delete" data-delete="<?php echo $exp['id'] ?>" onclick="deleteExpProduct(event)"></i>
             </div>
            </td>
            
        </tr>
        <?php 
            endforeach;
        ?>
    </table>
    <?php
        else:
            echo "No record found";
        endif;
    ?>
  </section>
</main>

<script>
    const deleteExpProduct = (event) => {
        let id = event.target.dataset.delete;
        let confirmation  = confirm("Click OK to delete this batch");
        if(confirmation){
            let url = "apiControllers/deleteExpiredProduct.php";

            let formData = new FormData();

            formData.append('id',id);
            let fetchData = {
                method: 'POST',
                body: formData,
                headers: new Headers
            }

            fetch(url, fetchData)
            .then((resp) => resp.text())
            .then((data) => {
              countExp();
              location.reload();
            })
            .catch((err) => console.warn(err));
        }
    }
</script>