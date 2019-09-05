<?php
 //get page url
  $url = $_SERVER['REQUEST_URI'];
?>



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

    <!--product debt box starts-->
    <div class="debt-pay-box"></div>
    <!-- product debt box ends-->
</div>

<!-- include javascript and other files-->
<script src="src/js/custom.js" type="text/javascript"></script>
<script src="src/js/customJquery.js"></script>

<script>

    window.onload = (e) => {
       countExp();
       let d = new Date();
        let day = d.getDate();
        let month = d.getMonth() + 1;
        let year =  d.getYear() - 100;
        let url = '<?php echo $url ?>';

        //check if we are in sales page
        if(url == '/app.rxmanager/sales'){
            fetchSales(day,month,year);

            document.getElementById('day').value = day;
            document.getElementById('month').value = month;
            document.getElementById('year').value = year;
        }else if(url == '/app.rxmanager/stockAdd'){
            //list my record if any
        updateList();
        
        //get elements
        let add = document.getElementsByClassName('add-prod')[0];
        let generator = document.getElementsByClassName('gen-id')[0];
        let id = document.getElementById('code');
        let brand = document.getElementById('brand');
        let category = document.getElementById('category');
        let prodName = document.getElementById('name');
        let expiryDate = document.getElementById('expiry-date');
        let unit = document.getElementById('unit');
        let form = document.getElementById('form');
        let price = document.getElementById('price');
        let errorLog = document.getElementById('error-log');
        let qty = document.getElementById('qty');
        let alpha = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
        //on clicking genetor
        generator.addEventListener('click', (e) => {
            let rand_value1 = Math.floor(Math.random() * 26);
            let rand_value2 = Math.floor(Math.random() * 26);
            let rand_number = Math.floor(Math.random() * (9999 - 1000 ) + 1000);
            let idValue = alpha[rand_value1] + alpha[rand_value2] + rand_number;
            id.value = idValue;
           // fetchValue(idValue);
        });

        //on input of code
        id.addEventListener('input', (e) => {
           let code = e.target.value;
           let url = 'apiControllers/matchProduct.php';

           let formData = new FormData();
           formData.append('code',code);

           let fetchData = {
               method:'POST',
               body: formData,
               headers: new Headers
           }

           fetch(url, fetchData)
           .then((resp) => resp.json())
           .then((data) => {
                let {name,brand,category,unit,form,price} = data;
               
                let autobrand = document.getElementById('brand').value = brand;
                let autocategory = document.getElementById('category').value = category;
                let autoprodName = document.getElementById('name').value = name;
                let autoexpiryDate = document.getElementById('expiry-date').focus();
                let autounit = document.getElementById('unit').value = unit;
                let autoform = document.getElementById('form').value = form;
                let autoprice = document.getElementById('price').value = price;
                
           }).catch((err) => console.warn(err))
        });

        //on clicking add
        add.addEventListener('click', (e) => {
        
            //erase all stock error
            document.getElementsByClassName('stock_error')[0].innerText = '';
            if(id.value.length < 6 ){
                document.getElementsByClassName('idError')[0].innerText = "Please enter an Id of 6 characters";
                id.value = '';
                id.focus();
            }else if(brand.value.length == 0){
                document.getElementsByClassName('brandError')[0].innerText = "Please enter a product brand";
                brand.focus();
            }else if(prodName.value.length == 0){
                document.getElementsByClassName('nameError')[0].innerText = "Please enter a product name";
                prodName.focus();
            }else if(category.value.length == 0){
                document.getElementsByClassName('catError')[0].innerText = "Please enter a product category";
                category.focus();
            }else if(!validateDate(expiryDate.value)){
                document.getElementsByClassName('expiryError')[0].innerText = "Please enter expiry date in correct format";
                expiryDate.focus();
            }else if(qty.value.length == 0){
                document.getElementsByClassName('secError')[0].innerText = "Please enter product quantity";
                qty.focus();
            }else if(unit.value.length == 0){
                document.getElementsByClassName('secError')[0].innerText = "Please enter  product unit";
                unit.focus();
            }else if(form.value.length == 0){
                document.getElementsByClassName('secError')[0].innerText = "Please enter  product form";
                form.focus();
            }else if(price.value.length == 0){
                document.getElementsByClassName('secError')[0].innerText = "Please enter  product price";
                price.focus();
            }else if(qty.value < 1){
                document.getElementsByClassName('secError')[0].innerText = "Product Quantity invalid";
                qty.focus();
            }else if(unit.value < 1){
                document.getElementsByClassName('secError')[0].innerText = "Product unit invalid";
                unit.focus();
            }else if(price.value < 1){
                document.getElementsByClassName('secError')[0].innerText = "Product price invalid";
                price.focus();
            }else{
                
                let postFormData = new FormData();
                postFormData.append("code",id.value);
                postFormData.append("name",prodName.value);
                postFormData.append("brand",brand.value);
                postFormData.append("category",category.value);
                postFormData.append("expiryDate",expiryDate.value);
                postFormData.append("qty",qty.value);
                postFormData.append("unit",unit.value);
                postFormData.append("form",form.value);
                postFormData.append("price",price.value);
                postFormData.append("errorLog",errorLog.value);
                postData = {
                    method: 'POST',
                    body: postFormData,
                    headers: new Headers
                }

                let postUrl = "apiControllers/stockTempProcessor.php";

                fetch(postUrl, postData)
                .then((resp) => resp.text())
                .then((data) => {
                    if(data != "success"){
                        showModal();
                        let errorBox = document.getElementsByClassName("stockRecErrorBox")[0]
                        errorBox.style.display = "block";
                        stockError(data);
                        
                    }else{
                        document.getElementById('reset-button').click();
                        id.focus();
                        updateList();
                    }
                   
                })
                .catch((err) => console.log(err))
            }

        });

        }else if(url == '/app.rxmanager/expenses'){
            
            d = new Date();
            let date = d.getDate();
            let month = d.getMonth();
            month += 1;
            let year = d.getYear();
            if(date < 10){
              date = '0' + date;
            
            }

            if(month < 10){
              month = '0' + month;
            
            }
            year -= 100;
        
            listExp(date,month,year);
        
            loadExp();
        }

        
       
    }

    //sales start
    const fetchSales = (d,m,y) => {
          
          let url = "apiControllers/sales.php";

          let formData = new FormData();
          formData.append('day',d);
          formData.append('month',m);
          formData.append('year',y);
          let fetchData = {
              method: "POST",
              body: formData,
              headers: new Headers
          }

          fetch(url, fetchData)
          .then((resp) => resp.text())
          .then((data) => {
                document.getElementsByClassName('up-table')[0].innerHTML = data;
                fetchTotal(d,m,y);
          }).catch((err) => console.warn(err));
      }

    //sales end
    
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


    //expenses starts
    const deleteExp = (event) => {
        let deleteId = event.target.dataset.delete;
        let date = event.target.dataset.day;
        let month = event.target.dataset.month;
        let year = event.target.dataset.year;
        let url = "apiControllers/expDelete.php";

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
            d = new Date();
           
            listExp(date,month,year);

        })
        .catch((err) => console.warn(err));
        
    }

    const moreExp = (event) => {
        let date = event.target.dataset.date;
        let month = event.target.dataset.month;
        let year = event.target.dataset.year;
        listExp(date,month,year);
    }

    //expenses ends

    //debt paynment starts
    const hideDebtPay = () => {
        let box = document.getElementsByClassName('debt-pay-box')[0];
        box.style.display = "none";
        hideModal();
    }

    const showAmt = (debt) => {
        document.getElementById('debtAmt').textContent = debt;
        document.getElementById('debtInput').focus();
        return debt;
    }

    const submitPayment = (id, debt) => {
        
        let amt = document.getElementById('debtInput');
        if(amt.value.length < 1 ){
            document.getElementById('error').textContent = "Please enter valid amount";
            
            amt.focus();
        }else{
            let confirmation = confirm("Click ok to complete transaction");
            if(confirmation){
                let url = "apiControllers/debtComplete.php";

                let formData = new FormData();
                formData.append('debt',debt );
                formData.append('id',id);
                formData.append('amt',amt.value);
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
        }
    }
    //debt payment ends

    //expired product count
        const countExp = () => {
            let url = "apiControllers/countExp.php";

            

            fetch(url)
            .then((resp) => resp.text())
            .then((data) => {
                
               document.getElementsByClassName('danger')[0].textContent = data;
            })
            .catch((err) => console.warn(err));
        }
    //expred product count end


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