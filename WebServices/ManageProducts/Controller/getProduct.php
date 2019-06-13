<?php
require '../Model/ProductModel.php';
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");




$product = new ProductModel();
$productId = isset($_GET['productId']) ? $_GET['productId'] : die();

$productData = $product->getProduct($productId);
$result ['product'] = array();
$result ['discount'] = array();
$result ['promotions'] = array();

if ($productData) {
    array_push($result['product'], $productData );
    if ($productPromotions = $product->getProductPromotion($productId)) {
        array_push($result['promotions'], $productPromotions);
        if ($productDiscount = $product->getProductDiscount($productId))
            array_push($result['discount'], $productDiscount);


    }
    // make it json format
    http_response_code(200);
    echo json_encode( $result, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
}
else {
    // set response code - 404 Not found
    http_response_code(404);

    // tell the user product does not exist
    echo json_encode(array("message" => "Product does not exist."));

}

