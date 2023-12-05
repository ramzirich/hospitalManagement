<!-- 

// ini_set("display_errors",1);
// header("Access-Control-Allow-Origin: *");
// header("Access-Control-Allow-Methods: POST");
// header("Content-type: application/json; charset=UTF-8");

// include("../config/connection.php");
// include("../models/Patients.php");
// include("../dataInfrastructure/UserMethods.php");

// $db= new Connection();
// $connect = $db->connect();
// $user_obj = new Patients($connect);

// if ($_SERVER['REQUEST_METHOD']=== "POST") {
//     $data = json_decode(file_get_contents("php://input"));

//     if(!empty($data->Email) && !empty($data->Password) && !empty($data->Password) && !empty($data->FirstName) 
//     && !empty($data->LastName) && !empty($data->PhoneNumber) && !empty($data->DateOfBirth) 
//     && !empty($data->Address) && !empty($data->Password) && !empty($data->Password)){
//         $user_obj->Email = $data->Email;
//         $user_obj->Password = $data->Password;
//         $user_obj->FirstName = $data->FirstName;
//         $user_obj->LastName = $data->LastName;
//         $user_obj->PhoneNumber = $data->PhoneNumber;
//         $user_obj->DateOfBirth = $data->DateOfBirth;
//         $user_obj->Address = $data->Address;
//         $user_obj->Roles = $data->Roles;
//         $user_obj->Gender = $data->Gender;
//         $user_obj->InsuranceDetails= $data->InsuranceDetails;

//         if($user_obj->create_patients()){
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



// public function create_patients(){
//     // $user_query = "INSERT INTO ".$this->users_tbl." SET email = ?, password = ?, firstname = ?, lastname = ?,
//     // phonenumber = ?, gender = ?, DateOfBirth = ?, address =?, roles =?";
//     $user_query = "INSERT INTO " .$this->users_tbl. "Set FirstName = ?";
//     $user_obj =$this->conn->prepare($user_query);
//     // $user_obj->bind_param("sssssssss", $this->Email, $this->Password, $this->FirstName, $this->LastName,
//     // $this->PhoneNumber, $this->Gender, $this->DateOfBirth, $this->Address, $this->Roles);
//     $user_obj->bind_param("s", $this->FirstName);
    

//     if(!$user_obj->execute()){
//         die("Error: " . $user_obj->error);
//     }
//     if($user_obj->execute()){
//         return true;
//     }
//     return false;
// } -->