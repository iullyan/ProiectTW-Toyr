<?php
require_once '../../Config/config.php';
require_once '../Utils/CallWebService.php';
$webService = new CallWebService();
//Web service url

$url = WEB_CONST_URL_PART_USERS . 'addUser.php';
//get the data from the form
if (isset($_POST['username']) &&
    isset($_POST['password']) &&
    $_POST['firstname'] &&
    $_POST['lastname'] &&
    $_POST['lastname'] ) {
    $formData = array(
        "username" => $_POST['username'],
        "password" => $_POST['password'],
        "user_type" => "customer",
        "firstname" => $_POST['firstname'],
        "lastname" => $_POST['lastname'],
        "email" => $_POST['lastname']);
}else
    die("Unspecified parameters");
//create the json to be sent
$userCredentials = json_encode($formData);

$response = $webService->doPost($url, $userCredentials);

//echo $url;
header('Location:' . INDEX_URL);