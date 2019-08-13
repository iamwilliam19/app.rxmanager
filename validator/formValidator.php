<?php
  //include database file
  require "lib/database.php";
 /**
  *
 * validate all forms
 */
class Validator extends Database
{
  //declare stmt variable
  private $stmt;

  public function empty($value){
    if($value == ''){
      return true;
    }
  }

  public function isAlpha($value){
    if(ctype_alpha($value)){
      return true;
    }
  }

  public function isPhone($value){
    //allow + .- and . in phone number
    $filtered_number = filter_var($value, FILTER_SANITIZE_NUMBER_INT);

    //remove "-" from number
    $phone_to_check = str_replace("-", " ", $filtered_number);

    //check number length
    if(strlen($phone_to_check) < 11 || strlen($phone_to_check) > 14){
      return false;
    }else {
      return true;
    }
  }


  public function isEmail($value){
    if(filter_var($value, FILTER_VALIDATE_EMAIL)){
      return true;
    }
  }

  public function emailExist($value){
    $this->stmt = $this->connect()->prepare("SELECT * FROM users WHERE  email = '$value' ");
    ////execute the query
    $this->stmt->execute();
    $count = $this->stmt->fetchColumn();
    if($count > 0){
      return true;
    }else{
      return false;
    }
  }

  public function checkUsername($value){
    $this->stmt = $this->connect()->prepare("SELECT * FROM users WHERE  uname = '$value' ");
    ////execute the query
    $this->stmt->execute();
    $count = $this->stmt->fetchColumn();
    if($count > 0){
      return true;
    }else{
      return false;
    }
  }

   public function pwdMatch($name,$pwd)
  {
    //encrypt pwd
    $pwd = md5($pwd);
    $this->stmt = $this->connect()->prepare("SELECT * FROM users WHERE  uname = '$name' AND pwd = '$pwd' ");
    ////execute the query
    $this->stmt->execute();
    $count = $this->stmt->fetchColumn();
    if($count > 0){
      return true;
    }else{
      return false;
    }
  }

  public function register($fname,$lname,$email,$phone,$gender,$position,$permission,$addr,$uname = false,$pwd = false) {
    
    //prepare statement
    $this->stmt = $this->connect()->prepare("INSERT INTO users 
    (fname,lname,email,phone_number,gender,position,permission,home_address,uname,pwd) 
    VALUES 
    (:fname, :lname, :email, :phone, :gender, :position, :permission,:addr, :uname, :pwd)");

    //bind the parameter
    $this->stmt->bindParam(':fname', $fname);
    $this->stmt->bindParam(':lname', $lname);
    $this->stmt->bindParam(':email', $email);
    $this->stmt->bindParam(':phone', $phone);
    $this->stmt->bindParam(':gender', $gender);
    $this->stmt->bindParam(':position', $position);
    $this->stmt->bindParam(':permission', $permission);
    $this->stmt->bindParam(':uname', $uname);
    $this->stmt->bindParam(':pwd', $pwd);
    $this->stmt->bindParam(':addr', $addr);

    //assign values to the parameters

    $fname = $fname;
    $lname = $lname;
    $email = $email;
    $phone = $phone;
    $gender = $gender;
    $position = $position;
    $permission = $permission;
    $uname = $uname;
    $pwd = $pwd;
    $addr = $addr;
    
    try{
      $this->stmt->execute();
      return true;
    }catch(PDOException $e){
      echo  "Error". $e->getMessage();
    }

  }
}

?>
