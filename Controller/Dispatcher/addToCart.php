<?php

$productIds = array();
$productNames = array();

//get the name and id of the item added to cart
if (isset($_POST['productId']) && isset($_POST['productName'])) {
    $productId = $_POST['productId'];
    $prodctName = $_POST['productName'];
}
else
    die("Unspecified parameters");

//if the cart has other items, get the arrays with the items
if (isset($_COOKIE['cartIds']) && isset($_COOKIE['cartNames'])) {
    $productIds = unserialize($_COOKIE['cartIds']);
    $productNames = unserialize($_COOKIE['cartNames']);
}

//add the item's details to the arrays
array_push($productNames, $prodctName);
array_push($productIds,$productId);

//add arrays back to cookies

print_r($productIds);
echo ' ';
print_r($productNames);