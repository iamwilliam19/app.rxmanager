<main class="display-main">
<?php
    

    //include stock model
    require "models/stock_model.php";
    //instantiate stock class
    $stock = new Stock_manager();
    $product = $_GET['product'];
    $my_stock = $stock->getProduct($product);
    $other_stock = $stock->getOtherProduct($product);
    
?>

<div class="page-title dashboard">General analysis</div>

<section class="stock-view-box">
    <div class="view-box">
        <div class="view-box-sub">
            <span class="view-tag">Product Name:</span> <span class="view-ans"><?php echo $my_stock->item_name ?></span>
        </div>

        <div class="view-box-sub">
            <span class="view-tag">Category:</span> <span class="view-ans"><?php echo $my_stock->category ?></span>
        </div>

        <div class="view-box-sub">
            <span class="view-tag">Brand:</span> <span class="view-ans"><?php echo $my_stock->brand ?></span>
        </div>

        <div class="view-box-sub">
            <span class="view-tag">Unit:</span> <span class="view-ans"><?php echo $my_stock->unit ?></span>
        </div>

        <div class="view-box-sub">
            <span class="view-tag">Expired:</span> <span class="view-ans">Acepol</span>
        </div>

        
    </div>
    <div class="view-box">
    <div class="view-box-sub">
            <span class="view-tag">Product Id:</span> <span class="view-ans"><?php echo $my_stock->item_id ?></span>
        </div>

        <div class="view-box-sub">
            <span class="view-tag">Form:</span> <span class="view-ans"><?php echo $my_stock->form ?></span>
        </div>

        <div class="view-box-sub">
            <span class="view-tag">Price/unit:</span> <span class="view-ans"><?php echo $my_stock->price ?></span>
        </div>

        <div class="view-box-sub">
            <span class="view-tag">In Stock:</span> <span class="view-ans"><?php echo $my_stock->qty; ?></span>
        </div>
    </div>
    <div style="clear: both"></div>

    <div class="stock-edit">
        Edit
    </div>
</section>

<br>
<br>
<div class="page-title dashboard">Batch analysis</div>
<section class="stock-view-box">
<table>
        <thead>
            <tr>
                <th>Registered by</th>
                <th>Registered on</th>
                <th>Quantity</th>
                <th>To expire</th>
                <th>Details</th>
            </tr>
            </thead>
            <tbody>
                <?php 
                    foreach($other_stock as $stock):
                ?>
            <tr>
                <td><?php echo $stock['registered_by'] ?></td>
                <td><?php echo $stock['registered_on'] ?></td>
                <td><?php echo $stock['quantity'] ?></td>
                <td><?php echo $stock['expiryDate']?></td>
                <td>
                <a href="stock_view<?php //echo '?product='.$stock['item_name'] ?>"> <div class="more">more</div></a>
                </td>
            </tr>

            <?php endforeach ?>
            </tbody>
        </table>

</section>


    

</main>


<script>

    window.onload = (e) => {
        
        document.getElementsByClassName('stock-edit')[0].addEventListener('click',(e) => {
            showModal();
            const stockEditBox = document.getElementsByClassName('stock-edit-box')[0];
            stockEditBox.style.display = 'block';

            //fetch the form 
            let formData = new FormData();
            formData.append('product','<?php echo $product ?>')

            let fetchData = {
                method: "POST",
                body: formData,
                headers: new Headers
            }

            let url = "apiControllers/productEditForm.php";

            fetch(url, fetchData)
            .then((resp) => resp.text())
            .then((data) => stockEditBox.innerHTML = data)
            .catch((err) => console.warn(err))
        })
    }
</script>