<?php
require_once '../../Config/config.php';
$validUntil = null;
$validFrom = null;
$name = null;
$eventId = null;
if (isset($_GET['id']) &&
    isset($_GET['name']) &&
    isset($_GET['validFrom']) &&
    isset($_GET['validUntil'])) {

    $validFrom = $_GET['validFrom'];
    $validUntil = $_GET['validUntil'];
    $name = $_GET['name'];
    $eventId = $_GET['id'];
} else
    die("No event specified");
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Toyr - Bine ați venit !</title>
    <link rel="stylesheet" type="text/css" href="../css/event.css">
    <link rel="stylesheet" type="text/css" href="../css/productUI.css">
    <link rel="stylesheet" type="text/css" href="../css/headerElements.css">

    <link rel="stylesheet" type="text/css" href="../css/usableButton.css">
    <link rel="stylesheet" type="text/css" href="../css/productListContainer.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script type="text/javascript" src="../jquery/productsList.js"></script>
    <script type="text/javascript" src="../js/UrlBuilder.js"></script>

    <script type="text/javascript">
        document.productListDispatcher = "<?php echo PRODUCT_LIST_DISPATCHER; ?>";
        document.eventId = "<?php echo $eventId; ?>";
        document.offset = 0;
        document.recordsNr = "<?php echo RECORDS_PER_PAGE ?>";
        document.working = false;
        document.webUrl = getUrlForSpecialEventProducts(document.productListDispatcher, document.eventId, document.offset, document.recordsNr);
    </script>

</head>

<body onload="loadProducts()">

<header>
    <h2 style="padding-right: 100px;"><a href="../../index.php"> Toyr </a></h2>
    <h2 style="padding-right: 100px;"><?php echo $name; ?></h2>
    <h4><?php echo $validFrom . "  -  " . $validUntil ?></h4>
</header>
<div class="grid-container">


    <section class="main">
        <div class="productsContainer"></div>
    </section>

</div>

</body>

</html>
