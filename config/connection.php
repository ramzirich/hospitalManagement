<?php
if (!class_exists('Connection')) {
    class Connection{
        private $hostname;
        private $db_user;
        private $db_password;
        private $db_name;

        public function connect(){
            $this->hostname = "localhost";
            $this->db_name = "hospitaldb";
            $this->db_user = "root";
            $this->db_password = null;

            $connection = new mysqli($this->hostname, $this->db_user, $this->db_password, $this->db_name);
            if ($connection->connect_error) {
                die("Connection failed: " . $connection->connect_error);
            }
    
            return $connection;
        } 
    }
}
    
    