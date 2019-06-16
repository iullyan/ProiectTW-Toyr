<?php require_once 'Config/config.php'; $urlBase = WEB_CONST_URL_PART?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Toyr - Bine ați venit !</title>
    <link rel="stylesheet" type="text/css" href="View/css/mainCharacteristics.css">
    <link rel="stylesheet" type="text/css" href="View/css/category.css">
    <link rel="stylesheet" type="text/css" href="View/css/productUI.css">
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
                    <button class="accountButton">Contul meu</button>
                    <div class="accountOptions">
                        <a href="View/pages/login.html">Login</a>
                        <a href="View/pages/register.html">Register</a>
                        <a href="View/pages/adminPage.php">admin</a>
                    </div>
                </li>
                <li>
                    <input type="button" class="orderButton" value="Coșul meu"
                           onclick="window.location.href='View/pages/payment.html'"/>
                </li>

            </ul>
        </nav>
    </header>

    <div class="left">
        <div class="menu">
            <div id="categoriesTitle"> Produse</div>
            <div class="categoriesContent">
            </div>
        </div>
    </div>

    <section class="main">
        <nav class="showProducts">
            <ul>
                <li>Produse noi</li>
                <li>Promoții</li>
                <li>Top vânzări</li>
            </ul>
        </nav>

        <div class="productContainer">
            <?php for ($i = 1; $i <= 100; $i++)
            echo ('
            <div class="product-card">
                <div class="discount">-20%</div>
                <div class="gift">Cadou</div>
                <div class="product-tumb">
                    <img src="https://images-na.ssl-images-amazon.com/images/I/419ZC94QCFL.jpg" alt="">
                </div>

                <div class="product-details">
                    <h4><a href="">Hardcore Clone</a></h4>
                    <div class="product-bottom-details">
                        <div class="product-price"><small>960.99 Lei</small><br>23.99 Lei</div>
                        <p class="product-links">
                            <a href=""><i class="fa fa-shopping-cart"></i> Vezi detalii</a>
                        </p>
                    </div>

                </div>
            </div>'); ?>

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


<script type="text/javascript" src="View/jquery/category.js"> </script>



    </body>

</html>