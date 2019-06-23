<?php

require_once '../Utils/CallWebService.php';
require_once '../../Config/config.php';

$operationMessage = "";
if(
    !empty($_POST['eventId']) &&
    !empty($_POST['productId'])

) {
    $eventId = htmlentities($_POST['eventId']);
    $productId = htmlentities($_POST['productId']);
    //Build the Json object
    $object = new stdClass();
    $object->eventId = $eventId;
    $object->productId = $productId;
    $JSONData = json_encode($object);

    $webService = new CallWebService();
    $url = WEB_CONST_URL_PART . 'Event/addProductToEvent.php';
    $response = $webService->doPost($url, $JSONData);

    $operationMessage = $response->Message;
} else
    $operationMessage = "Unable to add product to event. Input data is incomplete";

echo '<p style="text-align:center;font-size: 25px;" class="centered">Mesajul operației: ' . $operationMessage . ' </p>';

