<?php
require_once '../../Config/config.php';
require_once '../Utils/CallWebService.php';
header('Content-Type: text/xml; charset=utf-8', true);
$xmlVersion = "1.0";
$xmlEncoding = "UTF-8";
$rssVersion = "2.0";
$link = "";
$title = "Newest toys";
$description = "Get the latest toys";
$language = "ro";
$lastBuildDate = time();

$webService = new CallWebService();
$orderBy = "orderBy=new&offset=0";
$url = WEB_CONST_URL_PART . "Product/getProducts.php?" . $orderBy;
$newestProductsList = $webService->doGet($url);

$xml = new DomDocument("1.0","UTF-8");
$xml->formatOutput = true;
$rss = $xml->createElement("rss");
$xml->appendChild($rss);
$link = $xml->createElement("link", $link);
$rss->appendChild($link);

$title = $xml->createElement("title", $title);
$rss->appendChild($title);

$description = $xml->createElement("description", $description);
$rss->appendChild($description);

$language = $xml->createElement("language", $language);
$rss->appendChild($language);

$lastBuildDate = $xml->createElement("lastBuildDate", $lastBuildDate);
$rss->appendChild($lastBuildDate);

if ( ! array_key_exists('Message', $newestProductsList)) {

    $records = $newestProductsList->records;
    foreach ($records as $product) {
        $item = $xml->createElement("item");
        $id = $xml->createElement("id", $product->product->id);
        $item->appendChild($id);

        $name = $xml->createElement("name");
        $name = $xml->createCDATASection($product->product->name);
        $item->appendChild($name);

        $description = $xml->createElement("description");
        $description = $xml->createCDATASection($product->product->description);
        $item->appendChild($description);

        $price = $xml->createElement("price", $product->product->price);
        $item->appendChild($price);


        $categoryId = $xml->createElement("categoryId", $product->product->category_id);
        $item->appendChild($categoryId);

        $nrSold = $xml->createElement("nrSold", $product->product->nr_sold);
        $item->appendChild($nrSold);

        $image = $xml->createElement("image");
        $image = $xml->createCDATASection($product->product->image);
        $item->appendChild($image);


        $unitsInStock = $xml->createElement("unitsInStock", $product->product->units_in_stock);
        $item->appendChild($unitsInStock);

        $createdAt = $xml->createElement("created_at");
        $createdAt = $xml->createCDATASection($product->product->created_at);
        $item->appendChild($createdAt);

        $rss->appendChild($item);

    }
}


$xml->save('E:\test.xml');
echo $xml->saveXML();
?>