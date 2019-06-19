<?php
require_once '../../Config/config.php';
require_once '../Utils/CallWebService.php';
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
function checkDiscount($discount)
{

    if ($discount)
        return ('<div class="discount">-' . $discount->discount_percentage . '%</div>');
    else
        return ('<i hidden></i>');

}

function checkGift($giftFlag)
{
    if ($giftFlag)
        return '<div class="gift">Cadou</div>';
    else
        return '<i hidden></i>';
}


function checkForNewPrice($discount, $product)
{
    if ($discount)
        return '<div class="product-price"><small>' . $discount->price_with_discount . 'Lei</small><br>' . $product->product->price . ' Lei</div>';
    else
        return '<div class="product-price">' . $product->product->price . ' Lei</div>';
}

function createImageUrl($imageName)
{

    return '<img src="' . IMAGES_LOCATION . $imageName . '.jpg"' . ' alt="">';

}

$orderByOptions = unserialize(PRODUCT_ORDERBY);

if (isset($_GET['offset']) && isset($_GET['recordsNr']))
{
    $offset = $_GET['offset'];
    $recordsNr = $_GET['recordsNr'];
}
else
    die("No offset or/and records number specified");

if (isset($_GET['orderBy'])) {
    if (in_array($_GET['orderBy'], $orderByOptions))
        $orderBy = $_GET['orderBy'];
    else
        $orderBy = false;
} else
    if (isset($_GET['categoryId']))
        $categoryId = $_GET['categoryId'];
    else
        $categoryId = NULL;



$webService = new CallWebService();
$offsetDatabase = "offset=" . $offset;
$recordsNrDatabase = "recordsNr=" . $recordsNr;
$categoryId = "categoryId=" . $categoryId;
$url = WEB_CONST_URL_PART . "Product/getProducts.php?" . $categoryId . '&' . $offsetDatabase. '&' . $recordsNrDatabase;
$JsonData = $webService->doGet($url);


$records = $JsonData->records;
$productList = "";

foreach ($records as $product) {
    $discountData = $product->discount;
    $promotionsList = $product->promotions;

    $html = '<div class="product-card">';
    $html .= checkDiscount($discountData);
    $html .= checkGift($promotionsList);
    $html .= '<div class="product-tumb">';
    $html .= createImageUrl($product->product->image);
    $html .= '</div>' .
        '<div class="product-details">' .
        '<div class="product-name">' .
        '<h4 ><a href="';
    $html .= PRODUCT_PAGE . '?productId=' . $product->product->id;
    $html .= '">' . $product->product->name . '</a></h4></div>' .
        '<div class="product-bottom-details">';
    $html .= checkForNewPrice($discountData, $product);
    $html .= '<br><br>';
    $html .= '<p class="product-links">' .
        '<a href="';
    $html .= PRODUCT_PAGE . '?productId=' . $product->product->id;
    $html .= '" class="usableButton"><i class="fa fa-shopping-cart"></i> Vezi detalii</a>' . ' </p>' .
        '</div>' .
        '</div>' .
        '</div>';
    $productList .= $html;

}

$offset = $offset + $recordsNr;
$result['productList'] = $productList;
$result['offset'] = $offset;

echo json_encode($result, JSON_HEX_QUOT | JSON_HEX_TAG);


?>