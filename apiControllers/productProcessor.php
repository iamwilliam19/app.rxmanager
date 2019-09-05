<?php

    //include database
    require "../lib/database.php";
    class productProcessor extends Database{
        private $stmt;
        private $token;
        private $token_name;

        
        public function __construct(){
            //echo "processor on";
            session_start();
            if(isset($_SESSION['token'])){
                $this->token = $_SESSION['token'];
                $this->stmt = $this->connect()->prepare("SELECT * FROM users WHERE uname = ?  ");
                $this->stmt->execute([$this->token]);
                $detail = $this->stmt->fetchObject();
                $this->token_name = $detail->fname.' '. $detail->lname;
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
                    $this->stmt = $this->connect()->prepare("INSERT INTO
                    entry_record 
                    (item_name,item_id,category,unit,form,price,modified_by,brand,activity)
                    VALUE
                    ('$name','$code','$category','$unit','$form','$price','$this->token_name','$brand','Product modified generally')
                    ");

                    try{
                        $this->stmt->execute();
                        return 'success';
                    }catch(PDOException $e){
                        return $e->getMessage();
                    }
                }catch(PDOException $e){
                    return $e->getMessage();
                }

                
            }
        }

        public function getBatch($id){
            $this->stmt = $this->connect()->prepare("SELECT * FROM stock WHERE id = '$id' ");
            $this->stmt->execute();
            return $this->stmt->fetchObject();
        }
        
        public function updateBatch($id,$qty, $expiryDate){
            //get expiry date of stock and compare with your new date and quantity
            $this->stmt = $this->connect()->prepare("SELECT * FROM stock WHERE id = '$id' ");
            $this->stmt->execute();
            $batch = $this->stmt->fetchObject();
            $item_name = $batch->item_name;
            $item_id = $batch->item_id;
            $brand = $batch->brand;
            $category = $batch->category;
            $form = $batch->form;
            $unit = $batch->unit;
            
            $batch_id = $batch->batch_id;
            $price = $batch->price;
            $registered_by = $batch->registered_by;
            $registered_on = $batch->registered_on;
            $quantity = $batch->quantity;
            $reg_uname = $batch->reg_uname;
            

            if($qty != $batch->quantity || $expiryDate != $batch->expiryDate){
                if($qty != $batch->quantity && $expiryDate != $batch->expiryDate){
                    $activity = "Quantity and expiry date changed for this batch";
                }else if($qty != $batch->quantity){
                    $activity = "Quantity  changed for this batch";
                }else if($expiryDate != $batch->expiryDate){
                    $activity = "Expiry date changed for this batch";
                }
                
                //update in stock table
                $exp = explode('/',$expiryDate,2);
                $month = $exp[0];
                $year = $exp[1];
                $this->stmt = $this->connect()->prepare("UPDATE stock 
                SET expiryDate = '$expiryDate', quantity = '$qty', exp_month = '$month', exp_year = '$year' WHERE id = '$id' ");
               try{
                $this->stmt->execute();
                
                $this->stmt = $this->connect()->prepare("INSERT INTO
                    entry_record 
                    (item_name,item_id,batch_id,brand,category,expiryDate,quantity,unit, form,price,registered_by,registered_on,reg_uname,modified_by,activity)
                    VALUES
                    ('$item_name','$item_id','$batch_id','$brand','$category','$expiryDate','$qty','$unit','$form','$price','$registered_by','$registered_on','$reg_uname','$this->token_name','$activity')
                ");
                try{
                    $this->stmt->execute();
                    return "success";
                }catch(PDOException $e){
                    return $e->getMessage();
                }
                //insert into entry record table
               }catch(PDOException $e){
                   return $e->getMessage();
               }
            }
        }
        
    }
    

    
?>