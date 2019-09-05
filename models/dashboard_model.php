<?php

    //include database
    require "lib/database.php";
    class dashboardModel extends Database
    {
        private $stmt;
        private $token;
        private $name;
        private $d;
        private $m;
        private $y;

        
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
                date_default_timezone_set('Africa/Lagos');
            
                $this->d = date('d');
                $this->m = date('m');
                $this->y = date('y');
            } else {
                $this->token = '';
            }
        }

        public function countSales(){
            $this->stmt = $this->connect()->prepare("SELECT * FROM sales WHERE day = '$this->d' AND month = '$this->m' AND year = '$this->y' ");
            $this->stmt->execute();
            return $this->stmt->rowCount();
        }

        public function countExpenses(){
            $this->stmt = $this->connect()->prepare("SELECT * FROM expenses WHERE day = '$this->d' AND month = '$this->m' AND year = '$this->y' ");
            $this->stmt->execute();
            return $this->stmt->rowCount();
        }

        public function countReceipt(){
            $this->stmt = $this->connect()->prepare("SELECT * FROM receipt_record WHERE day = '$this->d' AND month = '$this->m' AND year = '$this->y' ");
            $this->stmt->execute();
            return $this->stmt->rowCount();
        }


        public function countDebt(){
            $this->stmt = $this->connect()->prepare("SELECT sum(amt_remaining) FROM receipt_record WHERE payment_form = 'credit' ");
            $this->stmt->execute();
            $total = $this->stmt->fetchAll();
            foreach($total as $total){
                foreach($total as $key => $value){
                    return $value;
                }
            }
        }

        public function countStock(){
            $this->stmt = $this->connect()->prepare("SELECT sum(quantity) FROM stock ");
            $this->stmt->execute();
            $total = $this->stmt->fetchAll();
            foreach($total as $total){
                foreach($total as $key => $value){
                    return $value;
                }
            }
        }

        public function countStaff(){
            $this->stmt = $this->connect()->prepare("SELECT * FROM users ");
            $this->stmt->execute();
            return $this->stmt->rowCount();
        }
    }