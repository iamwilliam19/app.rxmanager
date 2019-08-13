<?php 

  //get all session
  if(isset($_SESSION['regReport'])){
    $regReport = $_SESSION['regReport'];
  }else {
    $regReport = '';
  }


  if(isset($_SESSION['regSuccess'])){
    $regSuccess = $_SESSION['regSuccess'];
  }else {
    $regSuccess = '';
  }

  if(isset($_SESSION['fname'])){
    $fname = $_SESSION['fname'];
  }else {
    $fname = '';
  }

  if(isset($_SESSION['lname'])){
    $lname = $_SESSION['lname'];
  }else {
    $lname = '';
  }

  if(isset($_SESSION['uname'])){
    $uname = $_SESSION['uname'];
  }else {
    $uname = '';
  }

  if(isset($_SESSION['pwd'])){
    $pwd = $_SESSION['pwd'];
  }else {
    $pwd = '';
  }

  if(isset($_SESSION['pwd2'])){
    $pwd2 = $_SESSION['pwd2'];
  }else {
    $pwd2 = '';
  }

  if(isset($_SESSION['email'])){
    $email = $_SESSION['email'];
  }else {
    $email = '';
  }

  if(isset($_SESSION['position'])){
    $position = $_SESSION['position'];
  }else {
    $position = '';
  }

  if(isset($_SESSION['sex'])){
   $sex = $_SESSION['sex'];
  }else {
    $sex = '';
  }

  if(isset($_SESSION['permission'])){
    $permission = $_SESSION['permission'];
  }else {
    $permission = '';
  }
  
  if(isset($_SESSION['phone'])){
    $phone = $_SESSION['phone'];
  }else {
    $phone = '';
  }

  if(isset($_SESSION['addr'])){
    $addr = $_SESSION['addr'];
  }else {
    $addr = '';
  }

?>


<main class="display-main">
  <section class="reg-box">
    <div class="reg-title">
      Registeration
    </div>
  <br>
    <?php if($regReport != ''):  ?>
        <span class="warning"><?php echo $regReport; ?></span>
      <?php endif ?>

      <?php if($regSuccess != ''):  ?>
        <span class="success"><?php echo $regSuccess; ?></span>
      <?php endif ?>
    <form action="register/register_model" method="post" class="reg-form">
    <div class="reg-input-box">
      <label for="fname">Firstname:</label>
      <input type="text" placeholder="Enter firstname" name="fname" value="<?php echo $fname; ?>" id="fname" />
      
      <span class="reg-form-error fname-error"></span>
      
      <label for="lname">Lastname:</label>
      <input type="text" placeholder="Enter lastname" name="lname" value="<?php echo $lname; ?>" id="lname" />

      <span class="reg-form-error lname-error"></span>

      <label for="email">Email:</label>
      <input type="email" placeholder="Enter email" name="email" value="<?php echo $email; ?>" id="email" />

      <span class="reg-form-error email-error"></span>

      <label for="position">Position:</label>
      <input type="text" placeholder="Enter position" name="position" value="<?php echo $position; ?>" id="position" />
        
      <span class="reg-form-error position-error"></span>

      <label for="phone">Phone number:</label>
      <input type="text" placeholder="Enter phone number" name="phone" value="<?php echo $phone; ?>" id="phone" />
       
      <span class="reg-form-error phone-error"></span>

      <label for="phone">Address</label>
      <input type="text" placeholder="Enter address" name="address" value="<?php echo $addr; ?>" id="addr" />

      <span class="reg-form-error addr-error"></span>

      <label >Gender:</label>
      <div class="radio-box">
        <input type="radio" name="sex" value="male"> Male
      </div>
      <div class="radio-box">
        <input type="radio" name="sex" value="female"> Female
      </div>

      <span class="reg-form-error gender-error"></span>
      <br>
      <label >Permission:</label>
      <div class="radio-box">
        <input type="radio" name="permission" value="admin"> Admin
      </div>
      <div class="radio-box">
        <input type="radio" name="permission" value="sub_admin"> Sub admin
      </div>
      <div class="radio-box">
      <input type="radio" name="permission" value="staff"> Staff
      </div>
      
      <span class="reg-form-error permission-error"></span>

      <div class="username-box">
        <label for="uname">Username:</label>
        <input type="text" placeholder="Enter username" name="uname" value="<?php echo $uname; ?>" id="uname" />
        
        <span class="reg-form-error uname-error"></span>

        <label for="pwd">Password:</label>
        <input type="password" placeholder="Enter password" name="pwd" value="<?php echo $pwd; ?>" id="pwd" />
        
        <span class="reg-form-error pwd-error"></span>

        <label for="conf-pwd">Confirm password:</label>
        <input type="text" placeholder="Enter password again" name="pwd2" value="<?php echo $pwd2; ?>" id="conf-pwd" />

        <span class="reg-form-error pwd2-error"></span>
      </div>

      <input type="submit" value="Register" class="reg-sub" />
    </div>
  </form>

  </section>

<br >
<br>
</main>


<script>
  $(document).ready(function(){

    //show username box on permission click
    $('.reg-form input:radio').click(function(){
      let perm = $(this).val();
      if(perm === 'admin' || perm === 'sub_admin'){
        $('.username-box').css('display','block');
        //empty to input 
        $("[name='uname']").val("");
        $("[name='pwd']").val("");
        $("[name='pwd2']").val("");
      }else{
       $('.username-box').css('display','none');
      }
    });

    //click radio buttons

    $("[value='<?php echo $sex; ?>']").trigger('click');
    $("[value='<?php echo $permission; ?>']").trigger('click');
  });
</script>