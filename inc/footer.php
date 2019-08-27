



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

    <!--product edit box starts-->
    <div class="batch-edit-box"></div>
    <!-- product edit box ends-->

    <!--product receipt box starts-->
    <div class="receipt-box"></div>
    <!-- product receipt box ends-->
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
                if(data.length != 9 ){
                    
                        alert(data)
                    
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

    /* genStockId = () => {
        let alpha = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
        let code = document.getElementById('stockEdit');
        let rand_value1 = Math.floor(Math.random() * 26);
            let rand_value2 = Math.floor(Math.random() * 26);
            let rand_number = Math.floor(Math.random() * (9999 - 1000 ) + 1000);
            let idValue = alpha[rand_value1] + alpha[rand_value2] + rand_number;
            code.value = idValue;
    }*/ 

    const handleEdit = () => {
        let code = document.getElementById('stockEdit');
        let brand = document.getElementById('stock_brand-edit');
        let name = document.getElementById('stock_name-edit');
        let category = document.getElementById('stock_category-edit');
    
        let unit = document.getElementById('stock_unit-edit');
        let form = document.getElementById('stock_form-edit');
        let price = document.getElementById('stock_price-edit');


        if(brand.value.length == 0){
            document.getElementsByClassName('brandError-edit')[0].innerText = 'Please enter a valid product brand ';
            brand.focus();
        }else if(name.value.length == 0){
            document.getElementsByClassName('nameError-edit')[0].innerText = 'Please enter a valid product name ';
            name.focus();
        } else if(category.value.length == 0){
            document.getElementsByClassName('catError-edit')[0].innerText = 'Please enter a valid product category';
            category.focus();
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
            .then((data) => {
                if(data != "success"){
                    console.log(data)
                }else{
                    location.replace("stock_view?product="+name.value);
                }
            })
            .catch((err) => console.warn(err))

        }
    }

    //js stock analysis edit ends



    //js for batch edit
    const hideBatchEdit = () => {
        let batchEditBox = document.getElementsByClassName('batch-edit-box')[0];
        batchEditBox.style.display = 'none';
        hideModal();
    }


    const submitBatch = (id) => {
        document.getElementsByClassName('stock_error').innerText = ' ';
        let qty = document.getElementById('batch-qty');
        let expiryDate = document.getElementById('batch-expiry-date');

        if(!validateDate(expiryDate.value) ){
            document.getElementsByClassName('batch-expiryError')[0].innerText = 'Please enter a valid expiry date';
        }else if(qty.value < 0 || qty.value == '' ){
            document.getElementsByClassName('batchsecError')[0].innerText = 'Please enter a valid quantity';
        }else {
            let formData = new FormData();
            formData.append('qty',qty.value);
            formData.append('expiryDate',expiryDate.value);
            formData.append('id',id);

            let fetchData = {
                method: "POST",
                body: formData,
                headers: new Headers
            }
            let url = "apiControllers/batchRecord.php";
            fetch(url, fetchData)
            .then((resp) => resp.text())
            .then((data) => {
                if(data == "success"){
                    location.reload();
                }else{
                    console.log(data)
                }
            })
            .catch((err) => console.warn(err))
        }
    }

    
    //js for batch edit ends
    
    //casheir js
    const updateNet = (event) => {
        let disccount = event.target.value;
        let net = document.getElementsByClassName('net')[0].textContent;
        let total = document.getElementsByClassName('total')[0].textContent;
        total -= (disccount / 100) * total;
        document.getElementsByClassName('net')[0].textContent = total;
    }

    const deleteOrder = (event) => {
        let deleteId = event.target.dataset.delete;
        let url = "apiControllers/orderDelete.php";

        let formData = new FormData();
        formData.append('id',deleteId );
        let fetchData = {
            method: 'POST',
            body: formData,
            headers: new Headers
        }

        fetch(url, fetchData)
        .then((resp) => resp.text())
        .then((data) => {
            if(data == "success"){
                location.reload();
            }
        })
        .catch((err) => console.warn(err));
        
    }


    const cartDelete = () => {
        let url = 'apiControllers/cartDelete.php';
        let uname = event.target.dataset.delete;
        let confirmation = confirm("click OK to delete Full cart");
        if(confirmation){
            let formData = new FormData();
            formData.append('uname',uname );
            let fetchData = {
                method: 'POST',
                body: formData,
                headers: new Headers
            }

            fetch(url, fetchData)
            .then((resp) => resp.text())
            .then((data) => {
                if(data == "success"){
                    location.reload();
                }
                //console.log(data)
            })
            .catch((err) => console.warn(err));
            }
    }

    const showCustBox = (e) => {
        if(e.target.value == "credit"){
            document.getElementsByClassName('credit-box')[0].style.display = 'block';
        }else{
            document.getElementsByClassName('credit-box')[0].style.display = 'none';
        }
    }

    const pay = (event) => {
        let uname = event.target.dataset.done;
        let name = document.getElementById('name').value.trim();
        let addr = document.getElementById('addr').value.trim();
        let phone = document.getElementById('phone').value.trim();
        let amtPaid = document.getElementById('amt_paid').value.trim();
        let transaction = document.getElementById('transaction').value.trim();
        let error = document.getElementById('error');
        error.textContent = '';
        let disccount = document.getElementsByClassName('disccount')[0].value;
        let hash = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P',
        'Q','R','S','T','U','V','W','X','Y','Z',1,2,3,4,5,6,7,8,9];

        let receiptId = '';
        let va ;
        for (let i = 0; i < 10; i++){
            va = Math.floor(Math.random() * 35);
             receiptId += hash[va];
        }
        
        let phoneReg = /^\(?([0-9]{4})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
        if(transaction == 'credit'){
            if(name.length == 0 || addr.length == 0 || phone.length == 0 || amtPaid.length == 0 ){
                error.textContent = "Please fill all fields";
            }else if(!phone.match(phoneReg)){
                error.textContent = "Please enter a valid phone number";
            }else {
                processCart(uname,name,addr,phone,transaction,receiptId,disccount,amtPaid);
            }
        }else if(transaction == 'cash'){
            processCartCash(uname,transaction,receiptId,disccount);
        }else{
            alert("PLease select transaction type")
        }
        
    }

    const processCart = (uname,name,addr,phone,transaction,receiptId,disccount,amtPaid) => {
        let url = "models/cartModel.php";

        let formData = new FormData();
        formData.append('uname',uname);
        formData.append('name',name);
        formData.append('addr',addr);
        formData.append('phone',phone);
        formData.append('disccount',disccount);
        formData.append('receiptId',receiptId);
        formData.append('amt_paid',amtPaid);
        formData.append('transaction',transaction);
        let fetchData = {
            method: 'POST',
            body: formData,
            headers: new Headers
        }

        fetch(url, fetchData)
        .then((resp) => resp.text())
        .then((data) => {
            if(data.length == 17){
                showReceipt(data);
            }
            console.log(data)
        }).catch((err) => console.warn(err))
    }

    const processCartCash = (uname,transaction,receiptId,disccount) => {
        let url = "models/cartModel.php";

        let formData = new FormData();
        formData.append('uname',uname);
        formData.append('receiptId',receiptId);
        formData.append('transaction',transaction);
        formData.append('disccount',disccount);
        let fetchData = {
            method: 'POST',
            body: formData,
            headers: new Headers
        }

        fetch(url, fetchData)
        .then((resp) => resp.text())
        .then((data) => {
            if(data.length == 17){
                showReceipt(data);
            }
            console.log(data);
        }).catch((err) => console.warn(err))
    }

    const showReceipt = (data) => {
        let receiptId = '' ;
        console.log(data)
        for(let i = 0; i < 17; i++){
            if(i > 6){
                receiptId += data[i];
            }
        }
        
       
        let receiptBox = document.getElementsByClassName('receipt-box')[0];
        let url = "apiControllers/receipt.php";

        let formData = new FormData();
        formData.append('receiptId',receiptId);

        fetchData = {
            method: 'POST',
            body: formData,
            headers: new Headers
        };

        fetch(url,fetchData)
        .then((resp) =>resp.text())
        .then((data) => {
            showModal();
            receiptBox.style.display = 'block';
            receiptBox.innerHTML = data;
        }).catch((err) => console.warn(err))
    }
    //cashier js ends



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