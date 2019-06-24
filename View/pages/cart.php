<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ro">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="../css/headerElements.css">
    <link rel="stylesheet" type="text/css" href="../css/productPage.css">

    <link rel="stylesheet" type="text/css" href="../css/usableButton.css">
    <title>Toyr - Cos</title>


</head>
<body>

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
                    <div id="admin">
                        <a  href="./adminPage.php">admin</a>
                    </div>
                    <div id="customer">
                        <a  href="./userPage.php">my account</a>
                        <a  href="../../Controller/Dispatcher/logout.php">logout</a>
                    </div>
                </div>
            </li>

        </ul>
    </nav>
</header>


<div class="middle" style="background-color:white; margin-top: 2%; margin-left: 15%; margin-right: 15%;border-radius: 20px ;">
    <table style="border: 0px; margin: auto; width: 60%;">
        <?php
            //if the cart has items, get the arrays with the items
            if (isset($_COOKIE['cartIds']) && isset($_COOKIE['cartNames']) && isset($_COOKIE['productPrice'])) {
                $productIds = unserialize($_COOKIE['cartIds']);
                $productNames = unserialize($_COOKIE['cartNames']);
                $productPrices = unserialize($_COOKIE['productPrice']);

                $subtotal = (float)0;

                for ($i = 0; $i <= array_key_last($productIds); $i++) {
                    if (isset($productIds[$i])) {
                        echo '<tr>';
                        echo '<td>';
                        echo $productNames[$i];
                        echo '</td>';
                        echo '<td>';
                        echo $productPrices[$i];
                        echo '</td>';
                        echo '<td>';
                        echo '<a href="../../Controller/Dispatcher/removeFromCart.php?itemId=' . $i . '">șterge</a>';
                        echo '</td>';
                        echo '</tr>';
                        $subtotal += (float)$productPrices[$i];
                    }
                }

                echo '<tr>';
                echo '<td>';
                echo '<hr>';
                echo '</td>';
                echo '<td>';
                echo '<hr>';
                echo '</td>';
                echo '</tr>';
                echo '<tr>';
                echo '<td>';
                echo 'SUBTOTAL';
                echo '</td>';
                echo '<td>';
                echo $subtotal;
                echo '</td>';
                if($subtotal > 0){
                    echo '<td>';
                    echo '<a href="./payment.php">Plaseaza comanda</a>';
                    echo '</td>';
                }
                echo '</tr>';
            }
        ?>
    </table>
</div>

</body>
</html>

