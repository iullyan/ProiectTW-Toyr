<?php
require_once '../../Config/config.php';
$orderByOptions = unserialize(PRODUCT_ORDERBY);

if (isset($_GET['orderBy'])) {
    if (in_array($_GET['orderBy'], $orderByOptions))
        $orderBy = $_GET['orderBy'];
    else
        $orderBy = false;
} else
    if (isset($_GET['categoryId']))
        $categoryId = $_GET['categoryId'];
    else
        $categoryId = false;

    if ($categoryId)
        die('No category specified');


    

?>