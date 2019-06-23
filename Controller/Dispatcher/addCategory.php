<?php

require_once '../Utils/CallWebService.php';
require_once '../../Config/config.php';

$operationMessage = "";
if (!empty($_POST['name'])) {
    $name = htmlentities($_POST['name']);

    //Build the Json object
    $object = new stdClass();
    $object->name = $name;

    $JSONData = json_encode($object);
    $webService = new CallWebService();
    $url = WEB_CONST_URL_PART . 'Category/addCategory.php';
    $response = $webService->doPost($url, $JSONData);

    $operationMessage = $response->Message;
} else
    $operationMessage = "Unable to create discount. Input data is incomplete";

echo '<p style="text-align:center;font-size: 25px;" class="centered">Mesajul operației: ' . $operationMessage . ' </p>';