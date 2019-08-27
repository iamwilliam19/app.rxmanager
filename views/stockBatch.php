
<?php 

//include stock model
require "models/stock_model.php";
//instantiate stock class
$stock = new Stock_manager();
$prod_id = $_GET['product-id'];
$my_stock = $stock->getAnalysis($prod_id);



?>

<main class="display-main">

<div class="page-title dashboard">Updates analysis for <?php echo $prod_id ?></div>

<div class="batch_detail">
    <table>
    <thead>
        <tr>
            <th>Item name</th>
            <th>Batch ID</th>
            <th>Registered by</th>
            <th>Registered on</th>
            <th>Modified by</th>
            <th>Modified on</th>
            <th>Brand</th>
            <th>Category</th>
            <th>Quantity</th>
            <th>Unit</th>
            <th>Form</th>
            <th>Price</th>
            <th>Expiry Date</th>
            <th>Activity</th>
            
        </tr>
        </thead>
        <tbody>
            <?php 
                foreach($my_stock as $stock):
            ?>
        <tr>
            <td><?php echo $stock['item_name'] ?></td>
            <td><?php echo $stock['batch_id'] ?></td>
            <td><?php echo $stock['registered_by'] ?></td>
            <td><?php echo $stock['registered_on']?></td>
            <td><?php echo $stock['modified_by']?></td>
            
            <td><?php 
                if($stock['modified_by'] == ''){
                    echo '';
                }else {
                    echo $stock['modified_on'];
                }
            ?></td>
            <td><?php echo $stock['brand'] ?></td>
            <td><?php echo $stock['category'] ?></td>
            <td><?php echo $stock['quantity'] ?></td>
            <td><?php echo $stock['unit']?></td>
            <td><?php echo $stock['form']?></td>
            
            <td><?php echo $stock['price'] ?> </td>
            <td><?php echo $stock['expiryDate'] ?> </td>
            <td><?php echo $stock['activity'] ?> </td>
        </tr>

        <?php endforeach ?>
        </tbody>
    </table>
</div>
</main>


<script>
window.onload = (e) => {
    
}

const fetchStock = (event) => {
    let dataId = event.target.getAttribute('data-stockEdit');
    showModal()
    box = document.getElementsByClassName('edit_box')[0];
    box.style.display = 'block';

    let url = 'apiControllers/stockEditform.php' ;

    let formData = new FormData();
    formData.append('edit_id', dataId);

    fetchData = {
        method: "POST",
        body: formData,
        headers: new Headers
    }

    fetch(url, fetchData)
    .then((resp) => resp.text())
    .then((data) => box.innerHTML = data)
    .catch((err) => console.warn(err))
}
</script>