<?php
    //include database file
  require "lib/database.php";
  /**
   *
  * handle stocks
  */

  class Stock_manager extends Database {
    //declare stmt variable
    private $stmt;

    function __construct() {
        echo "stock model";
    }

    public function getStock(){
        $this->stmt = $this->connect()->prepare("SELECT
         id, item_name, item_id, form, unit, price , sum(quantity)
         FROM stock
        Group BY item_name 
        order by id DESC");
        $this->stmt->execute();
        $row = $this->stmt->rowCount();
        return $stock = $this->stmt->fetchAll();
    }

    public function getProduct($product){
      $this->stmt = $this->connect()->prepare("SELECT
       id, item_name, item_id,category, form, unit, price ,brand, sum(quantity) AS qty
       FROM stock
       WHERE item_name = '$product'
      Group BY item_name 
      ");
      $this->stmt->execute();
      $row = $this->stmt->rowCount();
      return $stock = $this->stmt->fetchObject();
  }

  public function getOtherProduct($product){
    $this->stmt = $this->connect()->prepare("SELECT
     *
     FROM stock
     WHERE item_name = '$product'
     
    ");
    $this->stmt->execute();
    $row = $this->stmt->rowCount();
    return $stock = $this->stmt->fetchAll();
}

  
  }

?>