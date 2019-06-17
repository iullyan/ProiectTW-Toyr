<?php
require_once '../../Config/config.php';
require_once '../Utils/CallWebService.php';
require_once '../Utils/ProductsXML.php';

header('Content-Type: text/xml; charset=utf-8', true);

$webService = new CallWebService();
$offset = "offset=0";
$recordsNr = "recordsNr=" . RSS_FEED_NR_OF_PRODUCTS;
$orderBy = "orderBy=priceAsc";

$url = WEB_CONST_URL_PART . "Product/getProducts.php?" . $orderBy . '&' . $offset . '&'. $recordsNr;
$productsOnPromotion = $webService->doGet($url);

$xmlCreator = new ProductsXML();
$xml = $xmlCreator->getXml($productsOnPromotion);
echo $xml->saveXML();


?>