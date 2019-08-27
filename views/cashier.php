
<main class="display-main">


    <div class="prod_main_title">Cashier</div>

    <section class="products-main-box">
        <div class="prod-box">
            
        <form onsubmit="return validateForm()">
            
            <div class="prod-sub-cont" style="border : none;">
                
              <div class="casheir_box">
              <span class="error-span"></span>
              <span class="success-span"></span>
                    <div class="casheir-sub casheir-top">
                        <div class="casheir-top-left">
                            <label for="product_id">
                                Product ID:
                            </label>
                            <div class="id-box">
                                <input type="text"  id="product_id" placeholder="enter product id or name"  autofocus/>
                            </div>
                        </div>

                        <div class="casheir-top-right">
                            <label for="qty">
                                Qty:
                            </label>
                            <div class="qty-box">
                                <input type="number" id="qty" value="0"/>
                            </div>
                        </div>
                    </div>
                    <div class="casheir-sub casheir-bottom">
                        <button type="reset" class="casheir-cancel">
                            Cancel
                        </button>
                        <button class="casheir-add" type="submit">
                            Add
                        </button>
                        <div style="clear:both"></div>
                    </div>
              </div> 
              
            </div>

            <button type="reset" id="reset-button" style="display:none"></button>

</form>
        </div>
        <div class="prod-box">

            <div class="prod-sub-cont list-box " id="list-box"> 
                
            </div>
        </div>
        <div style="clear:both"></div>
    </section>
</main>



<script>
    window.onload = (e) => {
        updateCart();
    }

    const validateForm = (e) => {
        
            let prodId = document.getElementById('product_id');
            let qty = document.getElementById('qty');
            let errorSpan = document.getElementsByClassName('error-span')[0];
            let goodSpan = document.getElementsByClassName('success-span')[0];
            errorSpan.textContent = '';
            goodSpan.textContent = '';
            if(prodId.length == 0 || qty.length == 0){
                errorSpan.textContent = 'Please fill all fields';
            }else{
                //make fetch
                let url = 'models/casheirModel.php';
                let formData = new FormData();
                formData.append('product', prodId.value);
                formData.append('qty', qty.value);

                let fetchData = {
                    method: 'POST',
                    body: formData,
                    headers: new Headers
                }

                fetch(url, fetchData)
                .then((resp) => resp.text())
                .then((data) => {
                    if(data != "success"){
                        document.getElementsByClassName('error-span')[0].textContent = data;
                        setTimeout(() => {
                            errorSpan.textContent = '';
                            prodId.value = '';
                            qty.value = 0;
                        }, 1000);
                    }else{
                        document.getElementsByClassName('success-span')[0].textContent = data;
                        setTimeout(() => {
                            goodSpan.textContent = '';
                            prodId.value = '';
                            qty.value = 0;
                            prodId.focus();
                            updateCart();
                        }, 1000);
                    }
                } )
                .catch((err) => console.warn(err))

            }
            return false;
        }

        const updateCart = () => {
            let url = "apiControllers/cart.php";

            fetch(url)
            .then((resp) => resp.text())
            .then((data) => {
                document.getElementsByClassName('list-box')[0].innerHTML = data;
            })
            .catch((err) => console.warn(data))
        }
</script>