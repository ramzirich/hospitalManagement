<?php
    if (!class_exists('DoctorMethods')) {
        class DoctorMethods{
            private $conn;
            private $doctors_tbl;
    
            public function __construct($db) {
                $this->conn = $db;
                $this->doctors_tbl = "doctors";
            }
    
            //tarnsform values from static to dynamic
            public function createDoctor($userId, $Specialization) {
                echo ($userId);
                $doctor_query = "INSERT INTO ".$this->doctors_tbl." (Specialization, UserId) VALUES (?, ?)";
                $doctor_obj = $this->conn->prepare($doctor_query);
                $doctor_obj->bind_param("si", $Specialization, $userId);
    
                if(!$doctor_obj->execute()){
                    die("Error: " . $doctor_obj->error);
                }
                return true;
            }
    
            public function deleteDoctorQuery($Id){
                $doctor_query = "Delete from ".$this->doctors_tbl." where Id =?";
                $doctor_obj =$this->conn->prepare($doctor_query);
                $doctor_obj->bind_param("i", $Id);         
                if(!$doctor_obj->execute()){
                    die("Error: " . $doctor_obj->error);
                }
                return true;
            }
    
            public function getUserId($id) {
              
                $doctor_query = "Select UserId from ".$this->doctors_tbl." where Id =?";
                $doctor_obj =$this->conn->prepare($doctor_query);
                $doctor_obj->bind_param("i", $id);
                
                if(!$doctor_obj->execute()){
                    die("Error: " . $doctor_obj->error);
                }
                $UserId= null;
                $doctor_obj->bind_result($UserId);
                $doctor_obj->fetch();
                $doctor_obj->close();
                return $UserId;           
            }

            public function getDoctorDataFromUserId($id) {
              
                $doctor_query = "Select * from ".$this->doctors_tbl." where UserId =?";
                $doctor_obj =$this->conn->prepare($doctor_query);
                $doctor_obj->bind_param("i", $id);
                
                if(!$doctor_obj->execute()){
                    die("Error: " . $doctor_obj->error);
                } 
                if($doctor_obj->execute()){
                    $data = $doctor_obj->get_result();
                    return $data->fetch_assoc();
                }
                return array();
            }
        }
    }
    