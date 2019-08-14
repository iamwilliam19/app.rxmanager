<?php

    //include database
    require "../lib/database.php";
    class productProcessor extends Database{
        private $stmt;
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

        public function getFormDetails($product){
            $this->stmt = $this->connect()->prepare("SELECT * FROM stock WHERE item_name = '$product' ");
            $this->stmt->execute();
            return $this->stmt->fetchObject();
        }

       public function updateProduct($code,$name,$brand,$category,$unit,$form,$price){
            $this->stmt = $this->connect()->prepare("SELECT * FROM stock WHERE NOT item_id = '$code' AND item_name = '$name' ");
            $this->stmt->execute();
            $row = $this->stmt->rowCount();
            if($row > 0){
                return "The product name matches another ID";
            }else{
                $this->stmt = $this->connect()->prepare("UPDATE stock SET 
                brand = '$brand', item_name = '$name',category = '$category', unit = '$unit',form = '$form',price = '$price'
                WHERE item_id = '$code'  ");
                try{
                    $this->stmt->execute();
                    return "success";
                }catch(PDOException $e){
                    return $e->getMessage();
                }
            }
        }
        

        
    }

    
?>