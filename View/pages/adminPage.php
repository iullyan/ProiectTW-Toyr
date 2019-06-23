<?php require_once '../../Config/config.php';
session_start();?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">

    <link rel="stylesheet" type="text/css" href="../css/headerElements.css">
    <link rel="stylesheet" type="text/css" href="../css/usableButton.css">
    <link rel="stylesheet" type="text/css" href="../css/adminPage.css">
    <link rel="stylesheet" type="text/css" href="../css/optionsPanel.css">
    <link rel="stylesheet" type="text/css" href="../css/inputsAndTextAreas.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

    <script type="text/javascript" src="../js/formGenerator.js" async></script>
    <script type="text/javascript" src="../jquery/sendForm.js" async></script>



    <title>Toyr - Admin</title>

</head>


<body class="grid-container">

<script type="text/javascript">

    var id = "<?php if(isset($_SESSION['id'])) echo $_SESSION['id']; else echo -1;?>";

    if(id > -1) {
        var userType = "<?php if(isset($_SESSION['user_type'])) echo $_SESSION['user_type']; else echo 'NOT_SET';  ?>";
        var firstname = "<?php if(isset($_SESSION['firstname'])) echo $_SESSION['firstname']; else echo 'NOT_SET';  ?>";
    }

    window.onload = function () {

        var unregistered = document.getElementById("unregistered");
        var admin = document.getElementById("admin");
        var customer = document.getElementById("customer");
        var hello = document.getElementById("hello");

        if(id > -1) {
            unregistered.style.display = "none";
            hello.innerHTML = "<center> Salut, " + firstname + "</center>";
        }
        else {
            customer.style.display = "none";
        }
    }
</script>

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
                        <a  href="./login.php">Login</a>
                        <a href="./register.php">Register</a>
                    </div>
                    <div id="customer">
                        <a  href="./adminPage.php">my account</a>
                        <a  href="../../Controller/Dispatcher/logout.php">logout</a>
                    </div>
                </div>
            </li>
            <li>
                <input type="button" class="usableButton" value="Coșul meu"
                       onclick="window.location.href='./cart.php'"/>
            </li>

        </ul>
    </nav>
</header>
</header>

<section class="left">
    <div class="optionsPanel">
        <button class="collapsible">Administrează produse</button>
        <div class="content">
            <div class="options">
                <button onclick="addProductForm('<?php echo ADD_PRODUCT_DISPATCHER; ?>')">Adaugă produs</button>
                <button onclick="deleteProduct()">Șterge Produs</button>
            </div>

        </div>

        <button class="collapsible">Administrează categorii</button>
        <div class="content">
            <div class="options">
                <button onclick="addCategory('<?php echo ADD_CATEGORY_DISPATCHER; ?>')">Adaugă categorie</button>
            </div>

        </div>

        <button class="collapsible">Administrează oferte speciale</button>
        <div class="content">
            <div class="options">
                <button onclick="addDiscount('<?php echo ADD_DISCOUNT_DISPATCHER; ?>')">Adaugă discount</button>
                <button onclick="deleteDiscount()">ȘtergeDiscount</button>
                <button onclick="addPromotion('<?php echo ADD_PROMOTION_DISPATCHER; ?>')">Adaugă promoție</button>
                <button onclick="deletePromotion()">Șterge promoție</button>
            </div>


        </div>

        <button class="collapsible">Administrează evenimente</button>
        <div class="content">
            <div class="options">
                <button onclick="addEvent('<?php echo ADD_EVENT_DISPATCHER; ?>')">Creează eveniment</button>
                <button onclick="addProductToEvent('<?php echo ADD_PRODUCT_TO_EVENT_DISPATCHER; ?>')">Adaugă produse la eveniment</button>
                <button onclick="deleteEvent()">Șterge eveniment</button>
            </div>

        </div>

    </div>
</section>
    <section class="main"></section>


    <script type="text/javascript" src="../js/collapsibleOptions.js"></script>

</body>
</html>