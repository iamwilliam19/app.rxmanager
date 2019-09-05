<?php

    //include database
    require "../lib/database.php";
    class salesProcessor extends Database
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

        public function fetchSales($day,$month,$year){
            $this->stmt = $this->connect()->prepare("SELECT * FROM sales WHERE day = '$day' AND month = '$month' AND year = '$year' ");
            $this->stmt->execute();
            return $this->stmt->fetchAll();
        }
        public function totalSales($day,$month,$year){
            $this->stmt = $this->connect()->prepare("SELECT * FROM receipt_record WHERE day = '$day' AND month = '$month' AND year = '$year' ");
            $this->stmt->execute();
           return  $stock = $this->stmt->fetchAll();
        }

        public function totalExp($day,$month,$year){
            if(strlen($day) == 1){
                $day = '0'.$day;
            }

            if(strlen($month) == 1){
                $month = '0'.$month;
            }

            if(strlen($year) == 1){
                $year = '0'.$year;
            }
            $this->stmt = $this->connect()->prepare("SELECT * FROM expenses WHERE day = '$day' AND month = '$month' AND year = '$year' ");
            $this->stmt->execute();
            
           return  $stock = $this->stmt->fetchAll();
        }
    }