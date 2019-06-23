<?php
require_once '../../Model/SpecialOffersModel.php';
require_once '../../Model/ProductModel.php';
header('Content-Type: application/json; charset=UTF-8');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");

$specialOffer = new SpecialOffersModel();
$specialOfferInformation = json_decode(file_get_contents("php://input"));

if (
    !empty($productId = $specialOfferInformation->productId) &&
    !empty($discountPercentage = $specialOfferInformation->percentage) &&
    !empty($validFrom = $specialOfferInformation->validFrom) &&
    !empty($validUntil = $specialOfferInformation->validUntil)
) {
    if ($specialOffer->addProductDiscount($productId, $discountPercentage, $validFrom, $validUntil)) {
        // set response code - 201 created
        http_response_code(201);

        // tell the user
        echo json_encode(array("Message" => "Discount was created."));
    } // if unable to create the product, tell the user
    else {

        // set response code - 503 service unavailable
        http_response_code(503);

        // tell the user
        echo json_encode(array("Message" => "Unable to create discount."));
    }
} // tell the user data is incomplete
else {

    // set response code - 400 bad request
    http_response_code(400);

    // tell the user
    echo json_encode(array("Message" => "Unable to create discount. Input data is incomplete."));


}