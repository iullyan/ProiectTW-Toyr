<?php
require '../../Model/ProductModel.php';
header('Content-Type: application/json; charset=UTF-8');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");

$product = new ProductModel();
$productInformation = json_decode(file_get_contents("php://input"));

if (
    !empty($name = $productInformation->name) &&
    !empty($price = $productInformation->price) &&
    !empty($description = $productInformation->description) &&
    !empty($categoryId = $productInformation->categoryId) &&
    !empty($image = $productInformation->image) &&
    !empty($unitsInStock = $productInformation->unitsInStock)
) {
    if ($product->addProduct($name, $categoryId, $description, $image, $price, $unitsInStock)) {
        // set response code - 201 created
        http_response_code(201);

        // tell the user
        echo json_encode(array("message" => "Product was created."));
    } // if unable to create the product, tell the user
    else {

        // set response code - 503 service unavailable
        http_response_code(503);

        // tell the user
        echo json_encode(array("message" => "Unable to create product."));
    }
} // tell the user data is incomplete
else {

    // set response code - 400 bad request
    http_response_code(400);

    // tell the user
    echo json_encode(array("message" => "Unable to create product. Data is incomplete."));
}

