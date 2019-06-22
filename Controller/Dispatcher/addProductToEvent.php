<?php

require_once '../Utils/CallWebService.php';
require_once '../../Config/config.php';
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");

if(
    isset($_POST['eventId']) &&
    isset($_POST['productId'])

)
{
    $eventId = htmlentities($_POST['eventId']);
    $productId = htmlentities($_POST['productId']);
    //Build the Json object
    $object = null;
    $object->eventId = $eventId;
    $object->productId = $productId;
    $JSONData = json_encode($object);

    $webService = new CallWebService();
    $url = WEB_CONST_URL_PART . 'Event/addProductToEvent.php';
    $response = $webService->doPost($url, $JSONData);
    echo $response;
}else
    echo json_encode(array("Message" => "Unspecified parameters"));


