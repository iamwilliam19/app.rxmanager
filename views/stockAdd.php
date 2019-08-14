

<main class="display-main">
    <div class="prod_main_title">Products</div>

    <section class="products-main-box">
        <div class="prod-box">
        <form>
            <div class="prod-sub-title">
            Add new product
            </div>
            <div class="prod-sub-cont">

            <span class="stock_error idError"></span>
            <div class="prod-list-box">
            
                    <label for="code">Product ID</label>
                    <div class="list-input">
                        <input type="text" name="code" id="code" placeholder="enter procuct id or generate new one" />
                        <span><i class="fas fa-pencil-alt"></i></span>
                        <div style="clear:both"></div>
                    </div>
                    
                </div>

                <div class="gen-id">Generate ID</div>
                
                <span class="stock_error brandError"></span>
                <div class="prod-list-box">
                    <label for="brand">Brand</label>
                    <div class="list-input">
                        <input type="text" name="brand" id="brand" placeholder="enter product brand" />
                        <span><i class="fas fa-pencil-alt"></i></span>
                        <div style="clear:both"></div>
                    </div>
                </div>
                
                <span class="stock_error nameError"></span>
                <div class="prod-list-box">
                    <label for="name">Product name</label>
                    <div class="list-input">
                        <input type="text" name="item_name" id="name" placeholder="enter product name" />
                        <span><i class="fas fa-pencil-alt"></i></span>
                        <div style="clear:both"></div>
                    </div>
                </div>
                <span class="stock_error catError"></span>
                <div class="prod-list-box">
                    <label for="category">Category</label>
                    <div class="list-input">
                        <input list="cat" name="category" id="category" placeholder="enter product brand" />
                        <datalist id="cat">
                            <option value="Antiseptics" >
                            <option value="Beverages" >
                            <option value="Cosmetics" >
                            <option value="Dentals" >
                            <option value="House wares" >
                            <option value="Pharmaceuticals" >
                            <option value="Snacks" >
                            <option value="Others" >
                        </datalist>
                        <span><i class="fas fa-pencil-alt"></i></span>
                        <div style="clear:both"></div>
                    </div>
                </div>

                <span class="stock_error expiryError"></span>
                <div class="prod-list-box">
                    <label for="expiry-date">Expiry date</label>
                    <div class="list-input">
                        <input  type="text" placeholder="MM/YY eg. 03/12" name="date" id="expiry-date" />
                        <span><i class="fas fa-calendar-alt"></i></span>
                        <div style="clear:both"></div>
                    </div>
                </div>

                <span class="stock_error secError"></span>
                <div class="prod-sec-box">

                <div class="prod-child-div">
                    <div class="prod-child-top">Quantity</div>
                    <div class="prod-child-bot">
                        <input type="number" id="qty" name="qty" value="0" />
                    </div>
                </div>

                <div class="prod-child-div">
                    <div class="prod-child-top">Unit</div>
                    <div class="prod-child-bot">
                        <input type="number" id="unit" name="unit" value="0" />
                    </div>
                </div>
                <div class="prod-child-div">
                <div class="prod-child-top">Form</div>
                    <div class="prod-child-bot">
                        <input list="forms" id = "form" name="product_form">
                    <datalist id="forms">
                        <option value="Bts">
                        <option value="Cap">
                        <option value="Card">
                        <option value="Pcs">
                        <option value="Pkt">
                        <option value="Sch">
                        <option value="Tablet">
                        <option value="Tin">
                         <option value="Tube">
                    </datalist>
                    </div>
                </div>
                <div class="prod-child-div">
                <div class="prod-child-top">Price</div>
                    <div class="prod-child-bot">
                        <input type="number" id="price" name="price" value="0" />
                    </div>
                </div>
                <div style="clear:both"></div>
                </div>

                
                

                <div class="error-log-box">
                    <div class="error-log-but">
                        Log error +
                    </div>

                    <textarea name="error_log" id="error-log" placeholder="Enter error log..."></textarea>
                <div style="clear:both"></div>
                </div>
                <!--error log ends-->

                <div class="add-prod">
                   Add
                </div>
            </div>

            <button type="reset" id="reset-button" style="display:none"></button>

</form>
        </div>
        <div class="prod-box">
           <div class="prod-sub-title">
            Added products
            </div>

            <div class="prod-sub-cont list-box " id="list-box"> </div>
        </div>
        <div style="clear:both"></div>
    </section>
</main>


<script>
    window.onload = (event) => {
        

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
            //fetchValue(e.target.value);
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

    }

    const fetchValue = (idValue) => {
        url = "apiControllers/stockAddProcessor.php";

        formData = new FormData();
        formData.append("idValue",idValue);

        fetchData = {
            method : 'POST',
            body : formData,
            headers : new Headers()
        } 

        fetch(url, fetchData)
        .then((response) => response.text())
        .then((data) => {
            console.log(data);
        })
        .catch((err) => console.log(err));
    }
        

    /*const validateDate = (dValue) =>
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
  }*/

  // update list function
  const updateList = () => {
      let url = "apiControllers/recListProcessor.php";
        let formData = new FormData();
        formData.append('uname','<?php echo $_SESSION['token'] ?>');

        fetchData = {
            method: "POST",
            body: formData,
            headers: new Headers
        }
      fetch(url, fetchData)
      .then((resp) => resp.text())
      .then((data) => {
          document.getElementById('list-box').innerHTML = data;
      })
      .catch((err) => console.warn(err));
  }

  
  const editList = (e) => {
      let editId = e.target.dataset.edit;
      showModal();
      
      fetchEditItems(editId);
  }

  const deleteList = (e) => {
      let deleteId = e.target.dataset.delete;
      let confirmation = confirm("Click OK to Delete item from list");

      if(confirmation){
          //run fetch and delete Item
          let url = 'apiControllers/deleteItem.php';
          let formData = new FormData();
          formData.append("deleteId",deleteId);

          let fetchData = {
              method: "POST",
              body: formData,
              headers: new Headers
          }

          fetch(url, fetchData)
          .then((resp) => resp.text())
          .then((data) => {
                if(data == "success"){
                    updateList();
                }
           })
          .catch((err) => console.warn(err))
      }
  }

  const fetchEditItems = (editId) => {
     let url = 'apiControllers/editform.php' 
    let formData = new FormData();
    formData.append('edit_id', editId);

    fetchData = {
        method: 'POST',
        body: formData,
        headers: new Headers
    }

    
    fetch(url, fetchData)
    .then((resp) => resp.text())
    .then((data) => {
        box = document.getElementsByClassName('edit_box')[0];
        box.style.display = 'block';
        document.getElementsByClassName('edit_box')[0].innerHTML = data;
    })
    .catch((err) => console.warn(err));


  }

  //clicking done
  const listDone = (e) => {
      let regname = e.target.dataset.done;
      let confirmation = confirm("Click OK to complete list upload");
      if(confirmation){
        let url = 'apiControllers/completeList.php' 
            let formData = new FormData();
            formData.append('uname', regname);

            fetchData = {
                method: 'POST',
                body: formData,
                headers: new Headers
            }

            
            fetch(url, fetchData)
            .then((resp) => resp.text())
            .then((data) => {
            if(data == "success"){
                
                updateList();
            }else{
                console.log(data)
            }
            })
            .catch((err) => console.warn(err));
      }
  }



  //clicking done
  const listDelete = (e) => {
      let regname = e.target.dataset.delete;
        let confirmation = confirm("Click OK to delete list");
        if(confirmation){
             let url = 'apiControllers/deleteList.php' 
            let formData = new FormData();
            formData.append('uname', regname);

            fetchData = {
                method: 'POST',
                body: formData,
                headers: new Headers
            }

            
            fetch(url, fetchData)
            .then((resp) => resp.text())
            .then((data) => {
            if(data == "success"){
                updateList();
            }
            })
            .catch((err) => console.warn(err));
        }
  }

   

</script>
