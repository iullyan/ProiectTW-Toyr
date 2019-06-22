<?php

require_once '../Utils/CallWebService.php';
require_once '../../Config/config.php';
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");

if(
    isset($_POST['boughtProductId']) &&
    isset($_POST['giftedProductId']) &&
    isset($_POST['productUnitsBought']) &&
    isset($_POST['giftedProductQuantity']) &&
    isset($_POST['validFrom']) &&
    isset($_POST['validUntil'])
)
{
    $boughtProductId = htmlentities($_POST['boughtProductId']);
    $giftedProductId = htmlentities($_POST['giftedProductId']);
    $productUnitsBought = htmlentities($_POST['productUnitsBought']);
    $giftedProductQuantity = htmlentities($_POST['giftedProductQuantity']);
    $validFrom = htmlentities($_POST['validFrom']);
    $validUntil = htmlentities($_POST['validUntil']);

    //Build the Json object
    $object = null;
    $object->boughtProductId  = $boughtProductId;
    $object->giftedProductId = $giftedProductId;
    $object->productUnitsBought = $productUnitsBought;
    $object->giftedProductQuantity = $giftedProductQuantity;
    $object->validFrom = $validFrom;
    $object->validUntil = $validUntil;

    $JSONData = json_encode($object);

    $webService = new CallWebService();
    $url = WEB_CONST_URL_PART . 'Promotion/addPromotion.php';
    $response = $webService->doPost($url, $JSONData);

    echo $response;
}else
    echo json_encode(array("Message" => "Unspecified parameters"));

