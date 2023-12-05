<?php

    include("../config/connection.php");
    include("../models/MedicalRecords.php");
    class MedicalRecordsMethods{
        private $conn;
        private $medicalRecords_tbl ;
        public function __construct() {
            $db= new Connection();
            $this->conn = $db->connect();
            $this->medicalRecords_tbl = "medicalrecords";
        }

        public function getMedicalRecords() {
            
        }
    }