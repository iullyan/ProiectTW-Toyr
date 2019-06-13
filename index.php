

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Toyr - Bine ați venit !</title>
    <link rel="stylesheet" type="text/css" href="View/css/mainCharacteristics.css">
    <link rel="stylesheet" type="text/css" href="View/css/category.css">
    <link rel="stylesheet" type="text/css" href="View/css/product.css">

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
                        <a href="View/html/login.html">Login</a>
                        <a href="View/html/register.html">Register</a>
                    </div>
                </li>
                <li>
                    <input type="button" class="orderButton" value="Coșul meu"
                           onclick="window.location.href='payment.html'"/>
                </li>

            </ul>
        </nav>
    </header>
    <div class="left">
        <div class="menu">
            <div id="categoriesTitle"> Produse</div>
            <div class="content">
                <ul>
                    <li>Jocuri și puzzle-uri</li>
                    <li>Educaționale</li>
                    <li>Figurine</li>
                    <li>Vehicule</li>
                    <li>Modele telghidate</li>
                    <li>Păpuși</li>
                    <li><a href="View/html/productList.html">Plușuri</a></li>
                    <li>Creativitate</li>
                    <li>Jucării din lemn</li>
                    <li>Exterior</li>
                    <li>Lego</li>
                    <li>Arme de jucărie</li>
                    <li>Hobby-uri și roleplay</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="middle" style="background-color:#bbb;">
        <!--<figure>
         <img src="slider/img1.jpg" alt="unable to load image">
         <img src="slider/img2.jpg" alt="unable to load image">
         <img src="slider/img2.jpg" alt="unable to load image">
       </figure> -->

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
            <div class="product">
                <div>

                </div>
                <div>
                    <a href="View/html/productList.html"><img class="product-image" src="tux.png" width="125" height="125"
                                                              alt="Product Image"></a>
                </div>
                <div>
                    <p class="product-name">Tuxy</p>
                </div>
                <div>
                    <p class="product-price">14.99 Lei</p>
                </div>
                <div>
                    <button type="submit" class="buy-button"> Cumpară</button>
                </div>
            </div>
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
<!--Testare baza de date -->

</body>

</html>