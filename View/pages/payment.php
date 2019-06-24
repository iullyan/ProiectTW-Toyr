<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" type="text/css" href="../css/payment.css">

        <title>Checkout</title>

    </head>

    <body>
        <div class="row" style="padding: 0 20px">
                <div class="menuContainer">
                        <div id="logo">
                            <h1><a href="../../index.php"> Toyr.ro </a></h1>
                              </div>
                </div>
        </div>

    <div class="row">
        <div class ="col-75">
            <div class="container">
                <form>
                    <div class="row">
                        <div class="col-50">
                            <h3>Adresa de Facturare</h3> <!--Aici ai prima parte a facturarii-->
                            <div class="row">
                                <div class="col-50">
                                    <label for="numeFormular">Nume</label>
                                    <input type="text" id="numeFormular" name="numeFormular" placeholder="Popescu">
                                </div>
                                <div class="col-50">
                                    <label for="prenumeFormular">Prenume</label>
                                    <input type="text" id="prenumeFormular" name="prenumeFormular" placeholder="Ion">
                                </div>
                            </div>
                            <label for="telefon">Telefon</label>
                            <input type="text" id="telefon" name="telefon" pattern="07[0-9]{8}" placeholder="0713446XXX">
                            <label for="adresa">Adresa Completă</label>
                            <input type="text" id="adresa" name="adresa" placeholder="Strada">
                            <label for="oras"> Oras</label>
                            <input type="text" id="oras" name="oras" placeholder="București">

                            <div class="row">
                                <div class="col-50">
                                    <label for="judet">Județ</label>
                                    <input type="text" id="judet" name="judet" placeholder="Ilfov">
                                </div>
                                <div class="col-50">
                                    <label for="codPostal">Cod Poștal</label>
                                    <input type="text" id="codPostal" name="codPostal" placeholder="10001">
                                </div>
                            </div>

                            <h3>Metodă de Plată</h3> <!--Aici a doua parte a facturarii-->
                            <label for="numeFormular">Carduri Acceptate</label>
                            <img src="../../Resources/websiteImages/payment.png" width="100" height="64" alt="">
                            <label for="numeCard" style="margin-top: 10px">Numele Titularului Cardului</label>
                            <input type="text" id="numeCard" name="numeCard" placeholder="Popescu P. Ion">
                            <label for="numarCard">Numărul Cardului de Credit</label>
                            <input type="text" id="numarCard" pattern="[0-9]{4}-[0-9]{4}-[0-9]{4}-[0-9]{4}" name="numarCard" placeholder="1111-2222-3333-4444">
                            <label for="lunaExpirare">Luna Expirării</label>
                            <input type="text" id="lunaExpirare" name="lunaExpirare" placeholder="Februarie">
                            <div class="row">
                                <div class="col-50">
                                    <label for="anExpirare">Anul Expirării</label>
                                    <input type="text" pattern="[0-9]{4}" id="anExpirare" name="anExpirare" placeholder="2020">
                                </div>
                                <div class="col-50">
                                    <label for="codSec">Codul CVV/CVC</label>
                                    <input type="text" id="codSec" pattern="[0-9]{3,4}" name="codSec" placeholder="000">
                                </div>
                            </div>
                        </div>

                    </div>
                    <label>  <!--Checkbox-ul de la finalul paginii-->
                        <input type="checkbox" checked="checked" name="aceeasiAdresa"> Aceeași adresă pentru facturare
                    </label> <!--Butonul de validare-->
                    <input type="submit" value="Finalizați Tranzacția" class="buton">
                </form>
            </div>
        </div>
        <div class="col-25"> <!--Fereastra cu produsele-->
                <div class="container">
                  <?php 
                    if (isset($_COOKIE['cartIds']) && isset($_COOKIE['cartNames']) && isset($_COOKIE['productPrice'])) {
                        $productIds = unserialize($_COOKIE['cartIds']);
                        $productNames = unserialize($_COOKIE['cartNames']);
                        $productPrices = unserialize($_COOKIE['productPrice']);
    
                        $subtotal = (float)0;
                        echo '<h4>Coș de Cumpărături <span class="price" style="color:black"> <b>';
                        echo sizeof($productIds);
                        echo '</b></span></h4>';

                        for ($i = 0; $i <= array_key_last($productIds); $i++) {
                            if (isset($productIds[$i])) {
                                echo '<p><a href="#">';
                                echo $productNames[$i];
                                echo '<span class="price">';
                                echo $productPrices[$i];
                                echo '</span></p>';
                                $subtotal += (float)$productPrices[$i];
                                }
                        }
                        echo '<hr>';

                echo '<p><a href="#">Total</a> <span class="price" style="color:black"><b>';
                echo $subtotal;
                echo '</b></span></p>';
            }
?>
                </div>
              </div>
    </div>


    </body>
</html>

