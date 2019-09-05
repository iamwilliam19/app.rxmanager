
<main class="display-main">
<div class="error" style="text-align:center; margin-bottom: 20px;"> </div>
<div class="expsuccess" style="text-align:center; margin-bottom: 20px;"> </div>
    <section class="exp_box">

    
        <div class="exp_inp exp-two">
            <label for="amt">Amount:</label>
            <div class="exp_val">
                <input type="number" min="0" placeholder="0.00" id="amt" autofocus />
            </div>
        </div>
        <div class="exp_inp exp-two">
        <label for="purpose">Purpose:</label>
            <div class="exp_val">
                <input type="text"  placeholder="eg: food" id="purpose" />
            </div>
        </div>
        <div class="exp_inp">
            <div class="exp_add" onclick="addExp()">ADD</div>
        </div>
        <div style="clear:both"></div>
    </section>


    <section class="other_exp_box">
        <div class="other_exp_sub first_sub"> </div>

        <div class="other_exp_sub second_sub"> </div>
        <div style="clear:both"></div>
    </section>

</main>


<script>
   

    const addExp = () => {
        let amt = document.getElementById("amt");
        let purp = document.getElementById("purpose");
        let error = document.getElementsByClassName('error')[0];
        let suc = document.getElementsByClassName('expsuccess')[0];
        error.textContent = '';
        suc.textContent = '';
        if(amt.value == 0 || amt.value.length < 1){
            error.textContent = 'Please add an amount';
        }else if(purp.value.trim().length < 1){
            error.textContent = "Please add purpose for withdrawal";
        }else{
            //post the values
            let url = "apiControllers/addExpense";
            let formData = new FormData();
            formData.append('amt',amt.value);
            formData.append('purpose',purp.value);

            let fetchData = {
                method: 'POST',
                body: formData,
                headers: new Headers
            }

            fetch(url, fetchData)
            .then((resp) => resp.text())
            .then((data) =>{
                if(data == 'success'){
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
                    suc.textContent = 'Expense recorded';
                    amt.value = '';
                    purp.value = '';
                    amt.focus();
                }else{
                    error.textContent = "Expense not recorded, please try again ";
                }
            }).catch((err) => console.warn(err));
        }
    }  


    const listExp = (date,month,year) => {
        
        let url = 'apiControllers/listExp.php';

        let formData = new FormData();
            formData.append('date',date);
            formData.append('month',month);
            formData.append('year',year);

            let fetchData = {
                method: 'POST',
                body: formData,
                headers: new Headers
            }

            fetch(url, fetchData)
            .then((resp) => resp.text())
            .then((data) => {
                //console.log(data)
                document.getElementsByClassName('first_sub')[0].innerHTML = data;
                loadExp();
            }).catch((err) => console.warn(err))
    }

    const loadExp = () => {
        let url = 'apiControllers/allExp.php';

        

            fetch(url)
            .then((resp) => resp.text())
            .then((data) => {
                document.getElementsByClassName('second_sub')[0].innerHTML = data;
            }).catch((err) => console.warn(err))
    }
</script>