<?php require_once '../../Config/config.php';
$urlBase = WEB_CONST_URL_PART;
if (isset($_GET['categoryId']))
    $categoryId = $_GET['categoryId'];
else
    die('Unspecified category id');
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


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>



    <!-- <link rel="stylesheet" type="text/css" href="product.css"> Nu merge slideShow-ul-->

</head>

<body >



<div class="grid-container">
    <header>
        
        <div id="logo">
            <a href="../../index.php"><h1> Toyr.ro </h1> </a>
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
        <div class="filter">
            <form action="/action_page.php" class="forms">
                <p style=" font-weight: bold;">Disponibilate</p>
                <input type="checkbox" name="stoc" value="Stoc">In stoc<br>
                <input type="checkbox" name="promotion" value="Promotii">Promotii<br>


                <p style=" font-weight: bold;">Varsta</p>
                <input type="checkbox" name="age1" value="">1+<br>
                <input type="checkbox" name="age2" value="">2+<br>
                <input type="checkbox" name="age3" value="">3+<br>
                <input type="checkbox" name="age4" value="">4+<br>
                <input type="checkbox" name="age5" value="">5+<br>
                <input type="checkbox" name="age6" value="">6+<br>
                <input type="checkbox" name="age7" value="">7+<br>

                <p style=" font-weight: bold;">price</p>
                <input type="checkbox" name="price1" value="">Sub 50<br>
                <input type="checkbox" name="price2" value="">100 - 200<br>
                <input type="checkbox" name="price3" value="">200 - 500<br>
                <input type="checkbox" name="price4" value="">500 - 1000<br>
                <input type="checkbox" name="price5" value="">Peste 1000<br>

                <input type="submit" value="Filtrează">
            </form>
        </div>



    </div>

    <div class="middle">
        <nav class="optionsGroup">

            <button class="usableButton">Categorii</button>
            <button class="usableButton">Ordonează după</button>


        </nav>

    </div>

    <section class="main">


        <div class="productsContainer"></div>

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


<script type="text/javascript" defer>

    var categoryid = "<?php echo $categoryId; ?>";
    var webUrl = "<?php echo $urlBase?>";
    var webConstUrl = "<?php echo $urlBase ?>";
    console.log(webConstUrl);
    var productPage = "<?php echo PRODUCT_PAGE?>";
    var imagesLocation  = "<?php echo IMAGES_LOCATION ?>";

    $(document).ready(function () {

        $.ajax({
            type: "GET",
            data: 'json',
            dataType: "json",
            url:  webConstUrl + "Product/getProducts.php?categoryId=" + categoryid + '&offset=0&recordsNr=5',
            async: true,
            success: function (data) {
                var index;
                var records = data.records;
                var productList = "";
                for(index = 0; index < records.length; index++)
                {
                    var html = '<div class="product-card">';
                    html += checkDiscount(records[index].discount.discount_percentage);
                    html += checkGift(records[index].promotions);
                    html += '<div class="product-tumb">';
                    html += createImageUrl(records[index].product.image);
                    html +=
                        '</div>' +
                        '<div class="product-details">' +
                        '<div class="product-name">' +
                        '<h4 ><a href="';
                    html += productPage + '?productId=' + records[index].product.id ;
                    html += '">' + records[index].product.name + '</a></h4></div>' +
                        '<div class="product-bottom-details">';
                    html += checkForNewPrice(records[index].discount.price_with_discount, records[index].product.price);
                    html += '<br><br>';
                    html += '<p class="product-links">' +
                        '<a href="';
                    html += productPage + '?productId' + records[index].product.id;
                    html += '" class="usableButton"><i class="fa fa-shopping-cart"></i> Vezi detalii</a>' + ' </p>' +
                        '</div>' +
                        '</div>' +
                        '</div>';

                    productList += html;

                }



                function checkDiscount(discount) {
                    if (discount)
                        return '<div class="discount">-' + discount + '%</div>';
                    else
                        return '<i hidden></i>';

                }

                function checkGift(giftFlag) {
                    if (giftFlag)
                        return '<div class="gift">Cadou</div>';
                    else
                        return '<i hidden></i>';
                }


                function checkForNewPrice(newPrice, basePrice) {
                    if (newPrice)
                        return '<div class="product-price"><small>' + newPrice + 'Lei</small><br>' + basePrice + ' Lei</div>';
                    else
                        return '<div class="product-price">' + basePrice + ' Lei</div>';
                }

                function createImageUrl(imageName) {

                    return '<img src="' +  imagesLocation + imageName + '.jpg"' + ' alt="">';
                }
                $(".productsContainer").html(productList);

            },
            error: function () {
                alert("Error when getting web service url")
            }
        });

    });


</script>


</body>

</html>
