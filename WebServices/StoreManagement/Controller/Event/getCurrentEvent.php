<?php

require '../../Model/EventModel.php';

header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");

$event = new EventModel();
$eventData= $event->getCurrentEventDetails();

if ($eventData) {

    // make it json format
    http_response_code(200);
    echo json_encode( $eventData, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
}
else {
    // set response code - 404 Not found
    http_response_code(404);

    // tell the user product does not exist
    echo json_encode(array("message" => "No current event found"));
}
