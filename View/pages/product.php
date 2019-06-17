<!DOCTYPE html>
<html lang="ro">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" type="text/css" href="../css/mainCharacteristics.css">
        <link rel="stylesheet" type="text/css" href="../css/usableButton.css">
        <title>Toyr - Produs</title>
        <style>
        #container {
        overflow: hidden;
        width: 100%;
        }

        #inner {
        overflow: hidden;
        }

        .buton { /*Stilul butonului de la finalul paginii*/
            background-color: rgb(201, 0, 0);
            color: white;
            padding: 12px;
            margin: 1px 0;
            border: none;
            width: 20%;
            border-radius: 5px;
            cursor: pointer;
            font-size: 17px;
            float:right;
        }
        .buton:hover {
            background-color: rgb(156, 0, 0);
        }

        .image {
        width: 100%; /* Image container is now full-width */
            }

        .image img {
            margin: 40px auto; /* "auto" will center block elements */
            display: block; /* Set images to be "block" so they obey our auto margin */
            }
        </style>

    </head>


    <?php require_once '../../Config/config.php'; $productId = 5; $urlBase = WEB_CONST_URL_PART . 'Product/'; ?>
    <body onload="load('<?php echo $productId;?>', '<?php echo $urlBase; ?>')" >
            <header>
                <nav id="functionality">
                      <ul>
                        <li class="account">
                          <button class="usableButton">Categorii</button>
                          <div class="accountOptions" style="width: 175px; max-height: 315px; overflow:auto;">
                            <a href="" style="font-size: 13px" class="spacingDropdown; usableButton">Jocuri și puzzle-uri</a>
                            <a href="" style="font-size: 13px" class="spacingDropdown; usableButton">Educaționale</a>
                            <a href="" style="font-size: 13px" class="spacingDropdown; usableButton">Figurine</a>
                            <a href="" style="font-size: 13px" class="spacingDropdown; usableButton">Vehicule</a>
                            <a href="" style="font-size: 13px" class="spacingDropdown; usableButton">Modele telghidate</a>
                            <a href="" style="font-size: 13px" class="spacingDropdown; usableButton">Păpuși</a>
                            <a href="productList.html" style="font-size: 13px" class="spacingDropdown; usableButton">Plușuri</a>
                            <a href="" style="font-size: 13px" class="spacingDropdown; usableButton">Creativitate</a>
                            <a href="" style="font-size: 13px" class="spacingDropdown; usableButton">Jucării din lemn</a>
                            <a href="" style="font-size: 13px" class="spacingDropdown; usableButton">Exterior</a>
                            <a href="" style="font-size: 13px" class="spacingDropdown; usableButton">Lego</a>
                            <a href="" style="font-size: 13px" class="spacingDropdown; usableButton">Arme de jucărie</a>
                            <a href="" style="font-size: 13px" class="spacingDropdown; usableButton">Hobby-uri și roleplay</a>
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
                        <button type="submit" id="searchButton"> Caută </button>
                      </form>
                    </div>
                    <nav id="functionality">
                        <ul>
                          <li class="account">
                            <button class="usableButton">Contul meu</button>
                            <div class="accountOptions">
                              <a href="login.html" class="usableButton">Login</a>
                              <a href="register.html" class="usableButton">Register</a>
                            </div>
                          </li>
                          <li>
                            <input type="button" class="usableButton" value="Coșul meu" onclick="window.location.href='payment.html'" />

                          </li>

                        </ul>
                    </nav>
                </header>


                    <div id="demo" ></div>
            <script type="text/javascript" src="../js/product.js"> </script>
    </body>
</html>
