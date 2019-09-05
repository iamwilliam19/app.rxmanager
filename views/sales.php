<main class="display-main">

  <div class=" page-title dashboard">
    Sales analysis
  </div>

<!--date sort-->
    <div class="sale-error"></div>
    <section class="date-box">
        <span class="date-inp">
            <input type="number" min="01" max="31" placeholder="dd" id="day" />
        </span>
        <span class="date-inp">
            <input type="number" min="01" max="12" placeholder="mm" id="month" />
        </span>
        <span class="date-inp">
            <input type="number" min="01" placeholder="yy" id="year" />
        </span>
        <span class="date-inp">
        <input type="submit" onclick="getSales()" value="view" />
        </span>
    </section>


    <!--sales table -->
    <section class="sale-table up-table">
       
    </section>

    <section class="sale-table down-table"> </section>
  </main>

  <script>
    

      const getSales = () => {
          let d = document.getElementById('day');
          let m = document.getElementById('month');
          let y = document.getElementById('year');
          let error = document.getElementsByClassName('sale-error')[0];
        error.textContent = '';
          if(d.value < 1 || d.value == '' || d.value > 31 || d.value.length > 2){
            error.textContent = 'PLease enter a valid day';
            d.value = '';
            d.focus();
          }else if(m.value < 1 || m.value == '' || m.value > 12 || m.value.length > 2){
            error.textContent = 'PLease enter a valid month';
            m.value = '';
            m.focus();
          }else if(y.value < 1 || y.value == '' ||  y.value.length > 2){
            error.textContent = 'PLease enter a valid year';
            y.value = '';
            y.focus();
          }else{
              fetchSales(d.value,m.value,y.value);
          }
      }

      
      const fetchTotal = (d,m,y) => {
        let url = "apiControllers/totalSales.php";

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
                document.getElementsByClassName('down-table')[0].innerHTML = data;
              
          }).catch((err) => console.warn(err));
      }
  </script>