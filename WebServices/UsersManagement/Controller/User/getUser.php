<?php
require '../../Model/UserModel.php';
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");

$user = new UserModel();
$username = isset($_GET['username']) ?  htmlentities($_GET['username']) : die("Incorrect parameters");
$userCredentials = $user->getUserCredentials($username);

if($userCredentials) {
    //make it json format
    http_response_code(200);
    echo json_encode( $userCredentials, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
}
else { //just in case somehow user existence verification fails

    //404 Not found
    http_response_code(404);

    //tell the user it doesn't exist
    echo json_encode(array("message" => "User does not exist."));
}