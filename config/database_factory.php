<?php

    include_once('config.php');
    class database_factory
    {
        private $host   =   DB_HOST; //database server
        private $user     = DB_USER; //database login name
        private $pass     = DB_PASSWORD; //database login password
        private $database = DB_NAME; //database name

        public $link;


        public function __construct()
        {
            try
            {
                $conn = new mysqli($this->host, $this->user, $this->pass, $this->database);
                $this->link =  $conn;
            }           
            catch(Exception $ex)
            {
                return array("error" => $ex->getMessage());                   
            }     
        }

        public function fetchResut($sql)
        {
            try
            {
                $result = $this->link->query($sql);
                if($result->num_rows > 0)
                {
                    return $result->fetch_all(MYSQLI_ASSOC);
                }
                else
                {
                    return false;
                }
            }
            catch(Exception $ex)
            {
                return array("error" => $ex->getMessage());                   
            }  

        }

        public function execute($sql)
        {
            try
            {
                $result = $this->link->query($sql);
                if($result->affected_rows > 0)
                {
                    return $result;
                }
                else
                {
                    return false;
                }
            }
            catch(Exception $ex)
            {
                return array("error" => $ex->getMessage());                   
            }  
        }
    }

        





?>