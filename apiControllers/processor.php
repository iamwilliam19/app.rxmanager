<?php

    //include database
    require "../lib/database.php";
    class apiProcessor extends Database{
        private $stmt;
        private $stmt1;
        private $stmt2;
        private $user_stmt;
        private $token;

        
        public function __construct(){
           //echo "processor on";
            session_start();
           if(isset($_SESSION['token'])){
                $this->token = $_SESSION['token'];
            }else{
                $this->token = '';
            }
      

        }
        

        
    }
?>