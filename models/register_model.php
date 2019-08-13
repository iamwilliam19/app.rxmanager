
<?php

//require validaator file
require "Validator/formValidator.php";
//instantiate validator class
$validate = new validator();

//get the form-details
$fname = trim($_POST['fname']);
$lname = trim($_POST['lname']);
$position = trim( $_POST['position']);
$phone = trim($_POST['phone']);
$email = trim($_POST['email']);
if(isset($_POST['sex'])){
  $sex = $_POST['sex'];
}else{
  $sex = '';
}
if(isset($_POST['permission'])){
  $permision = $_POST['permission'];
}else{
  $permision = '';
}
$uname = trim($_POST['uname']);
$pwd = $_POST['pwd'];
$pwd2 = $_POST['pwd2'];
$addr = $_POST['address'];

unset($_SESSION['regReport']);
unset($_SESSION['regSuccess']);


//assign all input to sessions
$_SESSION['fname'] = $fname;
$_SESSION['lname'] = $lname;
$_SESSION['position'] = $position;
$_SESSION['phone'] = $phone;
$_SESSION['email'] = $email;
$_SESSION['sex'] = $sex;
$_SESSION['permission'] = $permision;
$_SESSION['uname'] = $uname;
$_SESSION['pwd'] = $pwd;
$_SESSION['pwd2'] = $pwd2;
$_SESSION['addr'] = $addr;


//encrypt password
$pwd = md5($pwd);
$pwd2 = md5($pwd2);

if($validate->empty($fname)){
  $_SESSION['regReport'] = 'Please enter a valid first name';
  //go back
  header("location: ../register");
}else if(!$validate->isAlpha($fname)) {
  $_SESSION['regReport'] = 'First name should contain only alphabets';
  //go back
  header("location: ../register");
}else if($validate->empty($lname)){
  $_SESSION['regReport'] = 'Please enter a valid last name';
  //go back
  header("location: ../register");
}else if(!$validate->isAlpha($lname)){
  $_SESSION['regReport'] = 'last name should contain only alphabets';
  //go back
  header("location: ../register");
}else if(!$validate->isEmail($email)){
  $_SESSION['regReport'] = ' Please enter a valid email';
  //go back
  header("location: ../register");
}else if($validate->emailExist($email)){
  $_SESSION['regReport'] = 'Email already exists';
  //go back
  header("location: ../register");
}else if($validate->empty($position)){
  $_SESSION['regReport'] = 'Please specify user position';
  //go back
  header("location: ../register");
}else if($validate->empty($addr)){
  $_SESSION['regReport'] = 'Please enter an address';
  //go back
  header("location: ../register");
}else if(!$validate->isPhone($phone)){
  $_SESSION['regReport'] = 'Please enter a valid phone number';
  //go back
  header("location: ../register");
}else if($validate->empty($sex)){
  $_SESSION['regReport'] = 'Please specify user gender';
  //go back
  header("location: ../register");
}else if($validate->empty($permision)){
  $_SESSION['regReport'] = 'Please specify user permission';
  //go back
  header("location: ../register");
}else if($permision == 'admin' || $permision == 'sub_admin'){
  if($validate->empty($uname)){
    $_SESSION['regReport'] = 'Please enter a valid username';
    //go back
  header("location: ../register");
  }else if($validate->checkUsername($uname)){
    $_SESSION['regReport'] = 'Username already exists';
    //go back
  header("location: ../register");
  }else if($validate->empty($pwd)){
    $_SESSION['regReport'] = 'Please enter a valid password';
    //go back
  header("location: ../register");
  }else if($pwd != $pwd2){
    $_SESSION['regReport'] = 'Your passwords do not match';
    //go back
  header("location: ../register");
  }else{
    //insert into db
    $insert = $validate->register($fname,$lname,$email,$phone,$sex,$position,$permision,$addr,$uname,$pwd);
    $_SESSION['regSuccess'] = 'Registration successful';
    if($insert){

      //unset sessions
      unset($_SESSION['regReport']);
      unset($_SESSION['fname']);
      unset($_SESSION['lname']);
      unset($_SESSION['position']);
      unset($_SESSION['phone']);
      unset($_SESSION['email']);
      unset($_SESSION['sex']);
      unset($_SESSION['permission']);
      unset($_SESSION['uname']);
      unset($_SESSION['pwd']);
      unset($_SESSION['pwd2']);
      unset($_SESSION['addr']);

      //go back
    header("location: ../register");
    }
  }
  
}else if($permision == 'staff'){
  //insert into db
  $insert = $validate->register($fname,$lname,$email,$phone,$sex,$position,$permision,$addr);
  $_SESSION['regSuccess'] = 'Registration successful';
    if($insert){

      //unset sessions
      unset($_SESSION['regReport']);
      unset($_SESSION['fname']);
      unset($_SESSION['lname']);
      unset($_SESSION['position']);
      unset($_SESSION['phone']);
      unset($_SESSION['email']);
      unset($_SESSION['sex']);
      unset($_SESSION['permission']);
      unset($_SESSION['uname']);
      unset($_SESSION['pwd']);
      unset($_SESSION['pwd2']);
      unset($_SESSION['addr']);
      //go back
    header("location: ../register");
    }
}

