<?php
ini_set("display_errors",1);
require '../vendor/autoload.php';
use \Firebase\JWT\JWT;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-type: application/json; charset=UTF-8");

include("../config/connection.php");
include("../models/users.php");
include("../models/Patients.php");
include("../dataInfrastructure/UserMethods.php");
include("../dataInfrastructure/PatientMethods.php");

$db= new Connection();
$connect = $db->connect();
$userMethods = new UserMethods($connect);
$user_obj = new Users();
$patient_obj = new Patients();
$patientMethods= new PatientMethods($connect);

if ($_SERVER['REQUEST_METHOD']=== "POST") {
    $data = json_decode(file_get_contents("php://input"));
    if(!empty($data->Email) && !empty($data->Password)){
        $user_obj->Email = $data->Email;
        $user_data = $userMethods->checkLogIn($user_obj->Email);
        $patient_data = $patientMethods->getPatientDataFromUserId($user_data['Id']);
      
        if(!empty($user_data) && (!empty($patient_data))){
            $Id = $patient_data['Id'];
            $Email = $user_data['Email'];
            $Password = $user_data['Password'];
            $FirstName = $user_data['FirstName'];
            $LastName = $user_data['LastName'];
            $PhoneNumber = $user_data['PhoneNumber'];
            $Gender = $user_data['Gender'];
            $DateOfBirth = $user_data['DateOfBirth'];
            $Address = $user_data['Address'];
            $Roles = $user_data['Roles'];
            $InsuranceDetails = $patient_data['InsuranceDetails'];
            $UserId = $patient_data['UserId'];

            if(password_verify($data->Password, $Password)){

                $iss = "localhost";
                $iat = time();
                $nbf= $iat + 1;
                $exp= $iat + 60000;
                $aud = "myusers";
                $user_arr_data = array(
                    "Id" => $patient_data['Id'],
                    "Email" => $user_data['Email'],
                    "Password" => $user_data['Password'],
                    "FirstName" => $user_data['FirstName'],
                    "LastName" => $user_data['LastName'],
                    "PhoneNumber" => $user_data['PhoneNumber'],
                    "Gender" => $user_data['Gender'],
                    "DateOfBirth" => $user_data['DateOfBirth'],
                    "Address" => $user_data['Address'],
                    "Roles" => $user_data['Roles'],
                    "InsuranceDetails" => $patient_data['InsuranceDetails'],
                    "UserId" => $patient_data['UserId']
                );
                $secret_key = "owt125";
                $algorithm = 'HS256'; 
                $payload_info = array(
                    "iss"=> $iss,
                    "iat"=> $iat,
                    "nbf"=> $nbf,
                    "exp"=> $exp,
                    "aud"=> $aud,
                    "data"=> $user_arr_data
                    );
                $jwt = JWT::encode($payload_info, $secret_key, $algorithm);


                http_response_code(200);
                echo json_encode(array(
                    "status" => 1,
                    "jwt" => $jwt,
                    "message" => "Logged in successfully"
                ));
            }else{
                http_response_code(404);
                echo json_encode(array(
                    "status" => 0,
                    "message" => "Invalid Creadentiels"
                ));
            }

        }else{
            http_response_code(404);
            echo json_encode(array(
                "status" => 0,
                "message" => "Invalid Credentiels"
            ));
        }

    }else{
        http_response_code(404);
            echo json_encode(array(
                "status" => 0,
                "message" => "All data needed"
            ));
    }
}

//     if(!empty($data->Email) && !empty($data->Password) && !empty($data->Password) && !empty($data->FirstName) 
//     && !empty($data->LastName) && !empty($data->PhoneNumber) && !empty($data->DateOfBirth) 
//     && !empty($data->Address) && !empty($data->Password) && !empty($data->Password)){
//         $user_obj->Email = $data->Email;
//         $user_obj->Password = password_hash($data->Password, PASSWORD_DEFAULT) ;
//         $user_obj->FirstName = $data->FirstName;
//         $user_obj->LastName = $data->LastName;
//         $user_obj->PhoneNumber = $data->PhoneNumber;
//         $user_obj->DateOfBirth = $data->DateOfBirth;
//         $user_obj->Address = $data->Address;
//         $user_obj->Roles = $data->Roles;
//         $user_obj->Gender = $data->Gender;

//         if($userMethods->createUser($user_obj->Email, $user_obj->Password, $user_obj->FirstName, $user_obj->LastName,
//          $user_obj->PhoneNumber, $user_obj->Gender, $user_obj->DateOfBirth, $user_obj->Address, $user_obj->Roles)){
//             http_response_code(200);
//             echo json_encode(array(
//                 "status" => 1,
//                 "message" => "User created"
//             ));
//         }
//     }else{
//         http_response_code(500);
//         echo json_encode(array(
//             "status" => 0,
//             "message" => "All Data Required"
//         )); 
//     }
    
// }else{
//     http_response_code (503);
//     echo json_encode (array(
//     "status" => 0,
//     "message" => "Access Denied"
//     ));
// }