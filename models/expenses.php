<?php

    //include database
    require "../lib/database.php";
    class apiProcessor extends Database
    {
        private $stmt;
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
    }

?>