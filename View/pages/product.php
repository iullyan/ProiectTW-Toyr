<!DOCTYPE html>
<html lang="ro">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="../css/headerElements.css">
    <link rel="stylesheet" type="text/css" href="../css/productPage.css">

    <link rel="stylesheet" type="text/css" href="../css/usableButton.css">
    <title>Toyr - Produs</title>


</head>

<?php
require_once '../../Config/config.php';
$productId = $_GET['productId'];
$urlBase = WEB_CONST_URL_PART . 'Product/';
?>
<body onload="load('<?php echo $productId; ?>', '<?php echo $urlBase; ?>')">
<header>
    <div id="logo">
        <a href="../../index.php"><h1> Toyr.ro </h1></a>
    </div>
    <div id="banner">
        <img src="../../Resources/websiteImages/banner.png" style="width:400px; height:100px" alt="">
    </div>
    <nav id="functionality">
        <ul>
            <li class="account">
                <button class="usableButton">Contul meu</button>
                <div class="accountOptions">
                    <div id="hello"></div>
                    <div id="unregistered">
                        <a class="usableButton" href="View/pages/login.php">Login</a>
                        <a class="usableButton" href="View/pages/register.php">Register</a>
                    </div>
                    <div id="admin">
                        <a class="usableButton" href="View/pages/adminPage.php">admin</a>
                    </div>
                    <div id="customer">
                        <a class="usableButton" href="View/pages/adminPage.php">my account</a>
                        <a class="usableButton" href="View/pages/adminPage.php">logout</a>
                    </div>
                </div>
            </li>
            <li>
                <input type="button" class="usableButton" value="Coșul meu"
                       onclick="window.location.href='View/pages/payment.php'"/>
            </li>

        </ul>
    </nav>
</header>


<div id="demo"></div>
<script type="text/javascript" src="../js/product.js"></script>
</body>
</html>
