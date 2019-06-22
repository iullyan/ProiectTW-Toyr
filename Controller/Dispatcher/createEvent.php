<?php

require_once '../Utils/CallWebService.php';
require_once '../../Config/config.php';
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");

if(
    isset($_POST['name']) &&
    isset($_POST['startingDate']) &&
    isset($_POST['endingDate'])

)
{
    $name = htmlentities($_POST['name']);
    $startingDate = htmlentities($_POST['startingDate']);
    $endingDate = htmlentities($_POST['endingDate']);


    //Build the Json object
    $object = null;
    $object->name = $name;
    $object->startingDate = $startingDate;
    $object->endingDate = $endingDate;
    $JSONData = json_encode($object);

    $webService = new CallWebService();
    $url = WEB_CONST_URL_PART . 'Event/createEvent.php';
    $response = $webService->doPost($url, $JSONData);

    echo $response;
}
else
    echo json_encode(array("Message" => "Unspecified parameters"));

