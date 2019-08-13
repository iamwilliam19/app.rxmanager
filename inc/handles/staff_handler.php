<?php

    

    //include database
    require "lib/database.php";

    class Staffhandler extends Database
    {
        private $stmt;

        public function __construct() {
            //echo "we are in staff handler";
        }

        public function getUsers(){
            $this->stmt = $this->connect()->prepare("SELECT * FROM users order by id DESC");
            $this->stmt->execute();
            return $this->stmt->fetchAll();
        }

        public function getMyDetail($token){
            $this->stmt = $this->connect()->prepare("SELECT * FROM users WHERE uname = ? ");
            $this->stmt->execute([$token]);
            return $this->stmt->fetch();
        }

    }  

?>