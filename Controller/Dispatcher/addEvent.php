<?php

require_once '../Utils/CallWebService.php';
require_once '../../Config/config.php';
require_once '../Utils/ImageUploader.php';

$imageUploader = new ImageUploader();
$operationMessage = "";
if (
    !empty($_POST['name']) &&
    !empty($_POST['startingDate']) &&
    !empty($_POST['endingDate']) &&
    !empty($_FILES['image'])

) {
    $name = htmlentities($_POST['name']);
    $startingDate = htmlentities($_POST['startingDate']);
    $endingDate = htmlentities($_POST['endingDate']);
    $imageName = htmlentities($_FILES['image']['name']);

    if ($message = $imageUploader->upload($_FILES['image'], FRONT_IMAGE) === true) {
        //Build the Json object
        $object = new stdClass();
        $object->name = $name;
        $object->startingDate = $startingDate;
        $object->endingDate = $endingDate;
        $object->image = $imageName;
        $JSONData = json_encode($object);
        $webService = new CallWebService();
        $url = WEB_CONST_URL_PART . 'Event/createEvent.php';
        $response = $webService->doPost($url, $JSONData);
        $operationMessage = $response->Message;

    } else
        $operationMessage = "There is a problem with your uploaded file";
} else
    $operationMessage = 'Unable to create promotion. Input data is incomplete';
echo '<p style="text-align:center;font-size: 25px;" class="centered">Mesajul operației: ' . $operationMessage . ' </p>';

