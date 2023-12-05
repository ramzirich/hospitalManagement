<?php
    ini_set("display_errors",1);
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, DELETE");
    header("Content-type: application/json; charset=UTF-8");

    include("../dataInfrastructure/AppointmentsMethods.php");
  
    $appointmentMethods = new AppointmentsMethods();

    if($_SERVER['REQUEST_METHOD']=='GET'){
        $data = json_decode(file_get_contents("php://input"));
        $list_of_apppointments = $appointmentMethods->get_appointment_by_id($data->UserId);
         
        if($list_of_apppointments){
            http_response_code(200);
            echo json_encode(array(
                "status" => 1,
                "message" => $list_of_apppointments,
            ));
        }else{
            http_response_code(404);
            echo json_encode(array(
                "status" => 0,
                "message" => "Patient Not Found"
            ));
        }
    }

    if($_SERVER['REQUEST_METHOD']=='POST'){
        $data = json_decode(file_get_contents("php://input"));
        $appointmentMethods->book_appointment($data->PatientId,$data->DoctorId,$data->AppointmentTime);
        
        if(!$appointmentMethods==1){
            http_response_code(500);
            echo json_encode(array(
                "status" => 0,
                "message" => "Error in creating appointment"
            )); 
            return false;
        }
        http_response_code(200);
        echo json_encode(array(
            "status" => 1,
            "message" => "Appointment created"
        )); 
    }

    if($_SERVER['REQUEST_METHOD']=='PUT'){
        $data = json_decode(file_get_contents("php://input"));
        $appointmentMethods->change_appointmentByPatient($data->PatientId,$data->DoctorId,$data->AppointmentTime);
        
        if(!$appointmentMethods==1){
            http_response_code(500);
            echo json_encode(array(
                "status" => 0,
                "message" => "Error in updating appointment"
            )); 
            return false;
        }
        http_response_code(200);
        echo json_encode(array(
            "status" => 1,
            "message" => "Appointment upadted"
        )); 
    }