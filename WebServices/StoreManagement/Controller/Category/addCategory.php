<?php
require '../../Model/CategoryModel.php';
header('Content-Type: application/json; charset=UTF-8');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");

$category = new CategoryModel();
$categoryInformation = json_decode(file_get_contents("php://input"));

if (!empty($name = $categoryInformation->name))
{
    if ($category->addCategory($name))
    {
        // set response code - 201 created
        http_response_code(201);

        // tell the user
        echo json_encode(array("message" => "Category was created."));
    } // if unable to create the product, tell the user
    else {

        // set response code - 503 service unavailable
        http_response_code(503);

        // tell the user
        echo json_encode(array("message" => "Unable to create category."));
    }
} // tell the user data is incomplete
else {

    // set response code - 400 bad request
    http_response_code(400);

    // tell the user
    echo json_encode(array("message" => "Unable to create category. Input data is incomplete."));
}
