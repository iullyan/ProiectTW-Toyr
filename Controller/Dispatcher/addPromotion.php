<?php

require_once '../Utils/CallWebService.php';
require_once '../../Config/config.php';

$operationMessage = "";
if(
    !empty($_POST['boughtProductId']) &&
    !empty($_POST['giftedProductId']) &&
    !empty($_POST['productUnitsBought']) &&
    !empty($_POST['giftedProductQuantity']) &&
    !empty($_POST['validFrom']) &&
    !empty($_POST['validUntil'])
) {
    $boughtProductId = htmlentities($_POST['boughtProductId']);
    $giftedProductId = htmlentities($_POST['giftedProductId']);
    $productUnitsBought = htmlentities($_POST['productUnitsBought']);
    $giftedProductQuantity = htmlentities($_POST['giftedProductQuantity']);
    $validFrom = htmlentities($_POST['validFrom']);
    $validUntil = htmlentities($_POST['validUntil']);

    //Build the Json object
    $object = new stdClass();
    $object->boughtProductId = $boughtProductId;
    $object->giftedProductId = $giftedProductId;
    $object->productUnitsBought = $productUnitsBought;
    $object->giftedProductQuantity = $giftedProductQuantity;
    $object->validFrom = $validFrom;
    $object->validUntil = $validUntil;

    $JSONData = json_encode($object);

    $webService = new CallWebService();
    $url = WEB_CONST_URL_PART . 'Promotion/addPromotion.php';
    $response = $webService->doPost($url, $JSONData);

    $operationMessage = $response->Message;
} else
    $operationMessage = "Unable to create promotion. Input data is incomplete";

echo '<p style="text-align:center;font-size: 25px;" class="centered">Mesajul operației: ' . $operationMessage . ' </p>';

