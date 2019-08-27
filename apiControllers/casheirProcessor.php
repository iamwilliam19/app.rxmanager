<?php

    //include database
    require "../lib/database.php";
    class casheirProcessor extends Database{
        private $stmt;
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

        public function validate($prod, $qty){
            $this->stmt = $this->connect()->prepare("SELECT * FROM stock WHERE 
            item_name = '$prod' OR item_id = '$prod' 
            ");
            $this->stmt->execute();
            $row = $this->stmt->rowCount();
            if($row < 1){
                return "Invalid Product ID ";
            }else {
                //check stock
                $this->stmt = $this->connect()->prepare("SELECT * FROM stock WHERE 
                (item_name = '$prod' OR item_id = '$prod') AND (quantity >= '$qty' AND  NOT quantity = 0) 
                ");
                 $this->stmt->execute();
                 $row = $this->stmt->rowCount();
                 if($row < 1){
                    return "Not enough stock";
                }else{
                    
                    //fetch stock details
                    $details = $this->stmt->fetchObject();
                    $item_name = $details->item_name;
                    $item_id = $details->item_id;
                    if($qty == 0){
                        $cart_quantity = $details->unit;
                    }else{
                        $cart_quantity = $qty;
                    }

                    $price = round(($cart_quantity / $details->unit ) * $details->price);
                    $cashier_name = $this->name;
                    //check if product is in cart already
                    $this->stmt = $this->connect()->prepare("SELECT * FROM cart WHERE (item_id = '$prod' OR item_name = '$prod') AND reg_uname = '$this->token' ");
                    $this->stmt->execute();
                    $row = $this->stmt->rowCount();
                    if($row > 0){
                        //update quantity and price
                        $cart = $this->stmt->fetchObject();
                        $cart_quantity  = $cart_quantity + $cart->qty;
                        $cart_id = $cart->id;
                        $price = round(($cart_quantity / $details->unit ) * $details->price);

                        $this->stmt = $this->connect()->prepare("UPDATE cart SET 
                            qty = '$cart_quantity', price = '$price' WHERE id = '$cart_id'
                        ");
                        try{
                            $this->stmt->execute();
                            return 'success';
                        }catch(PDOException $e){
                            return $e->getMessage();
                        }
                    }else {
                        //insert it
                        $this->stmt = $this->connect()->prepare("INSERT INTO cart 
                        (item_name,item_id,qty,price,cashier_name,reg_uname)
                        VALUES
                        ('$item_name','$item_id','$cart_quantity','$price','$cashier_name','$this->token');
                         ");

                         try{
                             $this->stmt->execute();
                             return 'success';
                         }catch(PDOException $e){
                             return $e->getMessage();
                         }
                    }
                }
            }
        }

        public function fetchCart(){
            $uname = $this->token;
            $this->stmt = $this->connect()->prepare("SELECT 
                * 
             FROM cart WHERE reg_uname = '$uname' ");
            $this->stmt->execute();
            return $this->stmt->fetchAll();
        }

       
        public function deleteOrder($id){
            $this->stmt = $this->connect()->prepare("DELETE FROM cart WHERE id = '$id' ");
            try{
                $this->stmt->execute();
                return 'success';
            }catch(PDOException $e){
                return $e->getMessage();
            }

        }

        public function deleteCart($uname){
            $this->stmt = $this->connect()->prepare("DELETE FROM cart WHERE reg_uname = '$uname' ");
            try{
                $this->stmt->execute();
                return 'success';
            }catch(PDOException $e){
                return $e->getMessage();
            }

        }

        public function pay($uname,$name,$addr,$phone,$transaction,$receipt_id,$disccount,$amt_paid){
            $d = date('d');
            $m = date('m');
            $y = date('y');
            $total_price = 0;

            //fetch cart
            $this->stmt = $this->connect()->prepare("SELECT * FROM cart WHERE reg_uname = '$uname' ");
            $this->stmt->execute();
            $detail = $this->stmt->fetchAll();
            foreach($detail as $detail){
                $item_name = $detail['item_name'];
                $item_id = $detail['item_id'];
                $qty = $detail['qty'];
                $cashier_name = $detail['cashier_name'];
                $price = $detail['price'];
                $id = $detail['id'];
                //update quantity from stock
                $this->stmt = $this->connect()->prepare("UPDATE stock SET quantity = quantity - $qty  WHERE item_id = '$item_id' AND quantity > 0 LIMIT  1 ");
                
                    $this->stmt->execute();
                    
                

                //insert in sales table
                $this->stmt = $this->connect()->prepare("INSERT INTO sales
                (item_name,item_id,price,qty,cashier_name,day,month,year,receipt_id,reg_uname,customer_name,customer_number,customer_address,payment_form)
                VALUES
                ('$item_name','$item_id','$price','$qty','$cashier_name', '$d','$m','$y','$receipt_id','$uname','$name','$phone','$addr','$transaction'); 
                ");
                try{
                    $this->stmt->execute();
                    //delete form cart
                    $this->stmt = $this->connect()->prepare("DELETE FROM cart WHERE id = '$id' ");
                    $this->stmt->execute();
                }catch(PDOException $e){
                    return $e->getMessage();
                }

                $total_price += $price; 

            }

            $total_price;
            $perc = ($disccount / 100) * $total_price;
            $net_price = $total_price - $perc;
            if ($amt_paid != '') {
                $amt_remaining = $net_price - $amt_paid;
            }else{
                $amt_remaining = '';
            }
            //insert receipt record table
            $this->stmt = $this->connect()->prepare("INSERT INTO receipt_record 
            (receipt_id,total_price,disccount,net_price,day,month,year,payment_form,customer_name,customer_number,customer_address,amt_paid,amt_remaining)
            VALUES
            ('$receipt_id','$total_price','$disccount','$net_price','$d','$m','$y','$transaction','$name','$phone','$addr','$amt_paid','$amt_remaining')
            ");
             
             try{
                $this->stmt->execute();
                
                return 'success'.$receipt_id;
               
            }catch(PDOException $e){
                return $e->getMessage();
            }
            
        }

        public function getReceipt($receipt_id){
            //get details from sales
            $this->stmt = $this -> connect()->prepare("SELECT * FROM sales WHERE receipt_id = '$receipt_id'");
            $this->stmt->execute();
            return $this->stmt->fetchAll();
        }

        public function getReceiptDetail($receipt_id){
             //get details from sales
             $this->stmt = $this -> connect()->prepare("SELECT * FROM receipt_record WHERE receipt_id = '$receipt_id'");
             $this->stmt->execute();
             return $this->stmt->fetchObject();
        }
    }
?>