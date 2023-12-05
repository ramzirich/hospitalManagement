<?php
    if (!class_exists('PatientMethods')) {
        class PatientMethods{
            private $conn;
            private $patients_tbl;
    
            public function __construct($db) {
                $this->conn = $db;
                $this->patients_tbl = "patients";
            }
    
            //tarnsform values from static to dynamic
            public function createPatients($userId, $insuranceDetails) {
                echo ($userId);
                $patient_query = "INSERT INTO ".$this->patients_tbl." (InsuranceDetails, UserId) VALUES (?, ?)";
                $patient_obj = $this->conn->prepare($patient_query);
                $patient_obj->bind_param("si", $insuranceDetails, $userId);
    
                if(!$patient_obj->execute()){
                    die("Error: " . $patient_obj->error);
                }
                return true;
            }
    
            public function deletePatientQuery($Id){
                $patient_query = "Delete from ".$this->patients_tbl." where Id =?";
                $patient_obj =$this->conn->prepare($patient_query);
                $patient_obj->bind_param("i", $Id);         
                if(!$patient_obj->execute()){
                    die("Error: " . $patient_obj->error);
                }
                return true;
            }
    
            public function getUserId($id) {
              
                $patient_query = "Select UserId from ".$this->patients_tbl." where Id =?";
                $patient_obj =$this->conn->prepare($patient_query);
                $patient_obj->bind_param("i", $id);
                
                if(!$patient_obj->execute()){
                    die("Error: " . $patient_obj->error);
                }
                $UserId= null;
                $patient_obj->bind_result($UserId);
                $patient_obj->fetch();
                $patient_obj->close();
                return $UserId;           
            }

            public function getPatientDataFromUserId($id) {
              
                $patient_query = "Select * from ".$this->patients_tbl." where UserId =?";
                $patient_obj =$this->conn->prepare($patient_query);
                $patient_obj->bind_param("i", $id);
                
                if(!$patient_obj->execute()){
                    die("Error: " . $patient_obj->error);
                } 
                if($patient_obj->execute()){
                    $data = $patient_obj->get_result();
                    return $data->fetch_assoc();
                }
                return array();
            }
        }
    }
    