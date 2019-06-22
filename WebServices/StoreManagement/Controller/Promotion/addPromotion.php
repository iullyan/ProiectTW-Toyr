<?php
require_once '../../Model/SpecialOffersModel.php';
header('Content-Type: application/json; charset=UTF-8');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");

$specialOffer = new SpecialOffersModel();
$specialOfferInformation = json_decode(file_get_contents("php://input"));

if (
    !empty($boughtProductId = $specialOfferInformation->boughtProductId) &&
    !empty($giftedProductId = $specialOfferInformation->giftedProductId) &&
    !empty($productUnitsBought = $specialOfferInformation->productUnitsBought) &&
    !empty($giftedProductQuantity = $specialOfferInformation->giftedProductQuantity) &&
    !empty($validFrom = $specialOfferInformation->validFrom) &&
    !empty($validUntil = $specialOfferInformation->validUntil)
) {
    if ($specialOffer->addPromotion(
        $boughtProductId,
        $giftedProductId,
        $productUnitsBought,
        $giftedProductQuantity,
        $validFrom, $validUntil )) {
        // set response code - 201 created
        http_response_code(201);

        // tell the user
        echo json_encode(array("message" => "Promotion was created."));
    } // if unable to create the product, tell the user
    else {

        // set response code - 503 service unavailable
        http_response_code(503);

        // tell the user
        echo json_encode(array("message" => "Unable to create promotion."));
    }
} // tell the user data is incomplete
else {

    // set response code - 400 bad request
    http_response_code(400);

    // tell the user
    echo json_encode(array("message" => "Unable to create promotion. Input data is incomplete."));
}