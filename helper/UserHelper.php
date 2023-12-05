<?php
    include("../config/connection.php");
    include("../models/users.php");
    include("../dataInfrastructure/UserMethods.php");
    ini_set("display_errors",1);
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST, GET");
    header("Content-type: application/json; charset=UTF-8");
    class UserHelper{
        function handleUserCreation($data, $connect){
            $userMethods = new UserMethods($connect);
            $user_obj = new Users();

            if(!empty($data->Email) && !empty($data->Password) && !empty($data->Password) && !empty($data->FirstName) 
            && !empty($data->LastName) && !empty($data->PhoneNumber) && !empty($data->DateOfBirth) 
            && !empty($data->Address) && !empty($data->Password) && !empty($data->Password)){
                $user_obj->Email = $data->Email;
                $user_obj->Password = password_hash($data->Password, PASSWORD_DEFAULT) ;
                $user_obj->FirstName = $data->FirstName;
                $user_obj->LastName = $data->LastName;
                $user_obj->PhoneNumber = $data->PhoneNumber;
                $user_obj->DateOfBirth = $data->DateOfBirth;
                $user_obj->Address = $data->Address;
                $user_obj->Roles = $data->Roles;
                $user_obj->Gender = $data->Gender;

                $email_data = $userMethods->checkEmailIfExist($user_obj->Email);
                if(!empty($email_data)) {
                    http_response_code (500);
                    echo json_encode (array(
                    "status" => 0,
                    "message" => "Email taken"
                    ));
                    return false;
                }else{
                    if($userMethods->createUser($user_obj->Email, $user_obj->Password, $user_obj->FirstName, $user_obj->LastName,
                        $user_obj->PhoneNumber, $user_obj->Gender, $user_obj->DateOfBirth, $user_obj->Address, $user_obj->Roles)){
                        http_response_code(200);
                        echo json_encode(array(
                            "status" => 1,
                            "message" => "User created"
                        ));
                        return true;
                    }
                }
                }else{
                    http_response_code(500);
                    echo json_encode(array(
                        "status" => 0,
                        "message" => "All Data Required"
                    )); 
                    return false;
                }
        }

        function fetchUserId($Email, $connect){
            $userMethods = new UserMethods($connect);
            $user_Id = $userMethods->getUserIdByEmail($Email);
            return $user_Id;
        }

        function deleteUser($Id, $connect){
            $userMethods = new UserMethods($connect);
            if($userMethods->deleteUserQuery($Id)){
                http_response_code(200);
                echo json_encode(array(
                    "status" => 1,
                    "message" => "User deleted"
                ));
                return true;
            }else{
                http_response_code(404);
                echo json_encode(array(
                    "status" => 0,
                    "message" => "User not found"
                )); 
                return false;
            }
        }

        
    }