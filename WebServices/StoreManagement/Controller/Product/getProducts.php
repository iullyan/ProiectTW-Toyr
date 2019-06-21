<?php
require '../../Model/ProductModel.php';
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");


$productOrderBy = unserialize(PRODUCT_ORDERBY);
$product = new ProductModel();
$productData = false;

    if (isset($_GET['categoryId']))
        $categoryId = $_GET['categoryId'];
    else
         $categoryId = NULL;

if (isset($_GET['offset']) && isset($_GET['recordsNr']))
{
    $offset = htmlentities($_GET['offset']);
    $recordsNr = htmlentities($_GET['recordsNr']);
   if (isset($_GET['eventId']))
    {
        $filterVariable = array('eventId' => htmlentities($_GET['eventId']));
        $productData = $product->getProducts($filterVariable, NULL, $offset, $recordsNr, $categoryId);
    } elseif (isset($_GET['ageLowerBound']))
    {
        $filterVariable = array('ageLowerBound' => htmlentities($_GET['ageLowerBound']));
        $productData = $product->getProducts($filterVariable, NULL, $offset, $recordsNr, $categoryId);

    } elseif (isset($_GET['priceLowerBound']) && (isset($_GET['priceUpperBound'])))
    {
        $priceLowerBound = htmlentities($_GET['priceLowerBound']);
        $priceUpperBound = htmlentities($_GET['priceUpperBound']);

        $filterVariable = array('priceLowerBound' => htmlentities($_GET['priceLowerBound']),
            'priceUpperBound' => htmlentities($_GET['priceUpperBound']));

        $productData = $product->getProducts($filterVariable, NULL, $offset, $recordsNr,$categoryId);

    } elseif (isset($_GET['priceLowerBound'])){
       $filterVariable = array('priceLowerBound' => htmlentities($_GET['priceLowerBound']));
       $productData = $product->getProducts($filterVariable, NULL, $offset, $recordsNr, $categoryId);
   }
   elseif (isset($_GET['priceUpperBound']))
    {
        $filterVariable = array('priceUpperBound' => htmlentities($_GET['priceUpperBound']));
        $productData = $product->getProducts($filterVariable, NULL, $offset, $recordsNr, $categoryId);

    } elseif (isset($_GET['orderBy'])) {
        $orderBy = $_GET['orderBy'];
        if (in_array($orderBy, $productOrderBy))
            $productData = $product->getProducts(NULL, $orderBy, $offset, $recordsNr, $categoryId);

    }elseif (isset($_GET['categoryId']))
   {
       $filterVariable = array('categoryId' => htmlentities($_GET['categoryId']));
       $productData = $product->getProducts(NULL, NULL, $offset, $recordsNr,$categoryId);

   }

}

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
