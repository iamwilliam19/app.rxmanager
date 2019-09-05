<?php
  require 'models/dashboard_model.php';
  $processor = new dashboardModel();

?>

<main class="display-main">
  <div class=" page-title dashboard">
    Dashboard
  </div>
  <a href="sales"><section class="display-cube">
    <div class="cube-top">
      <div class="cube-left">
        <i class="fab fa-stack-overflow"></i>
      </div>
      <div class="cube-right"><?php echo $processor->countSales() ?></div>
    </div >
    <div class="cube-bottom sale-bottom">
      SALES
    </div >
  </section></a>

  <a href="expenses"><section class="display-cube">
    <div class="cube-top">
      <div class="cube-left ">
        <i class="fas fa-money-check-alt" ></i>
      </div>
      <div class="cube-right"><?php echo $processor->countExpenses() ?></div>
    </div >
    <div class="cube-bottom exp-bottom">
      EXPENSES
    </div >
  </section></a>

  <section class="display-cube">
    <div class="cube-top">
      <div class="cube-left ">
        <i class="fas fa-money-check-alt" ></i>
      </div>
      <div class="cube-right"><?php echo $processor->countReceipt() ?></div>
    </div >
    <div class="cube-bottom re-bottom">
      RECEIPTS
    </div >
  </section>

  <a href="stock"><section class="display-cube">
    <div class="cube-top">
      <div class="cube-left ">
        <i class="fas fa-cubes"></i>
      </div>
      <div class="cube-right"><?php echo $processor->countStock() ?></div>
    </div >
    <div class="cube-bottom stock-bottom">
      STOCK
    </div >
  </section></a>

  <a href="debt"> <section class="display-cube">
    <div class="cube-top">
      <div class="cube-left ">
        <i class="fas fa-coins"></i>
      </div>
      <div class="cube-right"><?php echo $processor->countDebt() ?></div>
    </div >
    <div class="cube-bottom debt-bottom">
      DEBTS
    </div >
  </section></a>

  <a href="staff"><section class="display-cube">
    <div class="cube-top">
      <div class="cube-left ">
        <i class="fas fa-users"></i>
      </div>
      <div class="cube-right"><?php echo $processor->countStaff() ?></div>
    </div >
    <div class="cube-bottom staff-bottom">
      STAFF
    </div >
  </section></a>

  <div style="clear:both"></div>

  <section class="big-cube-cont">
    <div class="graph-cube">

    </div>

    <div class="debt-cube">

    </div>

    <div style="clear:both"></div>
  </section>

</main>
