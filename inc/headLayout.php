<header>
  <div class="menu-box">
    <i class="fas fa-th menu1" onclick="paneHandle()"></i>
    <i class="fas fa-th menu2" onclick="secPaneHandle()"></i>
  </div>
  <a href="index"><div class="head-logo">RX-manager</div></a>
  <div class="head-search">
    <input type="search" placeholder="search..." name="searchValue" id="search-box" />
    <span> <i class="fas fa-search" id="search-but" ></i> </span>
    <div style="clear:both"></div>
  </div>

  <div class="user-box" onclick="headDrop()">
    <span class="user-icon">
      <i class="fas fa-user"></i>
    </span>
    <span class="user-rank">
    Admin
    </span>
    <span class="user-drop">
    <i class="fas fa-caret-down"></i>
    </span>
    <div style="clear:both"></div>
  </div>

  <div class="not-box">
    <div class="not-containers">
      <div class="not-counter normal-not">9</div>
      <i class="far fa-bell"></i>
    </div>
    <a href="expired"><div class="not-containers">
      <div class="not-counter danger">0</div>
      <i class="fas fa-exclamation-triangle"></i>
    </div></a>
  </div>

  <div style="clear:both"></div>

  <div class="head-drop hide">
    <div class="drop-sec">
      <div class="drop-boxes">
        <div class="drop-box-sec box-top">
          <i class="fas fa-toolbox"></i>
        </div>
        <div class="drop-box-sec box-bottom">
          Profile
        </div>
      </div>

      <div class="drop-boxes">
        <div class="drop-box-sec box-top">
          <i class="fas fa-user-cog"></i>
        </div>
        <div class="drop-box-sec box-bottom">
          Edit
        </div>
      </div>

      <div class="drop-boxes">
        <div class="drop-box-sec box-top">
          <i class="fas fa-cog"></i>
        </div>
        <div class="drop-box-sec box-bottom">
          Setting
        </div>
      </div>
      <div style="clear: both"></div>
    </div>
    <div class="drop-sec lower-sec">
      <div class="lower-top">
        <i class="fas fa-key"></i>
      </div>

      <div class="lower-bottom">
        Logout
      </div>
    </div>
  </div>
</header>


<section class="sub-head">
  <div class="sub-search">
    <input type="search" placeholder="search..." name="searchValue" id="sub-search-box" />
    <span> <i class="fas fa-search" id="sub-search-but" ></i> </span>
    <div style="clear:both"></div>
    </div>
</section>


<aside class="side-pane">
  <ul>
    
      <a href="index">
      <li>
      <span class="pane-icon">

        <i class="fas fa-tachometer-alt"></i>
      </span>
      <span class="pane-text">
        Dashboard
      </span>
      </li>
      </a>
    

    <a href="cashier"><li>
      <span class="pane-icon">
        <i class="fas fa-money-bill-alt"></i>
      </span>
      <span class="pane-text">
      Cashier
      </span>
    </li></a>

    <a href="stock"><li >
      <span class="pane-icon">
        <i class="fas fa-cubes"></i>
      </span>
      <span class="pane-text">
         Stock
      </span>
      <!--<span class="pane-drop stock-down">
      <i class="fas fa-chevron-down"></i>
      </span>
      <span class="pane-up stock-up">
      <i class="fas fa-chevron-up"></i>
    </span>-->
    </li></a>


   <a href="expired"> <li >
      <span class="pane-icon">
        <i class="fas fa-skull-crossbones"></i>
      </span>
      <span class="pane-text">
         Expired
      </span>
    </li></a>

    <a href="stockAdd"><li >
      <span class="pane-icon">
        <i class="fas fa-upload"></i>
      </span>
      <span class="pane-text">
         Add stock
      </span>
    </li></a>

    <!--<li id ="acct">
      <span class="pane-icon">
        <i class="fas fa-university"></i>
      </span>
      <span class="pane-text">
         Accounts
      </span>
      <span class="pane-drop acct-down">
      <i class="fas fa-chevron-down"></i>
      </span>

      <span class="pane-up acct-up">
      <i class="fas fa-chevron-up"></i>
      </span>
    </li>-->

   <a href="sales"> <li >
      <span class="pane-icon">
        <i class="fab fa-stack-overflow"></i>
      </span>
      <span class="pane-text">
         Sales
      </span>
    </li></a>

    <a href="expenses"><li >
      <span class="pane-icon">
        <i class="fas fa-money-check-alt"></i>
      </span>
      <span class="pane-text">
         Expense
      </span>
    </li></a>


   <a href="debt"> <li >
      <span class="pane-icon">
        <i class="fas fa-coins"></i>
      </span>
      <span class="pane-text">
         Debt
      </span>
    </li></a>

    <a href="staff"> <li >
      <span class="pane-icon">
        <i class="fas fa-users"></i>
      </span>
      <span class="pane-text">
         Staff
      </span>

    <!--  <span class="pane-drop staff-down">
      <i class="fas fa-chevron-down"></i>
      </span>

      <span class="pane-up staff-up">
      <i class="fas fa-chevron-up"></i>
    </span>-->
    </li></a>

    <!--<li class="staff-sub">
      <span class="pane-icon">
        <i class="fas fa-clipboard-list"></i>
      </span>
      <span class="pane-text">
         Staff list
      </span>
    </li>-->

    <a href="register"><li >
      <span class="pane-icon">
        <i class="fas fa-book"></i>
      </span>
      <span class="pane-text">
        Register
      </span>
    </li></a>

  </ul>
</aside>
