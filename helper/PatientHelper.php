<?php
    include("../config/connection.php");
    include("../models/users.php");
    include("../dataInfrastructure/PatientMethods.php");
    ini_set("display_errors",1);
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST, GET");
    header("Content-type: application/json; charset=UTF-8");

    class PatientHelper{

        private $patientMethods;
        public function __construct($patientMethods){
            $this->patientMethods = $patientMethods;
        }
        function fetchUserIdFromId($Id){
            // $patientMethods = new PatientMethods($connect);
            $user_Id = $this->patientMethods->getUserId($Id);
            return $user_Id;
        }
    }