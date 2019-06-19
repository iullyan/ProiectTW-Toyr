<?php
require '../../Model/UserModel.php';
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");

$user = new UserModel();
$username = isset($_GET['username']) ?  htmlentities($_GET['username']) : die("Incorrect parameters");

//does the user exist?
if($user->getUserId($username)) {
    if($user->alterUser($username, "admin")) {
        //if it does -> 200 OK
        http_response_code(200);
        //tell the user
        echo json_encode(array("message" => "User type updated."));
    }
    else {
        //server error -> 500
        http_response_code(500);
        //tell the user to try again
        echo json_encode(array("message" => "An error has occurred. Please try again."));
    }
}
else {
    //if it doesn't -> 404 Not found
    http_response_code(404);

    //tell the user
    echo json_encode(array("message" => "User does not exist."));
}