<?php

$productIds = array();
$productNames = array();
$productPrices = array();

//get the name and id of the item added to cart
if (isset($_GET['productId']) && isset($_GET['productName']) && isset($_GET['productPrice'])) {
    $productId = $_GET['productId'];
    $productName = $_GET['productName'];
    $productPrice = $_GET['productPrice'];
}
else
    die("Unspecified parameters");

//if the cart has other items, get the arrays with the items
if (isset($_COOKIE['cartIds']) && isset($_COOKIE['cartNames']) && isset($_COOKIE['productPrice'])) {
    $productIds = unserialize($_COOKIE['cartIds']);
    $productNames = unserialize($_COOKIE['cartNames']);
    $productPrices = unserialize($_COOKIE['productPrice']);
}

//add the item's details to the arrays
array_push($productIds,$productId);
array_push($productNames, $productName);
array_push($productPrices, $productPrice);

//add arrays back to cookies - WIP
setcookie("cartIds", serialize($productIds), time()+30*24*60*60);
setcookie("cartNames", serialize($productNames), time()+30*24*60*60);
setcookie("productPrice", serialize($productPrices), time()+30*24*60*60);

//small test for data
print_r($productIds);
echo ' ';
print_r($productNames);
echo ' ';
print_r($productPrices);