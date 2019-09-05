<?php

    //include database
    require "../lib/database.php";
    class expProcessor extends Database
    {
        private $stmt;
        private $stmt1;
        private $stmt2;
        private $user_stmt;
        private $token;
        private $name;

        
        public function __construct()
        {
            //echo "processor on";
            session_start();
            if (isset($_SESSION['token'])) {
                $this->token = $_SESSION['token'];
                $this->stmt = $this->connect()->prepare("SELECT * FROM users WHERE uname = ?  ");
                $this->stmt->execute([$this->token]);
                $detail = $this->stmt->fetchObject();
                $this->name = $detail->fname.' '. $detail->lname;
            } else {
                $this->token = '';
            }
        }

        public function delExp($id){
            $this->stmt = $this->connect()->prepare("DELETE FROM stock WHERE id = '$id' ");
            try{
                $this->stmt->execute();
                return 'success';
            }catch(PDOException $e){
                return $e->getMessage();
            }
        }

        public function countExp(){
            date_default_timezone_set('Africa/Lagos');
            $m = date('m');
            $y = date('y');
            $this->stmt = $this->connect()->prepare(" SELECT * FROM stock WHERE exp_year = '$y' AND exp_month - '$m' < 5  ");
            $this->stmt->execute();
            return $this->stmt->rowCount();
        }
    }

        