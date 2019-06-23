<?php
require '../../Model/EventModel.php';
header('Content-Type: application/json; charset=UTF-8');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");

$event = new EventModel();
$eventInformation = json_decode(file_get_contents("php://input"));

if (
    !empty($eventId = $eventInformation->eventId) &&
    !empty($productId= $eventInformation->productId)
)
{
    if ($event->addProductToSpecialEvent($productId, $eventId))
    {
        // set response code - 201 created
        http_response_code(201);

        // tell the user
        echo json_encode(array("Message" => "Product was added to event."));
    } // if unable to create the product, tell the user
    else {

        // set response code - 503 service unavailable
        http_response_code(503);

        // tell the user
        echo json_encode(array("Message" => "Unable to add product to event."));
    }
} // tell the user data is incomplete
else {

    // set response code - 400 bad request
    http_response_code(400);

    // tell the user
    echo json_encode(array("Message" => "Unable to add product event. Input data is incomplete."));
}