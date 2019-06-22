<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="../css/category.css">
    <link rel="stylesheet" type="text/css" href="../css/usableButton.css">
    <link rel="stylesheet" type="text/css" href="../css/adminPage.css">
    <link rel="stylesheet" type="text/css" href="../css/optionsPanel.css">


    <title>Toyr - Admin</title>

</head>


<body class="grid-container">
<header >
    <nav id="functionality">
        <ul>
            <li class="account">
                <button class="usableButton">Categorii</button>
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
                <button class="accountButton usableButton">Contul meu</button>
                <div class="accountOptions">
                    <a href="login.php">Login</a>
                    <a href="register.php">Register</a>
                </div>
            </li>
            <li>
                <input type="button" class="orderButton usableButton" value="Coșul meu"
                       onclick="window.location.href='payment.html'"/>

            </li>

        </ul>
    </nav>
</header>

<section class="left">
    <div class="optionsPanel">
        <button class="collapsible">Administrează produse</button>
        <div class="content">
            <div class="options">
                <button>Adaugă produs</button>
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
</section>
    <section class="main"></section>


    <script type="text/javascript" src="../js/collapsibleOptions.js"></script>

</body>
</html>