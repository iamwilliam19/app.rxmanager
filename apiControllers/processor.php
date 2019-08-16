<?php

    //include database
    require "../lib/database.php";
    class apiProcessor extends Database{
        private $stmt;
        private $stmt1;
        private $stmt2;
        private $user_stmt;
        private $token;
        private $name;

        
        public function __construct(){
           //echo "processor on";
            session_start();
           if(isset($_SESSION['token'])){
                $this->token = $_SESSION['token'];
                $this->stmt = $this->connect()->prepare("SELECT * FROM users WHERE uname = ?  ");
                $this->stmt->execute([$this->token]);
                $detail = $this->stmt->fetchObject();
                $this->name = $detail->fname.' '. $detail->lname;
            }else{
                $this->token = '';
            }
      

        }

        public function recordProduct($code, $name, $brand, $category, $expiryDate, $qty, $unit, $form, $price, $errorLog){
            $batch_id = mt_rand(000000,999999);
            $this->stmt = $this->connect()->prepare("INSERT INTO temp_stock 
            (item_name, item_id,brand,category, expiryDate, quantity, unit, form, price, error_log, registered_by, reg_uname,batch_id) 
            VALUES 
            ('$name','$code','$brand','$category','$expiryDate','$qty','$unit','$form','$price','$errorLog','$this->name','$this->token','$batch_id') ");
            try{
                $this->stmt->execute();
                return "success";
            }catch(PDOEXception $e){
                return $e->getMessage();
            }
        }

        public function updateRecord($code, $name, $brand, $category, $expiry_date, $qty, $unit, $form, $price, $error_log,$edit_id){
            $this->stmt = $this->connect()->prepare("UPDATE temp_stock
             SET
             item_name = '$name',
             item_id = '$code',
             brand = '$brand',
             category = '$category',
             expiryDate = '$expiry_date',
             quantity = '$qty',
             unit = '$unit',
             form = '$form',
             price = '$price',
             error_log = '$error_log'
             WHERE
             id = '$edit_id'

             ");

             try{
                $this->stmt->execute();
                return  "success";
             }catch(PDOException $e){
                 return $e->getMessage();
             }
        }

        public function validateProduct($code, $name, $brand, $category, $expiryDate, $qty, $unit, $form, $price, $errorLog){
            $this->stmt = $this->connect()->prepare("SELECT * FROM stock WHERE item_id = ? ");
            try{
                $this->stmt->execute([$code]);
                $row = $this->stmt->rowCount();
                if($row > 0){
                    $product = $this->stmt->fetchObject();
                    $product_name = $product->item_name;
                    $product_brand = $product->brand;
                    $product_category = $product->category;
                    
                    $product_unit = $product->unit;
                    $product_form = $product->form;
                    $product_price = $product->price;

                    if($brand != $product_brand){
                        return "Product brand does not match product ID";
                    }else  if($name != $product_name){
                        return "Product name does not match product ID";
                    }else  if($category != $product_category){
                        return "Product category does not match product ID";
                    }else  if($unit != $product_unit){
                        return "Product unit does not match product ID";
                    }else  if($form != $product_form){
                        return "Product form does not match product ID";
                    }else{
                       //check my current record
                       $this->stmt = $this->connect()->prepare("SELECT * FROM temp_stock WHERE item_name = '$name' OR item_id = '$code' ");
                       $this->stmt->execute();
                       $row = $this->stmt->rowCount();
                       if($row > 0){
                           return "Product with matching ID or Name has already been recorded in this session";
                       }else {
                           return $this->recordProduct($code, $name, $brand, $category, $expiryDate, $qty, $unit, $form, $price, $errorLog);
                       }
                    }
                }else{
                    $this->stmt = $this->connect()->prepare("SELECT * FROM stock WHERE item_name = ? ");
                    try{
                        $this->stmt->execute([$name]);
                        $row = $this->stmt->rowCount();
                        if($row > 0){
                            return "Product name already exists for another product";
                        }else{
                            //check my current record
                            $this->stmt = $this->connect()->prepare("SELECT * FROM temp_stock WHERE item_name = '$name' OR item_id = '$code' ");
                            $this->stmt->execute();
                            $row = $this->stmt->rowCount();
                            if($row > 0){
                                return "Product with matching ID or Name has already been recorded in this session";
                            }else {
                                return $this->recordProduct($code, $name, $brand, $category, $expiryDate, $qty, $unit, $form, $price, $errorLog);
                            }

                        }
                    }catch(PDOException $e){
                        return $e->getMessage();
                    }
                }
            }catch(PDOException $e){
                return $e->getMessage();
            }
        }

        public function getFormDetails($editId){
            $this->stmt = $this->connect()->prepare("SELECT * FROM temp_stock WHERE id = '$editId' ");
            try{
                $this->stmt->execute();
                return $this->stmt->fetchObject();
            }catch(PDOException $e){
                return $e->getMessage();
            }
        }

        public function delete($table,$delete_id){
            $this->stmt = $this->connect()->prepare("DELETE FROM temp_stock WHERE id = '$delete_id' ");;
            try{
                $this->stmt->execute();
                return "success";
            }catch(PDOException $e){
                return $e->getMessage();
            }
        }

        public function fetchMyrec($uname){
            $this->stmt = $this->connect()->prepare("SELECT * FROM temp_stock WHERE reg_uname = '$uname' ");
            $this->stmt->execute();
            return $this->stmt->fetchAll();
        }

        public function updateRec($code,$brand,$name,$expiry_date,$qty,$unit,$form,$price,$error_log,$edit_id,$category){
            $this->stmt = $this->connect()->prepare("SELECT * FROM stock WHERE item_id = ? ");
            try{
                $this->stmt->execute([$code]);
                $row = $this->stmt->rowCount();
                if($row > 0){
                    $product = $this->stmt->fetchObject();
                    $product_name = $product->item_name;
                    $product_brand = $product->brand;
                    $product_category = $product->category;
                    
                    $product_unit = $product->unit;
                    $product_form = $product->form;
                    $product_price = $product->price;

                    if($brand != $product_brand){
                        return "Product brand does not match product ID";
                    }else  if($name != $product_name){
                        return "Product name does not match product ID";
                    }else  if($category != $product_category){
                        return "Product category does not match product ID";
                    }else  if($unit != $product_unit){
                        return "Product unit does not match product ID";
                    }else  if($form != $product_form){
                        return "Product form does not match product ID";
                    }else{
                        $this->stmt = $this->connect()->prepare("SELECT * FROM temp_stock WHERE
                         NOT  id = '$edit_id' AND (item_name = '$name' OR item_id = '$code') ");
                         $this->stmt->execute();
                         $row = $this->stmt->rowCount();
                         if($row > 0){
                             return "Another product with matching ID or Name has already been recorded in this session";
                         }else{
                            return $this->updateRecord($code, $name, $brand, $category, $expiry_date, $qty, $unit, $form, $price, $error_log,$edit_id);
                         }
                    }
                }else{
                    //search by name
                    $this->stmt = $this->connect()->prepare("SELECT * FROM stock WHERE NOT item_id = '$code' AND item_name = '$name' ");
                    try{
                        $this->stmt->execute();
                        $row = $this->stmt->rowCount();
                        if($row > 0){
                            return "Product already exists with another ID ";
                        }else{
                            $this->stmt = $this->connect()->prepare("SELECT * FROM temp_stock WHERE
                         NOT  id = '$edit_id' AND (item_name = '$name' OR item_id = '$code') ");
                         $this->stmt->execute();
                         $row = $this->stmt->rowCount();
                         if($row > 0){
                             return "Another product with matching ID or Name has already been recorded in this session";
                         }else{
                            return $this->updateRecord($code, $name, $brand, $category, $expiry_date, $qty, $unit, $form, $price, $error_log,$edit_id);
                         }
                        }
                    }catch(PDOException $e){
                        return $e->getMessage();
                    }
                }
            }catch(PDOExeption $e){
                return $e->getMessage();
            }
        }


        public function completeList($uname){
            $this->stmt = $this->connect()->prepare("SELECT * FROM temp_stock WHERE reg_uname = '$uname' ");
            try{
                $this->stmt->execute();
                $detail = $this->stmt->fetchAll(); 
                foreach($detail as $product){
                    $item_name = $product['item_name'];
                    $item_id = $product['item_id'];
                    $category = $product['category'];
                    $form = $product['form'];
                    $unit = $product['unit'];
                    $qty = $product['quantity'];
                    $expiryDate = $product['expiryDate'];
                    $error_log = $product['error_log'];
                    $registered_by = $product['registered_by'];
                    $registered_on = $product['registered_on'];
                    $reg_uname = $product['reg_uname'];
                    $batch_id = $product['batch_id'];
                    $price = $product['price'];
                    $brand = $product['brand'];
                    $id = $product['id'];
                    
                    //check if new product has a different price from  and update it
                    $this->stmt = $this->connect()->prepare("SELECT * FROM stock WHERE item_name = '$item_name' ");
                    $this->stmt->execute();
                    $row = $this->stmt->rowCount();
                    if($row  > 0){
                        //check if prices match
                        $value = $this->stmt->fetchObject();
                        if($value->price != $price){
                            //update and then add 
                            $this->stmt = $this->connect()->prepare("UPDATE stock SET price = '$price' WHERE item_name = '$item_name' ");
                            try{
                                $this->stmt->execute();
                            }catch(PDOException $e){
                                return 'error1'.$e->getMessage();
                            }
                            //insert into stock table
                            $this->stmt = $this->connect()->prepare("INSERT INTO stock
                            (item_name,item_id,batch_id,brand,category,expiryDate,quantity,unit,form,price,error_log,registered_by,registered_on,reg_uname)                    
                            VALUES
                            ('$item_name','$item_id','$batch_id','$brand','$category','$expiryDate','$qty','$unit','$form','$price','$error_log','$registered_by','$registered_on','$reg_uname')");
                            try{
                                $this->stmt->execute();
                            }catch(PDOException $e){
                                return 'error2'.$e->getMessage();
                            }

                            //insert into entry record table
                            $this->stmt = $this->connect()->prepare("INSERT INTO entry_record
                            (item_name,item_id,batch_id,brand,category,expiryDate,quantity,unit,form,price,error_log,registered_by,registered_on,reg_uname,modified_by,activity)                    
                            VALUES
                            ('$item_name','$item_id','$batch_id','$brand','$category','$expiryDate','$qty','$unit','$form','$price','$error_log','$registered_by','$registered_on','$reg_uname','$registered_by','Product modidfied upon recording this batch')");
                            try{
                                $this->stmt->execute();
                            }catch(PDOException $e){
                                return 'error3'.$e->getMessage();
                            }

                             //Delete from temp stock table table
                             $this->stmt = $this->connect()->prepare("DELETE FROM temp_stock WHERE id = '$id' ");
                             try{
                                $this->stmt->execute();
                                return "success";
                            }catch(PDOException $e){
                                return 'error4'.$e->getMessage();
                            }
                        }else{
                             //insert into stock table
                             $this->stmt = $this->connect()->prepare("INSERT INTO stock
                             (item_name,item_id,batch_id,brand,category,expiryDate,quantity,unit,form,price,error_log,registered_by,registered_on,reg_uname)                    
                             VALUES
                             ('$item_name','$item_id','$batch_id','$brand','$category','$expiryDate','$qty','$unit','$form','$price','$error_log','$registered_by','$registered_on','$reg_uname')");
                             try{
                                $this->stmt->execute();
                            }catch(PDOException $e){
                                return 'error5'.$e->getMessage();
                            }
 
                             //insert into entry record table
                             $this->stmt = $this->connect()->prepare("INSERT INTO entry_record
                             (item_name,item_id,batch_id,brand,category,expiryDate,quantity,unit,form,price,error_log,registered_by,registered_on,reg_uname,activity)                    
                             VALUES
                             ('$item_name','$item_id','$batch_id','$brand','$category','$expiryDate','$qty','$unit','$form','$price','$error_log','$registered_by','$registered_on','$reg_uname','Product recorded as new batch')
                             ");
                             try{
                                $this->stmt->execute();
                            }catch(PDOException $e){
                                return 'error6'.$e->getMessage();
                            }
 
                              //Delete from temp stock table table
                              $this->stmt = $this->connect()->prepare("DELETE FROM temp_stock WHERE id = '$id' ");
                              try{
                                $this->stmt->execute();
                                return "success";
                            }catch(PDOException $e){
                                return 'error7'.$e->getMessage();
                            }
                        }
                    }else{
                        //insert into stock table
                        $this->stmt = $this->connect()->prepare("INSERT INTO stock
                        (item_name,item_id,batch_id,brand,category,expiryDate,quantity,unit,form,price,error_log,registered_by,registered_on,reg_uname)                    
                        VALUES
                        ('$item_name','$item_id','$batch_id','$brand','$category','$expiryDate','$qty','$unit','$form','$price','$error_log','$registered_by','$registered_on','$reg_uname')");
                        try{
                            $this->stmt->execute();
                        }catch(PDOException $e){
                            return 'error8'.$e->getMessage();
                        }

                        //insert into entry record table
                        $this->stmt = $this->connect()->prepare("INSERT INTO entry_record
                        (item_name,item_id,batch_id,brand,category,expiryDate,quantity,unit,form,price,error_log,registered_by,registered_on,reg_uname,activity)                    
                        VALUES
                        ('$item_name','$item_id','$batch_id','$brand','$category','$expiryDate','$qty','$unit','$form','$price','$error_log','$registered_by','$registered_on','$reg_uname','Product recorded as first batch batch')");
                        try{
                            $this->stmt->execute();
                        }catch(PDOException $e){
                            return 'error9'.$e->getMessage();
                        }
                         //Delete from temp stock table table
                         $this->stmt = $this->connect()->prepare("DELETE FROM temp_stock WHERE id = '$id' ");
                         try{
                            $this->stmt->execute();
                            return "success";
                        }catch(PDOException $e){
                            return 'error0'.$e->getMessage();
                        }
                    }
                }
                
            }catch(PDOException $e){
                return $e->getMessage();
            }
        }
        

        
    }
?>