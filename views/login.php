<?php

  //get all session
  if(isset($_SESSION['invalidLogin'])){
    $invalidLogin = $_SESSION['invalidLogin'];
  }else {
    $invalidLogin = '';
  }

  if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
  }else{
    $username = "";
  }



 ?>



<main class="form-main">

  <section class="form-base">
    <section class="form-box">
      <div class="form-title">
          RX-manager
      </div>
      <?php if($invalidLogin != ''):  ?>
        <span class="warning"><?php echo $invalidLogin; ?></span>
      <?php endif ?>
      <span class="warningJs"><?php echo $invalidLogin; ?></span>
      <div class="form-input-box">
        <div class="form-img">
          <img src="./src/images/spot.jpg" width="100%" height="90%" id="form-img"/>
        </div>
        <div class="form-details">
          <form action="login/login_model" method="post" onsubmit="return validate()">

            <input type="text" placeholder="Enter username" required value="" name="username" autofocus id="username" />
            <input type="password" placeholder="Enter password" required value="" name="pwd"  id="password" />
            <input type="submit" value="Login"  />
          </form>
        </div>
        <div style="clear:both"></div>
      </div>

      <div class="form-foot">
        Copyright &copy; 2019 Africana tech.
      </div>
    </section>
  </section>



</main>


<script type="text/javascript">
  const validate = function(){
    let warningJs = document.getElementsByClassName('warningJs')[0];
    warningJs.style.display = "none";
    let uname = document.getElementById('username').value;
    let pwd = document.getElementById('password').value;


    if(uname.length == 0 || pwd.length == 0){
      warningJs.style.display = "block";
      warningJs.innerText = "Please enter all value ";
      return false;
    }else{
      return true;
    }
  }



</script>
