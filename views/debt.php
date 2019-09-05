<?php
    //include debt model
    require "models/debt_model.php";

    $processor = new DebtProcessor();

    $debt = $processor->getDebt();

?>




<main class="display-main">
    
  <div class=" page-title dashboard">
    Debts record
  </div>

  <!-- debt table starts -->
    <section class="debt-box">
        <table>
            <th>Debtor</th>
            <th>Address</th>
            <th>number</th>
            <th>Total</th>
            <th>Paid</th>
            <th>Debt</th>
            <th>Clear</th>
            <th>Delete</th>

           <?php
                if(count($debt)):
                    foreach($debt as $debt ):
                        

           ?> 
            <tr>
                <td><?php echo $debt['customer_name'] ?></td>
                <td><?php echo $debt['customer_address'] ?></td>
                <td><?php echo $debt['customer_number'] ?></td>
                <td><?php echo $debt['total_price'] ?></td>
                <td><?php echo $debt['amt_paid'] ?></td>
                <td><?php echo $debt['amt_remaining'] ?></td>
                <td>
                    <div class="more debt-more" data-debt="<?php echo $debt['amt_remaining'] ?>" data-id="<?php echo $debt['id'] ?>" onclick="debtPay(event)">clear</div>
                </td>
                <td>
                    <div class='list-but' data-delete="<?php echo $debt['id'] ?>"  >
                         <i class='fas fa-window-close rec-cancel' title="Delete" data-delete="<?php echo $debt['id'] ?>" onclick="deleteDebtRecord(event)"></i>
                     </div>
                </td>
            </tr>

            <?php 
                endforeach;
                else:
                    echo "No record found";
                endif;
            ?>
        </table>
    </section>
</main>





<script>

    const deleteDebtRecord = (e) => {
        let id = e.target.dataset.delete;
        let confirmation = confirm("Click Ok to delete this debt record");

        if(confirmation){
            let url = "apiControllers/deleteDebtRecord.php";

            let formData = new FormData();
            formData.append('id',id );
            let fetchData = {
                method: 'POST',
                body: formData,
                headers: new Headers
            }

            fetch(url, fetchData)
            .then((resp) => resp.text())
            .then((data) => {
                if(data == "success")
                location.reload();
            })
            .catch((err) => console.warn(err));
        }
            
    };

    const debtPay = (e) => {
        let debt = e.target.dataset.debt;
        let id = e.target.dataset.id;
        let box = document.getElementsByClassName('debt-pay-box')[0];
        showModal();
        box.style.display = "block";

        let url = "apiControllers/debtPay.php";

            let formData = new FormData();
            formData.append('debt',debt );
            formData.append('id',id);
            let fetchData = {
                method: 'POST',
                body: formData,
                headers: new Headers
            }

            fetch(url, fetchData)
            .then((resp) => resp.text())
            .then((data) => {
                box.innerHTML = data;
            })
            .catch((err) => console.warn(err));
    }
</script>