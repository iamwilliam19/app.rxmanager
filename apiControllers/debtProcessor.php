<?php

     //include database
    require "../lib/database.php";
     
    
    class DebtProcessor extends Database
    {
        //declare stmt variable
        private $stmt;
    
        public function __construct()
        {
            //echo "stock model";
        }

        public function deleteDebt($id){
            $this->stmt = $this->connect()->prepare(" DELETE FROM receipt_record WHERE id = '$id' ");
            try{
                $this->stmt->execute();
                return "success";
            }catch(PDOException $e){
                return $e->getMessage();
            }
           
        }

        public function debtClear($id,$amt){
            $this->stmt = $this->connect()->prepare(" UPDATE receipt_record SET amt_paid = amt_paid + '$amt', amt_remaining = amt_remaining - '$amt' WHERE id = '$id' ");
            try{
                $this->stmt->execute();
                return "success";
            }catch(PDOException $e){
                return $e->getMessage();
            }
        }
    }