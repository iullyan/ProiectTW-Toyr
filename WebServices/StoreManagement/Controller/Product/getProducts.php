<?php
require '../../Model/ProductModel.php';
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");


$productOrderBy = unserialize(PRODUCT_ORDERBY);
$product = new ProductModel();

if (isset($_GET['offset']))
{
    $offset = htmlentities($_GET['offset']);
    if (isset($_GET['categoryId']))
    {
        $filterVariable = array('categoryId' => htmlentities($_GET['categoryId']));
        $productData = $product->getProducts($filterVariable, NULL, $offset, RECORDS_PER_PAGE);

    } elseif (isset($_GET['eventId']))
    {
        $filterVariable = array('eventId' => htmlentities($_GET['eventId']));
        $productData = $product->getProducts($filterVariable, NULL, $offset, RECORDS_PER_PAGE);
    } elseif (isset($_GET['ageLowerBound']))
    {
        $filterVariable = array('ageLowerBound' => htmlentities($_GET['ageLowerBound']));
        $productData = $product->getProducts($filterVariable, NULL, $offset, RECORDS_PER_PAGE);

    } elseif (isset($_GET['priceLowerBound']) && (isset($_GET['priceUpperBound'])))
    {
        $priceLowerBound = htmlentities($_GET['priceLowerBound']);
        $priceUpperBound = htmlentities($_GET['priceUpperBound']);

        $filterVariable = array('priceLowerBound' => htmlentities($_GET['priceLowerBound']),
            'priceUpperBound' => htmlentities($_GET['priceUpperBound']));

        $productData = $product->getProducts($filterVariable, NULL, $offset, RECORDS_PER_PAGE);

    } elseif (isset($_GET['priceLowerThan']))
    {
        $filterVariable = array('priceLowerThan' => htmlentities($_GET['priceLowerThan']));
        $productData = $product->getProducts($filterVariable, NULL, $offset, RECORDS_PER_PAGE);

    } elseif (isset($_GET['orderBy'])) {
        $orderBy = $_GET['orderBy'];
        if (in_array($orderBy, $productOrderBy))
            $productData = $product->getProducts(NULL, $orderBy, $offset, RECORDS_PER_PAGE);

    } else
        die("Incorrect parameters");
}


if ($productData) {

    // make it json format
    http_response_code(200);
    echo json_encode($productData, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
} else {
    // set response code - 404 Not found
    http_response_code(404);

    // tell the user product does not exist
    echo json_encode(array("errMessage" => "There are no products for the specified argument ."));
}
