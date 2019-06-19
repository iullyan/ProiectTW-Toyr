<?php
require '../../Model/UserModel.php';
header('Content-Type: application/json; charset=UTF-8');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");

$user = new UserModel();
$userCredentials = json_decode(file_get_contents("php://input"));

if(
    !empty($username = $userCredentials->username) &&
    !empty($password = $userCredentials->password) &&
    !empty($user_type = $userCredentials->user_type) &&
    !empty($firstname = $userCredentials->firstname) &&
    !empty($lastname = $userCredentials->lastname) &&
    !empty($email = $userCredentials->email)
) {
    if($user->addUser($username, $password, $user_type, $firstname, $lastname, $email)) {
        //201 created
        http_response_code(201);

        //tell the user
        echo json_encode(array("message" => "User was registered."));
    }
    else { //if unable to create the account

        //503 service unavailable
        http_response_code(503);

        //tell the user
        echo json_encode(array("message" => "Unable to register the user."));
    }
}
else {//if incomplete data

    //400 bad request
    http_response_code(400);

    //tell the user
    echo json_encode(array("message" => "Unable to register the user. Input data is incomplete."));
}