<?php

    //include database
    require "lib/database.php";
    class expiredProcessor extends Database
    {
        private $stmt;
        private $token;
        private $name;

        
        public function __construct()
        {
            //echo "processor on";
            //session_start();
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

        public function getExpiredProduct() {
            date_default_timezone_set('Africa/Lagos');
            $m = date('m');
            $y = date('y');
            $this->stmt = $this->connect()->prepare(" SELECT * FROM stock WHERE exp_year = '$y' AND exp_month - '$m' < 5  ");
            $this->stmt->execute();
            return $this->stmt->fetchAll();
        }
    }

?>