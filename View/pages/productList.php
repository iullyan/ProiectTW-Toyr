<?php require_once '../../Config/config.php';
$urlBase = WEB_CONST_URL_PART;
if (isset($_GET['categoryId']))
    $categoryId = $_GET['categoryId'];
else
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


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>


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

</div>


<script type="text/javascript">

    var categoryid = "<?php echo $categoryId; ?>";
    var webUrl = "<?php echo $urlBase?>";
    var webConstUrl = "<?php echo $urlBase; ?>";
    var productPage = "<?php echo PRODUCT_PAGE?>";
    var imagesLocation = "<?php echo IMAGES_LOCATION ?>";
    var productsPerPage = "<?php echo RECORDS_PER_PAGE; ?>";
    var productListDispatcher = "<?php echo PRODUCT_LIST_DISPATCHER; ?>";
    var offset = 0;
    var working = false;

    $(document).ready(function () {
        $.ajax({
            type: "GET",
            processData: false,
            contentType: "application/json",
            data: '',
            url: productListDispatcher + "?categoryId=" + categoryid + '&offset=' + offset + '&recordsNr=' + productsPerPage,
            async: true,
            success: function (data) {

                $('.productsContainer').append(data.productList);
                offset = data.offset;
            },
            error: function () {
                alert("Error when getting product list")
            }
        });

    });
    $(window).scroll(function() {
        if ($(this).scrollTop() + 1 >= $('body').height() - $(window).height()) {
            if (working === false) {
                working = true;
                $.ajax({
                    type: "GET",
                    processData: false,
                    contentType: "application/json",
                    data: '',
                    url: productListDispatcher + "?categoryId=" + categoryid + '&offset=' + offset +'&recordsNr=' + productsPerPage,
                    async: true,
                    success: function (data) {
                        $('.productsContainer').append(data.productList);
                        offset = data.offset;
                        setTimeout(function() {
                            working = false;
                        }, 1000)

                    },
                    error: function () {
                        alert("Error when getting product list")
                    }
                });
            }
        }
    });







</script>


</body>

</html>
