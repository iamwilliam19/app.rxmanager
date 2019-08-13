<?php

    //include database
    require "../lib/database.php";
    class productProcessor extends Database{
        private $stmt;
        private $token;

        
        public function __construct(){
          // echo "processor on";
            session_start();
           if(isset($_SESSION['token'])){
                $this->token = $_SESSION['token'];
            }else{
                $this->token = '';
            }
      

        }

        public function getFormDetails($product){
            $this->stmt = $this->connect()->prepare("SELECT * FROM stock WHERE item_name = '$product' ");
            $this->stmt->execute();
            return $this->stmt->fetchObject();
        }
        

        
    }

    
?>