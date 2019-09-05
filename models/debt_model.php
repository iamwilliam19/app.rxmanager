<?php

     //include database file
    require "lib/database.php";
    /**
     
    */
    
    class DebtProcessor extends Database
    {
        //declare stmt variable
        private $stmt;
    
        public function __construct()
        {
            //echo "stock model";
        }

        public function getDebt(){
            $this->stmt = $this->connect()->prepare(" SELECT * FROM receipt_record WHERE payment_form = 'credit' order by id DESC ");
            $this->stmt->execute();
            return $this->stmt->fetchAll();
        }
    }