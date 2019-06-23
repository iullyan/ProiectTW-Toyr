<?php

require_once '../Utils/CallWebService.php';
require_once '../../Config/config.php';

$operationMessage = "";
if (
    !empty($_POST['discountPercentage']) &&
    !empty($_POST['productId']) &&
    !empty($_POST['validFrom']) &&
    !empty($_POST['validUntil'])
) {
    $productId = htmlentities($_POST['productId']);
    $discountPercentage = htmlentities($_POST['discountPercentage']);
    $validFrom = htmlentities($_POST['validFrom']);
    $validUntil = htmlentities($_POST['validUntil']);
    //Build the Json object
    $object = new stdClass();
    $object->productId = $productId;
    $object->validFrom = $validFrom;
    $object->validUntil = $validUntil;
    $object->percentage = $discountPercentage;
    $JSONData = json_encode($object);

    $webService = new CallWebService();
    $url = WEB_CONST_URL_PART . 'Discount/addDiscount.php';
    $response = $webService->doPost($url, $JSONData);

    $operationMessage = $response->Message;
} else
    $operationMessage = "Unable to create discount. Input data is incomplete";

echo '<p style="text-align:center;font-size: 25px;" class="centered">Mesajul operației: ' . $operationMessage . ' </p>';
