<?php require_once 'Config/config.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr" xmlns="http://www.w3.org/1999/html">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Toyr - Bine ați venit !</title>
    <link rel="stylesheet" type="text/css" href="View/css/index.css">
    <link rel="stylesheet" type="text/css" href="View/css/headerElements.css">

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

    var id = "<?php if(isset($_SESSION['id'])) echo $_SESSION['id']; else echo -1;?>";

    if(id > -1) {
        var username = "<?php if(isset($_SESSION['username'])) echo $_SESSION['username']; else echo "NOT_SET"; ?>";
        var userType = "<?php if(isset($_SESSION['user_type'])) echo $_SESSION['user_type']; else echo "NOT_SET";  ?>";
        var firstname = "<?php if(isset($_SESSION['firstname'])) echo $_SESSION['firstname']; else echo "NOT_SET";  ?>";
    }

    window.onload = function () {

        loadCategories();
        loadRssFeed("new");

                var unregistered = document.getElementById("unregistered");
                var admin = document.getElementById("admin");
                var customer = document.getElementById("customer");
                var hello = document.getElementById("hello");

                if(id > -1) {
                    if(userType != "admin") admin.style.display = "none";;
                    unregistered.style.display = "none";
                    hello.innerHTML = "<center> Salut, " + firstname + "</center>";
                }
                    else {
                        admin.style.display = "none";
                        customer.style.display = "none";
                   }
    }
</script>


<div class="grid-container">
    <header>
        <div id="logo">
            <a href="index.php"><h1> Toyr.ro </h1></a>
        </div>
        <div id="banner">
            <img src="Resources/websiteImages/banner.png" style="width:400px; height:100px" alt="">
        </div>
        <nav id="functionality">
            <ul>
                <li class="account">
                    <button class="usableButton">Contul meu</button>
                    <div class="accountOptions">
                        <div id="hello"></div>
                        <div id="unregistered">
                            <a  href="View/pages/login.php">Login</a>
                            <a href="View/pages/register.php">Register</a>
                        </div>
                        <div id="admin">
                            <a  href="View/pages/adminPage.php">admin</a>
                        </div>
                        <div id="customer">
                            <a  href="View/pages/adminPage.php">my account</a>
                            <a  href="Controller/Dispatcher/logout.php">logout</a>
                        </div>
                    </div>
                </li>
                <li>
                    <input type="button" class="usableButton" value="Coșul meu"
                           onclick="window.location.href='View/pages/cart.php'"/>
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


