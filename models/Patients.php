<?php
    include("../models/users.php");
    class Patients extends Users{

        // private $conn;
        // private $patients_tbl;
        // private $users_tbl;
        // public function __construct($db){
        //     $this->conn = $db;
        //     $this->patients_tbl="patients";
        //     $this->users_tbl = "users";
        // }

        public $InsuranceDetails;
        public $UserId;   
        
        // public function create_patients(){
        //     $user_query = "INSERT INTO ".$this->users_tbl." SET Email = ?, Password = ?, FirstName = ?, LastName = ?,
        //     PhoneNumber = ?, Gender = ?, DateOfBirth = ?, Address =?, Roles =?";
        //     $user_obj =$this->conn->prepare($user_query);
        //     $user_obj->bind_param("sssssssss", $this->Email, $this->Password, $this->FirstName, $this->LastName,
        //     $this->PhoneNumber, $this->Gender, $this->DateOfBirth, $this->Address, $this->Roles);
            
        //     if(!$user_obj->execute()){
        //         die("Error: " . $user_obj->error);
        //     }
        //     $this->UserId = $user_obj->insert_id;

        //     $patient_query = "INSERT INTO ".$this->patients_tbl." SET UserId = ?, InsuranceDetails = ?";
        //     $patient_obj = $this->conn->prepare($patient_query);
        //     $patient_obj->bind_param("is", $this->UserId, $this->InsuranceDetails);

        //     if(!$patient_obj->execute()){
        //         die("Error: " . $patient_obj->error);
        //     }

        //     return true;
        // //     if($user_obj->execute()){
        // //         return true;
        // //     }
        // //     return false;
        // }
    }
?>