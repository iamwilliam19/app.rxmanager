<?php

    //include database
    require "../lib/database.php";
    class StockApiProcessor extends Database{
        private $stmt;
        function  __construct(){
            //echo "ok";
        }

        public function getStock($editId){
            $this->stmt = $this->connect()->prepare("SELECT * FROM stock WHERE id = ?");
            $this->stmt->execute([$editId]);
            return $data = $this->stmt->fetchObject();
        }
    }