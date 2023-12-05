<?php
    include("../config/connection.php");
    include("../models/users.php");
    include("../dataInfrastructure/DoctorMethods.php");
    ini_set("display_errors",1);
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST, GET");
    header("Content-type: application/json; charset=UTF-8");

    class DoctorHelper{

        private $DoctorMethods;
        public function __construct($doctorMethods){
            $this->DoctorMethods = $doctorMethods;
        }
        function fetchUserIdFromId($Id){
            // $patientMethods = new PatientMethods($connect);
            $user_Id = $this->DoctorMethods->getUserId($Id);
            return $user_Id;
        }
    }