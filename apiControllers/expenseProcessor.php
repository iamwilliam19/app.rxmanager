<?php

    //include database
    require "../lib/database.php";
    class expenseProcessor extends Database
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

        public function addExp($amt,$purp){
            
            date_default_timezone_set('Africa/Lagos');
            
            $d = date('d');
            $m = date('m');
            $y = date('y');

            $this->stmt = $this->connect()->prepare("INSERT INTO expenses 
            (amount,reason,withdrawer,day,month,year)
            VALUES
            ('$amt','$purp','$this->token','$d','$m','$y')
            ");
            try{
                $this->stmt->execute();
                return 'success';
            }catch(PDOException $e){
                return $e->getMessage();
            }
        }

        public function listExp($date,$month,$year){
            $this->stmt = $this->connect()->prepare("SELECT * FROM expenses WHERE day = '$date' AND month = '$month' AND year = '$year' ");
            $this->stmt->execute();
            return $this->stmt->fetchAll();
        }

        public function listDel($id){
            $this->stmt = $this->connect()->prepare("DELETE FROM expenses WHERE id = '$id' ");
            try{
                $this->stmt->execute();
                return 'success';
            }catch(PDOException $e){
                return $e->getMessage();
            }
        }

        public function allExp(){
            $this->stmt = $this->connect()->prepare("SELECT day, month, year, sum(amount)  FROM expenses 
            GROUP BY day ORDER BY id DESC  
            ");
            $this->stmt->execute();
            return $this->stmt->fetchAll();
        }
    }