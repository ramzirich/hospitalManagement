<?php
    class UserMethods{
        private $conn;
        private $users_tbl;

        public function __construct($db){
            $this->conn = $db;
            $this->users_tbl ="users";
        }
        public function createUser($Email, $Password, $FirstName, $LastName, $PhoneNumber, $Gender,
         $DateOfBirth, $Address, $Roles){
            $user_query = "INSERT INTO ".$this->users_tbl." SET Email = ?, Password = ?, FirstName = ?, LastName = ?,
            PhoneNumber = ?, Gender = ?, DateOfBirth = ?, Address =?, Roles =?";
            $user_obj =$this->conn->prepare($user_query);
            $user_obj->bind_param("sssssssss", $Email, $Password, $FirstName, $LastName,
            $PhoneNumber, $Gender, $DateOfBirth, $Address, $Roles);
            
            if(!$user_obj->execute()){
                die("Error: " . $user_obj->error);
            }
            return $Email;
        }

        public function deleteUserQuery($Id){
            $user_query = "Delete from ".$this->users_tbl." where Id =?";
            $user_obj =$this->conn->prepare($user_query);
            $user_obj->bind_param("i", $Id);         
            if(!$user_obj->execute()){
                die("Error: " . $user_obj->error);
            }
            return true;
        }

        public function getUserIdByEmail($Email){
            $user_query = "Select Id from ".$this->users_tbl." where Email =?";
            $user_obj =$this->conn->prepare($user_query);
            $user_obj->bind_param("s", $Email);
            
            if(!$user_obj->execute()){
                die("Error: " . $user_obj->error);
            }
            $Id= null;
            $user_obj->bind_result($Id);
            $user_obj->fetch();
            $user_obj->close();
            return $Id;
        }

        public function getUserIdById($Id){
            $user_query = "Select * from ".$this->users_tbl." where Id =?";
            $user_obj =$this->conn->prepare($user_query);
            $user_obj->bind_param("i", $Id);
            
            if(!$user_obj->execute()){
                die("Error: " . $user_obj->error);
            }
            $user_obj->execute();
            $data = $user_obj->get_result();
            return $data->fetch_assoc();
        }

        public function getUserIdFirsLastName($firstName, $lastName){
            $user_query = "Select Id from ".$this->users_tbl." where FirstName =? and LastName=?";
            $user_obj =$this->conn->prepare($user_query);
            $user_obj->bind_param("ss", $firstName, $lastName);
            
            if(!$user_obj->execute()){
                die("Error: " . $user_obj->error);
            }
            $Id= null;
            $user_obj->bind_result();
            $user_obj->fetch();
            $user_obj->close();
            return $Id;
        }

        public function checkEmailIfExist($Email){
            $user_query="Select * from ".$this->users_tbl." where Email = ?";
            $user_obj = $this->conn->prepare($user_query);
            $user_obj->bind_param("s", $Email);

            if($user_obj->execute()){
                $data = $user_obj->get_result();
                return $data->fetch_assoc();
            }
            return array();
        }

        public function checkLogIn($Email){
            $user_query="Select * from ".$this->users_tbl." where Email = ?";
            $user_obj = $this->conn->prepare($user_query);
            $user_obj->bind_param("s", $Email);

            if($user_obj->execute()){
                $data = $user_obj->get_result();
                return $data->fetch_assoc();
            }
            return array();
        }
    }
    
