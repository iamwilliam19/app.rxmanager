
<?php

//require validaator file
require "Validator/formValidator.php";
//instantiate validator class
$validate = new validator();

 //get the form-details
 $username = $_POST['username'];
 $pwd = $_POST['pwd'];


 $_SESSION['username'] = $username;

//check if username is empty
  if($validate->empty($username)){
    $_SESSION['invalidLogin'] = "Please enter a valid username !!!";
    //go back
    header("location: ../login");
  }else if($validate->empty($pwd)){
    $_SESSION['invalidLogin'] = "Please enter a valid password !!!";
    //go back
    header("location: ../login");
    //check for username match
  }else if(!$validate->checkUsername($username)){
    $_SESSION['invalidLogin'] = "Username does not exist !!!";
    //go back
    header("location: ../login");
  }else if($validate->checkUsername($username)){
    //check for password match;
    if(!$validate->pwdMatch($username,$pwd)){
      $_SESSION['invalidLogin'] = "Password incorrect !!! ";
      //go back
      header("location: ../login");
    }else {
      //set session token snd login success
      $_SESSION['token'] = $username;
      $_SESSION['loginSuccess'] = "success";

      //unset other sessions
      unset($_SESSION['invalidLogin']);
      unset($_SESSION['username']);
      //go back
      header("location: ../index");
    }
  }
 ?>
