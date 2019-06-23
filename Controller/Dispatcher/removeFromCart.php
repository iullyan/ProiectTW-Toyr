<?php
session_start();

$productIds = array();
$productNames = array();
$productPrices = array();

//get the index of the item to be deleted
if (isset($_GET['itemId'])) $itemId = $_GET['itemId'];
else
    die("Unspecified parameters");

//get the arrays of items
if (isset($_COOKIE['cartIds']) && isset($_COOKIE['cartNames']) && isset($_COOKIE['productPrice'])) {
    $productIds = unserialize($_COOKIE['cartIds']);
    $productNames = unserialize($_COOKIE['cartNames']);
    $productPrices = unserialize($_COOKIE['productPrice']);
}

//remove from the arrays
unset($productIds[$itemId]);
unset($productNames[$itemId]);
unset($productPrices[$itemId]);

//add arrays back to cookies
setcookie("cartIds", serialize($productIds), time()+30*24*60*60, "/");
setcookie("cartNames", serialize($productNames), time()+30*24*60*60, "/");
setcookie("productPrice", serialize($productPrices), time()+30*24*60*60, "/");

//go back to the cart page
header('Location:../../View/pages/cart.php');
