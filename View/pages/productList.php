<?php
require_once '../../Config/config.php';


if (isset($_GET['categoryId'])) {

    $categoryId = $_GET['categoryId'];
    $categoryName = $_GET['categoryName'];

} else
    die('Unspecified category id');
$recordsPerPage = RECORDS_PER_PAGE;

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Toyr - Bine ați venit !</title>
    <link rel="stylesheet" type="text/css" href="../css/category.css">
    <link rel="stylesheet" type="text/css" href="../css/productUI.css">
    <link rel="stylesheet" type="text/css" href="../css/usableButton.css">
    <link rel="stylesheet" type="text/css" href="../css/productListContainer.css">
    <link rel="stylesheet" type="text/css" href="../css/optionsGroup.css">
    <link rel="stylesheet" type="text/css" href="../css/productList.css">
    <link rel="stylesheet" type="text/css" href="../css/filterOptions.css">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

    <script type="text/javascript" src="../js/UrlBuilder.js"></script>

    <script type="text/javascript" >


        document.categoryid = "<?php echo $categoryId; ?>";
        document.productListDispatcher = "<?php echo PRODUCT_LIST_DISPATCHER; ?>";
        document.productPage = "<?php echo PRODUCT_PAGE?>";
        document.imagesLocation = "<?php echo IMAGES_LOCATION ?>";
        document.productsPerPage = "<?php echo RECORDS_PER_PAGE; ?>";
        document.productListDispatcher = "<?php echo PRODUCT_LIST_DISPATCHER; ?>";
        document.offset = 0;

        document.working = false;
        document.webUrl = getUrlByProductCategoryId(document.productListDispatcher, document.categoryid, document.offset, document.productsPerPage);


    </script>

    <script type="text/javascript" src="../jquery/productsList.js"></script>


    <!-- <link rel="stylesheet" type="text/css" href="product.css"> Nu merge slideShow-ul-->

</head>

<body>


<div class="grid-container">
    <header>

        <div id="logo">
            <a href="../../index.php"><h1> Toyr.ro </h1></a>
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
                           onclick="window.location.href='payment.php'"/>
                </li>

            </ul>
        </nav>
    </header>

    <div class="left">

        <div class="optionsPanel">
            <button class="collapsible ">Ordonează produsele</button>
            <div class="content">
                <div class="options">
                    <button onclick="loadNewProducts()">Noutăți</button>
                    <button>Cele mai vândute</button>
                    <button>Preț ascendent</button>
                    <button>Preț descendent</button>
                    <button>Cel mai mare discount</button>
                    <button>Promoții</button>
                    <button>În stoc</button>
                </div>

            </div>

            <button class="collapsible">Vârsta</button>
            <div class="content">
                <div class="options">
                    <?php for ($i = 1; $i < 15; $i++)
                        echo '<label class="ageBoundsContainer">' . $i . '+' .
                            '<input type="radio" checked="checked" name="radio">
                                     <span class="checkmark"></span>
                                </label>'; ?>
                </div>


            </div>

            <button class="collapsible">Interval de preț</button>
            <div class="content">
                <div class="options">
                    <label for="priceLowerBound">Preț minim</label>
                    <input type="text" id="priceLowerBound" name="priceLowerBound"><br>
                    <label for="priceUpperBound">Preț maxim</label>
                    <input type="text" id="priceUpperBound" name="priceLowerBound">
                </div>

            </div>

        </div>


    </div>

    <div class="middle">
        <nav id="aboveOptions">

            <button class="usableButton">Categorii</button>
            <h4 id="currentCategory">Categoria Curentă : <?php echo $categoryName; ?> </h4>


        </nav>

    </div>

    <section class="main">


        <div class="productsContainer"></div>

    </section>

</div>




</body>

</html>
