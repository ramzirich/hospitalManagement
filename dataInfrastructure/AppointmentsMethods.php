<?php

    include ('../config/connection.php');
    include ('../models/Appointments.php');
    class AppointmentsMethods{
        private $conn;
        private $table;
        private $appointment;
        public function __construct(){
            $db = new Connection();
            $this->conn = $db->connect();
            $this->table = 'appointments';
            $this->appointment = new Appointments();
        } 

        public function get_appointment_by_id($appointment_id){
            $sql_query = 'Select * from '.$this->table.' where PatientId = ?';
            $sql_obj = $this->conn->prepare($sql_query);
            $sql_obj->bind_param('i', $appointment_id);

            if(!$sql_obj->execute()){
                die("Error: ".$sql_obj->error);
            }

            $sql_obj->execute();
            $data = $sql_obj->get_result();
            return $data->fetch_assoc();
        }

        public function book_appointment($patientId, $doctorId, $date){
            $sql_query = "Insert into ".$this->table." (PatientId, DoctorId,AppointmentTime) values (?,?,?)";
            $sql_obj = $this->conn->prepare($sql_query);
            $sql_obj->bind_param('iis', $patientId, $doctorId, $date);

            if(!$sql_obj->execute()){
                die("Error: " . $sql_obj->error);
            }
            return true;
        }

        public function change_appointmentByPatient( $patientId,$doctorId, $date){
            $sql_query = "Update ".$this->table." SET DoctorId =?,AppointmentTime=? where PatientId =?";
            $sql_obj = $this->conn->prepare($sql_query);
            $sql_obj->bind_param('isi', $doctorId, $date, $patientId);

            if(!$sql_obj->execute()){
                die("Error: " . $sql_obj->error);
            }
            return true;
        }
    }