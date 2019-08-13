<?php 

    //include stock model
    require "models/stock_model.php";
    //instantiate stock class
    $stock = new Stock_manager();
    $my_stock = $stock->getStock();
    
?>

<main class="display-main">

    <div class="page-title dashboard">Total stock</div>

    <div class="stock-cont">
        <table>
        <thead>
            <tr>
                <th>Item name</th>
                <th>Item ID</th>
                <th>Quantity</th>
                <th>Form</th>
                <th>Price</th>
                <th>Details</th>
            </tr>
            </thead>
            <tbody>
                <?php 
                    foreach($my_stock as $stock):
                ?>
            <tr>
                <td><?php echo $stock['item_name'] ?></td>
                <td><?php echo $stock['item_id'] ?></td>
                <td><?php echo $stock['sum(quantity)'] ?></td>
                <td><?php echo $stock['form']?></td>
                <td><?php echo $stock['price']?></td>
                
                <td>
                <a href="stock_view<?php echo '?product='.$stock['item_name'] ?>"> <div class="more">more</div></a>
                </td>
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