<?php

ini_set("display_errors",1);
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, DELETE");
header("Content-type: application/json; charset=UTF-8");

include("../config/connection.php");
include("../models/Patients.php");
include("../dataInfrastructure/PatientMethods.php");
include("../helper/UserHelper.php");
include("../helper/PatientHelper.php");

$db= new Connection();
$connect = $db->connect();
$patientsMethods = new PatientMethods($connect);
$patient_obj = new Patients();

if ($_SERVER['REQUEST_METHOD']=== "POST") {
    $data = json_decode(file_get_contents("php://input"));
    $user_helper = new UserHelper();
    $isEmailUnique = $user_helper->handleUserCreation($data, $connect);
    
    if($isEmailUnique == false){
        http_response_code(500);
        echo json_encode(array(
            "status" => 0,
            "message" => "Email Taken"
        )); 
        return false;
    }
    $userId = $user_helper->fetchUserId($data->Email, $connect);
    $patientsMethods->createPatients($userId, $data->InsuranceDetails);
    $patient_obj->UserId = $userId;
    $patient_obj->InsuranceDetails = $data->InsuranceDetails;
    if($patientsMethods){
        http_response_code(200);
        echo json_encode(array(
            "status" => 1,
            "message" => "Patient created"
        ));
    }
    else{
        http_response_code(500);
        echo json_encode(array(
            "status" => 0,
            "message" => "All Data Required"
        )); 
    }
}
else if($_SERVER['REQUEST_METHOD']=== "DELETE") {
    $data = json_decode(file_get_contents("php://input"));
    $patient_helper = new PatientHelper($patientsMethods);
    $user_id = $patient_helper->fetchUserIdFromId($data->Id);
    $user_helper = new UserHelper();
    if($user_helper->DeleteUser($user_id, $connect)){
        if($patientsMethods->deletePatientQuery($data->Id)>0){
            http_response_code(200);
            echo json_encode(array(
            "status" => 1,
            "message" => "Patient Deleted"
        ));
        }else{
            http_response_code(404);
            echo json_encode(array(
                "status" => 0,
                "message" => "Delete Failed"
            )); 
        }
    }

}


else{
    http_response_code (503);
    echo json_encode (array(
    "status" => 0,
    "message" => "Access Denied"
    ));
}