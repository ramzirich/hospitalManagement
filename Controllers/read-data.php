<?php
ini_set("display_errors",1);
require '../vendor/autoload.php';
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-type: application/json; charset=UTF-8");

include("../config/connection.php");
include("../models/users.php");
include("../models/Patients.php");


$db= new Connection();
$connect = $db->connect();
// $userMethods = new UserMethods($connect);
$user_obj = new Users();
$patient_obj = new Patients();
// $patientMethods= new PatientMethods($connect);

if ($_SERVER['REQUEST_METHOD']=== "POST") {
    // $data = json_decode(file_get_contents("php://input"));
    $all_headers = getallheaders();
    // echo ($all_headers);
    $data = $all_headers['Authorization'];

    if (!empty($data)) {
        try{
            $secret_key = "owt125";
            $algorithm = 'HS256';
            // $decoded_data = JWT::decode($data->jwt, $secret_key, [$algorithm]);
            $decoded_data = JWT::decode($data, new Key($secret_key, $algorithm));
            $user_id_byRole = $decoded_data->data->Id;
            $user_id = $decoded_data->data->UserId;
            http_response_code (200);
            echo json_encode (array(
            "status" => 1,
            "message" => "We got JWT Token",
            "user_data" => $decoded_data,
            "Id" => $user_id_byRole,
            "UserId" => $user_id
            ));
        }catch(Exception $ex){
            http_response_code (500);
            echo json_encode (array(
            "status" => 0,
            "message" => $ex->getMessage()
            ));
        }
    }
}