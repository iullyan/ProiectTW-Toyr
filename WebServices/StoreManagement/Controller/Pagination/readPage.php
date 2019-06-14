<?php
require '../../Model/ProductModel.php';
header('Content-Type: application/json; charset=UTF-8');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");



// initialize object
$product = new ProductModel();

//get sorting parameters
if (isset($_GET['categoryId']))
    $categoryId = htmlentities($_GET['categoryId']);
elseif (isset($_GET['eventId']))
    $evenId = htmlentities($_GET['eventId']);
    elseif (isset($_GET['promotionFlag']))
        $promotionFlag =htmlentities($_GET['promotionFlag']);


// query products

$productsData = $product->getProductsByCategory(3, 0 , 4);

echo json_encode($productsData);
