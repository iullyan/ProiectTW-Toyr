<?php require_once 'Config/config.php';
$urlBase = WEB_CONST_URL_PART ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Toyr - Bine ați venit !</title>
    <link rel="stylesheet" type="text/css" href="View/css/index.css">
    <link rel="stylesheet" type="text/css" href="View/css/categoryUI.css">
    <link rel="stylesheet" type="text/css" href="View/css/productUI.css">
    <link rel="stylesheet" type="text/css" href="View/css/usableButton.css">
    <link rel="stylesheet" type="text/css" href="View/css/productListContainer.css">
    <link rel="stylesheet" type="text/css" href="View/css/optionsGroup.css">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>


    <!-- <link rel="stylesheet" type="text/css" href="product.css"> Nu merge slideShow-ul-->

</head>

<body>


<div class="grid-container">
    <header>
        <div id="logo">
            <h1> Toyr.ro </h1>
        </div>
        <div id="searchContainer">
            <form action="Cautare.php">
                <input type="text" placeholder="Caută jucării..." name="productSearch">
                <button type="submit" id="searchButton"> Caută</button>
            </form>
        </div>
        <nav id="functionality">
            <ul>
                <li class="account">
                    <button class="usableButton">Contul meu</button>
                    <div class="accountOptions">
                        <a class="usableButton" href="View/pages/login.html">Login</a>
                        <a class="usableButton" href="View/pages/register.html">Register</a>
                        <a class="usableButton" href="View/pages/adminPage.php">admin</a>
                    </div>
                </li>
                <li>
                    <input type="button" class="usableButton" value="Coșul meu"
                           onclick="window.location.href='View/pages/payment.html'"/>
                </li>

            </ul>
        </nav>
    </header>

    <div class="left">

        <div class="usableButton"> Produse</div>
        <div class="categoriesContent">
        </div>

    </div>

    <div class="middle">
    </div>

    <section class="main">
        <nav class="optionsGroup">

            <button class="usableButton" onclick="loadRssFeed('new')">Produse noi</button>
            <button class="usableButton">Promoții</button>
            <button class="usableButton">Top vânzări</button>

        </nav>

        <div class="productsContainer">


        </div>

    </section>

    <footer>
        <div>
            <h1>Toyr.ro</h1>
        </div>
        <nav class="sitemap">
            <p style=" font-weight: bold;">Sitemap</p>
            <ul>
                <li>Acasă</li>
                <li>Promoții</li>
                <li>Informații utile</li>
            </ul>
        </nav>
        <nav class="utility">
            <p style=" font-weight: bold;">Util</p>
            <ul>
                <li>Cum cumpăr</li>
                <li>Livrare și plată</li>
                <li>Termeni și condiții</li>
            </ul>
        </nav>
    </footer>
</div>


<script type="text/javascript" src="View/jquery/category.js"></script>
<script type="text/javascript" src="View/js/showRssFeeds.js"></script>

</body>

</html>