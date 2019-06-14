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
    !empty($name = $eventInformation->name) &&
    !empty($startingDate = $eventInformation->startingDate) &&
    !empty($endingDate = $eventInformation->endingDate)
)
{
    if ($event->addSpecialEvent($name, $startingDate, $endingDate ))
    {
        // set response code - 201 created
        http_response_code(201);

        // tell the user
        echo json_encode(array("message" => "Event was created."));
    } // if unable to create the product, tell the user
    else {

        // set response code - 503 service unavailable
        http_response_code(503);

        // tell the user
        echo json_encode(array("message" => "Unable to create event."));
    }
} // tell the user data is incomplete
else {

    // set response code - 400 bad request
    http_response_code(400);

    // tell the user
    echo json_encode(array("message" => "Unable to create event. Input data is incomplete."));
}