<?php

require_once '../Utils/CallWebService.php';
require_once '../../Config/config.php';
require_once '../Utils/ImageUploader.php';
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");


$imageUploader = new ImageUploader();
if(
    isset($_POST['name']) &&
    isset($_POST['price']) &&
    isset($_POST['description']) &&
    isset($_POST['categoryId']) &&
    isset($_FILES['image']) &&
    isset($_POST['unitsInStock'])
)
{
    $name = htmlentities($_POST['name']);
    $price = htmlentities($_POST['price']);
    $description = htmlentities($_POST['description']);
    $categoryId = htmlentities($_POST['categoryId']);
    $imageName = htmlentities($_FILES['image']['name']);
    $unitsInStock = htmlentities($_POST['unitsInStock']);
    $minimumAge = htmlentities($_POST['minimumAge']);

    if ($message = $imageUploader->upload($_FILES['image'], PRODUCT_IMAGES_UPLOAD) === true) {
        //Build the Json object

        $object =  new stdClass();
        $object->name = $name;
        $object->price = $price;
        $object->description = $description;
        $object->categoryId = $categoryId;
        $object->image = $imageName;
        $object->unitsInStock = $unitsInStock;
        $object->minimumAge = $minimumAge;

        $JSONData = json_encode($object);

        $webService = new CallWebService();
        $url = WEB_CONST_URL_PART . 'Product/addProduct.php';
        $response = $webService->doPost($url, $JSONData);

        echo json_encode(array("Message" => $response));
    }
    else json_encode(array("Message" => $message));
}else
    echo json_encode(array("Message" => $name));






