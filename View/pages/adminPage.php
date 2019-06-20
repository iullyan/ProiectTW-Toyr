<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="../css/optionsPanel.css">
    <link rel="stylesheet" type="text/css" href="../css/index.css">


    <link rel="stylesheet" type="text/css" href="../css/adminPage.css">

    <title>Toyr - Admin</title>

</head>



<header>
    <nav id="functionality">
        <ul>
            <li class="account">
                <button class="accountButton">Categorii</button>
                <div class="accountOptions" style="width: 235px; max-height: 315px; overflow:auto;">
                    <a href="" style="font-size: 13px" class="spacingDropdown">Jocuri și puzzle-uri</a>
                    <a href="" style="font-size: 13px" class="spacingDropdown">Educaționale</a>
                    <a href="" style="font-size: 13px" class="spacingDropdown">Figurine</a>
                    <a href="" style="font-size: 13px" class="spacingDropdown">Vehicule</a>
                    <a href="" style="font-size: 13px" class="spacingDropdown">Modele telghidate</a>
                    <a href="" style="font-size: 13px" class="spacingDropdown">Păpuși</a>
                    <a href="productList.php" style="font-size: 13px" class="spacingDropdown">Plușuri</a>
                    <a href="" style="font-size: 13px" class="spacingDropdown">Creativitate</a>
                    <a href="" style="font-size: 13px" class="spacingDropdown">Jucării din lemn</a>
                    <a href="" style="font-size: 13px" class="spacingDropdown">Exterior</a>
                    <a href="" style="font-size: 13px" class="spacingDropdown">Lego</a>
                    <a href="" style="font-size: 13px" class="spacingDropdown">Arme de jucărie</a>
                    <a href="" style="font-size: 13px" class="spacingDropdown">Hobby-uri și roleplay</a>
                </div>
            </li>
        </ul>
    </nav>
    <div id="logo">
        <h1><a href="../../index.php" style="text-decoration: none; color: inherit;">Toyr.ro</a></h1>
    </div>
    <div id="searchContainer">
        <form action="Cautare.php">
            <input type="text" placeholder="Caută jucării..." name="searchBar" value="">
            <button type="submit" id="searchButton"> Caută</button>
        </form>
    </div>
    <nav id="functionality">
        <ul>
            <li class="account">
                <button class="accountButton">Contul meu</button>
                <div class="accountOptions">
                    <a href="login.php">Login</a>
                    <a href="register.php">Register</a>
                </div>
            </li>
            <li>
                <input type="button" class="orderButton" value="Coșul meu"
                       onclick="window.location.href='payment.html'"/>

            </li>

        </ul>
    </nav>
</header>

<section class="main" style=" background-color:  blueviolet; ">

    <div class="optionsPanel">
        <button class="collapsible">Administrează produse</button>
        <div class="content">
            <div class="options">
                <button>Adaugă produs </button>
                <button>Actualizează produs</button>
                <button>Șterge Produs</button>
            </div>

        </div>

        <button class="collapsible">Administrează oferte speciale</button>
        <div class="content">
            <div class="options">
                <button>Adaugă discount</button>
                <button>ȘtergeDiscount</button>
                <button>Adaugă promoție</button>
                <button>Șterge promoție</button>
            </div>


        </div>

        <button class="collapsible">Administrează evenimente</button>
        <div class="content">
            <div class="options">
                <button>Creează eveniment</button>
                <button>Adaugă produse la eveniment</button>
                <button>Șterge eveniment</button>
            </div>

        </div>

    </div>
    <div class="formContainer">
        ddddd
    </div>
</section>



<script type="text/javascript" src="../js/collapsibleOptions.js"></script>

</body>
</html>