<?php require_once 'Config/config.php'; ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Toyr - Bine ați venit !</title>
    <link rel="stylesheet" type="text/css" href="View/css/index.css">
    <link rel="stylesheet" type="text/css" href="View/css/category.css">
    <link rel="stylesheet" type="text/css" href="View/css/productUI.css">
    <link rel="stylesheet" type="text/css" href="View/css/usableButton.css">
    <link rel="stylesheet" type="text/css" href="View/css/productListContainer.css">
    <link rel="stylesheet" type="text/css" href="View/css/optionsGroup.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script type="text/javascript" src="View/js/UrlBuilder.js"></script>
    <script type="text/javascript">
        document.productMngService = "<?php echo WEB_CONST_URL_PART; ?>";
        document.categoriesUrl = getUrlForCategories(document.productMngService);
        document.productListPage= "<?php echo PRODUCT_LIST_PAGE; ?>";


        document.rssFeedNewProducts = "<?php echo NEWEST_PRODUCTS; ?>";
        document.rssMostSoldProducts = "<?php echo MOST_SOLD_PRODUCTS; ?>";
        document.rssSpecialOffers = "<?php echo SPECIAL_OFFERS; ?>";
        document.imagesLocation = "<?php echo IMAGES_LOCATION; ?>";
        document.eventPage = "<?php echo EVENT_PAGE; ?>";
        document.eventWebServiceUrl = "<?php echo WEB_CONST_URL_PART . 'Event/getCurrentEvent.php'; ?>";
        document.eventsImages = "<?php echo FRONT_IMAGE ?>";
    </script>

    <script type="text/javascript" src="View/jquery/category.js"></script>
    <script type="text/javascript" src="View/jquery/showRssFeeds.js"></script>
    <script type="text/javascript" src="View/jquery/checkForEvent.js"></script>



</head>

<body>


<script type="text/javascript">
    window.onload = function () {

        loadCategories();
        loadRssFeed("new");

    }
</script>


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
                        <a class="usableButton" href="View/pages/login.php">Login</a>
                        <a class="usableButton" href="View/pages/register.php">Register</a>
                        <a class="usableButton" href="View/pages/adminPage.php">admin</a>
                    </div>
                </li>
                <li>
                    <input type="button" class="usableButton" value="Coșul meu"
                           onclick="window.location.href='View/pages/payment.php'"/>
                </li>

            </ul>
        </nav>
    </header>

    <div class="left">
        <div class="categoriesContent"></div>
    </div>

    <div class="middle"></div>

    <section class="main">
        <nav class="optionsGroup">
            <button class="usableButton" onclick="loadRssFeed('new')">Produse noi</button>
            <button class="usableButton" onclick="loadRssFeed('promotion')">Promoții</button>
            <button class="usableButton" onclick="loadRssFeed('sold')">Top vânzări</button>
        </nav>

        <div class="productsContainer"></div>
    </section>

</div>
</body>



</html>


