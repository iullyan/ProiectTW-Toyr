<?php
require '../../Model/Counter.php';
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");


$productOrderBy = unserialize(PRODUCT_ORDERBY);
$counter = new Counter();
$productData = false;

if (isset($_GET['categoryId'])) {
    $categoryId = $_GET['categoryId'];
    $productData = $counter->countByCategoryId($categoryId);
}else
    $productData = $counter->countAllProducts();


if ($productData) {

    // make it json format
    http_response_code(200);
    echo json_encode($productData, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
} else {
    // set response code - 404 Not found
    http_response_code(404);

    // tell the user product does not exist
    echo json_encode(array("Message" => "There are no products for the specified argument ."));
}
