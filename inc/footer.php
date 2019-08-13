



</body>
</html>


<div class="modal hide_block">
<!--stock rec error starts-->
    <div class="stockRecErrorBox">
        <div class="rec_top">
            
        </div>
        <div class="rec_bottom">
            <div class="rec_ok">
                OK
            </div>
        </div>
    </div>
    <!--stock re error ends-->
    
    <!--stock edit box starts-->
    <div class="edit_box"></div>
    <!--stock edit box ends-->

    <!--product edit box starts-->
    <div class="stock-edit-box"></div>
    <!-- product edit box ends-->
</div>

<!-- include javascript and other files-->
<script src="src/js/custom.js" type="text/javascript"></script>
<script src="src/js/customJquery.js"></script>

<script>
    //js for edit form
    const hideEditForm = () => {
        box = document.getElementsByClassName('edit_box')[0].style.display = "none";
        hideModal();
    }

    const editGenId = () => {
        //get elements
        let codeEdit = document.getElementById('codeEdit');
        
        let alpha = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];

        let rand_value1 = Math.floor(Math.random() * 26);
            let rand_value2 = Math.floor(Math.random() * 26);
            let rand_number = Math.floor(Math.random() * (9999 - 1000 ) + 1000);
            let idValue = alpha[rand_value1] + alpha[rand_value2] + rand_number;
            codeEdit.value = idValue;

    }

    const addEdit = (editId) => {
        //get elements
        let codeEdit = document.getElementById('codeEdit');
        let brand = document.getElementById('brand-edit');
        let name = document.getElementById('name-edit');
        let category = document.getElementById('category-edit');
        let expiryDate = document.getElementById('expiry-date-edit');
        let qty = document.getElementById('qty-edit');
        let unit = document.getElementById('unit-edit');
        let form = document.getElementById('form-edit');
        let price = document.getElementById('price-edit');
        let errorLog = document.getElementById('error-log-edit');

        if(codeEdit.value.length < 6){
            document.getElementsByClassName('idError-edit')[0].innerText = 'The code Id should be upto 6 characters';
            codeEdit.focus();
        }else if(brand.value.length == 0){
            document.getElementsByClassName('brandError-edit')[0].innerText = 'Product brand cannot be empty';
            brand.focus();
        }else if(name.value.length  == 0){
            document.getElementsByClassName('nameError-edit')[0].innerText = 'Product name cannot be empty';
            name.focus();
        }else if(category.value.length == 0){
            document.getElementsByClassName('catError-edit')[0].innerText = 'Product category cannot be empty';
            category.focus();
        }else if(codeEdit.value.length < 6){
            document.getElementsByClassName('idError-edit')[0].innerText = 'The code Id should be upto 6 characters';
            codeEdit.focus();
        }else if(!validateDate(expiryDate.value)){
            document.getElementsByClassName('expiryError-edit')[0].innerText = 'Please enter expiry date in correct format';
            expiryDate.focus();
        }else if(qty.value.length == 0 || qty.value == 0){
            document.getElementsByClassName('secError-edit')[0].innerText = 'Product quantity cannot be empty';
            qty.focus();
        }else if(unit.value.length == 0 || unit.value == 0){
            document.getElementsByClassName('secError-edit')[0].innerText = 'Product unit cannot be empty';
            unit.focus();
        }else if(form.value.length == 0 || form.value == 0){
            document.getElementsByClassName('secError-edit')[0].innerText = 'Product form cannot be empty';
            form.focus();
        }else if(price.value.length == 0 || price.value == 0){
            document.getElementsByClassName('secError-edit')[0].innerText = 'Product price cannot be empty';
            price.focus();
        }else{

            //create form data
            let formData = new FormData();
            formData.append('code', codeEdit.value);
            formData.append('brand', brand.value);
            formData.append('name', name.value);
            formData.append('category', category.value);
            formData.append('expiryDate', expiryDate.value);
            formData.append('qty', qty.value);
            formData.append('unit', unit.value);
            formData.append('form', form.value);
            formData.append('price', price.value);
            formData.append('errorLog', errorLog.value);
            formData.append('editId', editId);

            //create fetch data
            let fetchData = {
                method: "POST",
                body: formData,
                headers: new Headers
            }

            let url = "apiControllers/editProcessor.php";

            fetch(url, fetchData)
            .then((resp) => resp.text())
            .then((data) => {
                if(data == "success"){
                    console.log(data)
                }else{
                    alert("Update successful");
                    box = document.getElementsByClassName('edit_box')[0].style.display = "none";
                    hideModal();
                }
            })
            .catch((err) => console.warn(err))
        }
        
    }

    //js for edit form ends

    //js for stock analysis edit starts
    const hideStockEdit = () => {
            document.getElementsByClassName('stock-edit-box')[0].style.display = 'none';
            hideModal();
        }

    const genStockId = () => {
        let alpha = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
        let code = document.getElementById('stockEdit');
        let rand_value1 = Math.floor(Math.random() * 26);
            let rand_value2 = Math.floor(Math.random() * 26);
            let rand_number = Math.floor(Math.random() * (9999 - 1000 ) + 1000);
            let idValue = alpha[rand_value1] + alpha[rand_value2] + rand_number;
            code.value = idValue;
    } 

    const handleEdit = () => {
        let code = document.getElementById('stockEdit');
        let brand = document.getElementById('stock_brand-edit');
        let name = document.getElementById('stock_name-edit');
        let category = document.getElementById('stock_category-edit');
        let expiryDate = document.getElementById('stock_expiry-date-edit');
        let unit = document.getElementById('stock_unit-edit');
        let form = document.getElementById('stock_form-edit');
        let price = document.getElementById('stock_price-edit');


        if(code.value.length < 6){
            document.getElementsByClassName('idError-edit')[0].innerText = 'Please enter a valid product ID ';
            code.focus();
        }else if(brand.value.length == 0){
            document.getElementsByClassName('brandError-edit')[0].innerText = 'Please enter a valid product brand ';
            brand.focus();
        }else if(name.value.length == 0){
            document.getElementsByClassName('nameError-edit')[0].innerText = 'Please enter a valid product name ';
            name.focus();
        } else if(category.value.length == 0){
            document.getElementsByClassName('catError-edit')[0].innerText = 'Please enter a valid product category';
            category.focus();
        }else if(expiryDate.value.length == 0){
            document.getElementsByClassName('expiryError-edit')[0].innerText = 'Please enter a valid product expiry date ';
            expiryDate.focus();
        }else if(!validateDate(expiryDate.value)){
            document.getElementsByClassName('expiryError-edit')[0].innerText = 'Please enter a valid product expiry date ';
            expiryDate.focus();
        }else if(unit.value.length == 0 || unit.value == 0){
            document.getElementsByClassName('secError-edit')[0].innerText = 'Please enter a valid product unit ';
            unit.focus();
        }else if(form.value.length == 0){
            document.getElementsByClassName('secError-edit')[0].innerText = 'Please enter a valid product form ';
            form.focus();
        }else if(price.value.length == 0 || price.value == 0){
            document.getElementsByClassName('secError-edit')[0].innerText = 'Please enter a valid product price ';
            price.focus();
        }else{

            //make a fetch api
            let url = 'apiControllers/stockEditProcessor.php';
            let formData = new FormData();

            formData.append('code', code.value);
            formData.append('name', name.value);
            formData.append('brand', brand.value);
            formData.append('category', category.value);
            formData.append('expiryDate', expiryDate.value);
            formData.append('unit', unit.value);
            formData.append('form', form.value);
            formData.append('price', price.value);

            let fetchData = {
                method: 'POST',
                body: formData,
                headers: new Headers
            }

            fetch(url, fetchData)
            .then((resp) => resp.text())
            .then((data) => console.log(data))
            .catch((err) => console.warn(err))

        }
    }

    //js stock analysis edit ends




    //date validation
    
const validateDate = (dValue) =>
  {
    let result = true;
    dValue1 = dValue.split('/');
    
    let pattern = /^\d{2}$/;

    if(dValue1[0] < 1 || dValue1[0] > 12)
    result = false;

    if(!pattern.test(dValue1[0]) || !pattern.test(dValue1[1]))
    result = false;

    if(dValue1[2])
    result = false;

    return result;


    dValue2 = dValue.split('-');
    

    if(dValue2[0] < 1 || dValue2[0] > 12)
    result = false;

    if(!pattern.test(dValue2[0]) || !pattern.test(dValue2[1]))
    result = false;

    if(dValue2[2])
    result = false;

    return result;
  }
</script>