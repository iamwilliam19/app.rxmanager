<?php

    //include api processors
    require "productProcessor.php";

    //instantiate apiProcessor
    $processor = new  productProcessor();
    $product = $_POST['product'];

    //fetch the datils of the table
    $data = $processor->getFormDetails($product);
    
?> 



<div class="prod-box " style="width:100%;">
        <form>
            <div class="prod-sub-title">
                Edit product
            </div>
            <div class="prod-sub-cont">

            <span class="stock_error idError-edit"></span>
            <div class="prod-list-box">
            
                    <label for="code">Product ID</label>
                    <div class="list-input">
                        <input type="text" name="code" id="stockEdit" placeholder="enter procuct id or generate new one" value="<?php echo $data->item_id ?>" /> 
                        <span><i class="fas fa-pencil-alt"></i></span>
                        <div style="clear:both"></div>
                    </div>
                    
                </div>

                <div class="edit-gen-id" onclick="genStockId()" >Generate ID</div>
                
                <span class="stock_error brandError-edit"></span>
                <div class="prod-list-box">
                    <label for="brand">Brand</label>
                    <div class="list-input">
                        <input type="text" name="brand" id="stock_brand-edit" placeholder="enter product brand" value="<?php echo $data->brand ?>"/>
                        <span><i class="fas fa-pencil-alt"></i></span>
                        <div style="clear:both"></div>
                    </div>
                </div>
                
                <span class="stock_error nameError-edit"></span>
                <div class="prod-list-box">
                    <label for="name">Product name</label>
                    <div class="list-input">
                        <input type="text" name="item_name" id="stock_name-edit" placeholder="enter product name" value="<?php echo $data->item_name ?>" />
                        <span><i class="fas fa-pencil-alt"></i></span>
                        <div style="clear:both"></div>
                    </div>
                </div>
                <span class="stock_error catError-edit"></span>
                <div class="prod-list-box">
                    <label for="category">Category</label>
                    <div class="list-input">
                        <input list="cat" name="category" id="stock_category-edit" placeholder="enter product brand" value="<?php echo $data->category ?>" />
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

                <span class="stock_error expiryError-edit"></span>
                <div class="prod-list-box">
                    <label for="expiry-date">Expiry date</label>
                    <div class="list-input">
                        <input  type="text" placeholder="MM/YY" name="date" id="stock_expiry-date-edit" value="<?php echo $data->expiryDate ?>" />
                        <span><i class="fas fa-calendar-alt"></i></span>
                        <div style="clear:both"></div>
                    </div>
                </div>

                <span class="stock_error secError-edit"></span>
                <div class="prod-sec-box">

                

                <div class="prod-child-div">
                    <div class="prod-child-top">Unit</div>
                    <div class="prod-child-bot">
                        <input type="number" id="stock_unit-edit" name="unit" value="<?php echo $data->unit ?>" />
                    </div>
                </div>
                <div class="prod-child-div">
                <div class="prod-child-top">Form</div>
                    <div class="prod-child-bot">
                        <input list="forms" id = "stock_form-edit" name="product_form" value="<?php echo $data->form ?>" >
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
                        <input type="number" id="stock_price-edit" name="price" value="<?php echo $data->price ?>" />
                    </div>
                </div>
                <div style="clear:both"></div>
                </div>

                
                

                

                <div class="add-prod" onclick="handleEdit()" >
                   Add
                </div>

                <div class="edit_cancel" onclick="hideStockEdit()">Cancel</div>
            </div>

            <button type="reset" id="reset-button" style="display:none"></button>

</form>
        </div>


       