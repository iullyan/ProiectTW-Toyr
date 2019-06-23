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
    <link rel="stylesheet" type="text/css" href="../css/productUI.css">
    <link rel="stylesheet" type="text/css" href="../css/usableButton.css">
    <link rel="stylesheet" type="text/css" href="../css/productListContainer.css">
    <link rel="stylesheet" type="text/css" href="../css/optionsGroup.css">
    <link rel="stylesheet" type="text/css" href="../css/productList.css">
    <link rel="stylesheet" type="text/css" href="../css/filterOptions.css">
    <link rel="stylesheet" type="text/css" href="../css/dropDown.css">
    <link rel="stylesheet" type="text/css" href="../css/headerElements.css">


    <script type="text/javascript" src="../jquery/category.js"></script>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

    <script type="text/javascript" src="../js/UrlBuilder.js"></script>

    <script type="text/javascript">
        document.productMngService = "<?php echo WEB_CONST_URL_PART; ?>";
        document.categoriesUrl = getUrlForCategories(document.productMngService);
        document.productListPage= "<?php echo PRODUCT_LIST_PAGE; ?>";
        document.categoryid = "<?php echo $categoryId; ?>";
        document.productListDispatcher = "<?php echo PRODUCT_LIST_DISPATCHER; ?>";
        document.productPage = "<?php echo PRODUCT_PAGE?>";
        document.imagesLocation = "<?php echo IMAGES_LOCATION ?>";
        document.productsPerPage = "<?php echo RECORDS_PER_PAGE; ?>";
        document.productListDispatcher = "<?php echo PRODUCT_LIST_DISPATCHER; ?>";
        document.offset = 0;
        document.working = false;
        document.webUrl = "";
        document.flag = 0;
        document.orderBy = "";
        document.ageLowerBound="";

        function calculateGeneralUrl(){
            document.flag = 0;
            document.webUrl = getUrlByProductCategoryId(document.productListDispatcher,
                document.categoryid,
                document.offset,
                document.productsPerPage);
        }

        function calculateOrderByUrl() {
            document.flag = 1;
            document.webUrl = getUrlByProductsOrder(document.productListDispatcher,
                document.orderBy, document.offset,
                document.productsPerPage,
                document.categoryid);
        }

        function calculateByAgeBoundUrl() {
            document.flag = 2;
            document.webUrl = getUrlByAgeLowerBound(document.productListDispatcher, document.ageLowerBound,
                document.offset,
                document.productsPerPage,
                document.categoryid);
        }

    </script>
    <script type="text/javascript">
        function loadProductsByOrder(orderBy) {
            document.flag = 1;
            document.offset = 0;
            document.working = false;
            document.orderBy = orderBy;
            document.webUrl = getUrlByProductsOrder(document.productListDispatcher,
                orderBy, document.offset,
                document.productsPerPage,
                document.categoryid);
            loadProducts();
        }

        function loadByAge(age) {

            document.offset = 0;
            document.flag = 2;
            document.working = false;
            document.ageLowerBound = age;
            document.webUrl = getUrlByAgeLowerBound(document.productListDispatcher, age,
                document.offset,
                document.productsPerPage,
                document.categoryid);
            loadProducts();

        }


    </script>

    <script type="text/javascript">
        window.onload = function () {
            calculateGeneralUrl();
            loadProducts();
            clearItForm.reset();

            loadCategories();

        }
    </script>
    <script type="text/javascript" src="../jquery/productsList.js"></script>
</head>

<body>
<div class="grid-container">
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

    <div class="left">
        <div class="optionsPanel">
            <button class="collapsible ">Ordonează produsele</button>
            <div class="content">
                <div class="options">
                    <button onclick="loadProductsByOrder('new')">Noutăți</button>
                    <button onclick="loadProductsByOrder('nrSold')">Cele mai vândute</button>
                    <button onclick="loadProductsByOrder('priceAsc')">Preț ascendent</button>
                    <button onclick="loadProductsByOrder('priceDesc')">Preț descendent</button>
                    <button onclick="loadProductsByOrder('discount')">Cel mai mare discount</button>
                    <button onclick="loadProductsByOrder('promotion')">Promoții</button>
                    <button onclick="loadProductsByOrder('new')">În stoc</button>

                </div>
            </div>

            <button class="collapsible">Vârsta</button>
            <div class="content">
                <form name="clearItForm">
                    <div class="options">
                        <?php for ($i = 1; $i < 15; $i++)
                            echo '<label class="ageBoundsContainer">' . $i . '+' .
                                '<input type="radio"  name="age"  value="' . $i . '"' . ' onclick="loadByAge(this.value)"></label>'; ?>
                    </div>
                </form>
            </div>

            <button class="collapsible">Interval de preț</button>
            <div class="content">
                <div class="options">
                    <label for="priceLowerBound">Preț minim</label>
                    <input type="text" id="priceLowerBound" name="priceLowerBound" onkeyup="loadByPrice()"><br>
                    <label for="priceUpperBound">Preț maxim</label>
                    <input type="text" id="priceUpperBound" name="priceLowerBound" onkeyup="loadByPrice()">
                </div>
            </div>
        </div>
    </div>

    <div class="middle">
        <nav id="aboveOptions">
            <div class="dropdown">
                <button class="usableButton">Categorii</button>
                <div class="dropdown-content categoriesContent"></div>
            </div>
            <h4 id="currentCategory">Categoria Curentă : <?php echo $categoryName; ?> </h4>
        </nav>

    </div>

    <section class="main">
        <div class="productsContainer"></div>
    </section>

</div>

</body>
</html>
