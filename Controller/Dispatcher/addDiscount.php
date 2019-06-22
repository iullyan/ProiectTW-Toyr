<?php

require_once '../Utils/CallWebService.php';
require_once '../../Config/config.php';
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");

if(
    isset($_POST['discountPercentage']) &&
    isset($_POST['productId']) &&
    isset($_POST['validFrom']) &&
    isset($_POST['validUntil'])


)
{
    $productId = htmlentities($_POST['productId']);
    $discountPercentage = htmlentities($_POST['discountPercentage']);
    $validFrom = htmlentities($_POST['validFrom']);
    $validUntil = htmlentities($_POST['validUntil']);
    //Build the Json object
    $object = null;
    $object->productId = $productId;
    $object->validFrom = $validFrom;
    $object->validUntil = $validUntil;
    $object->percentage = $discountPercentage;
    $JSONData = json_encode($object);

    $webService = new CallWebService();
    $url = WEB_CONST_URL_PART . 'Discount/addDiscount.php';
    $response = $webService->doPost($url, $JSONData);
    echo $response;
}else
    echo json_encode(array("Message" => "Unspecified parameters"));
