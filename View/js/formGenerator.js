function addProductForm(dispatcherUrl) {
    var form = '<form method="post" action="' + dispatcherUrl + '">';
    var productName = '<label for="productName">Nume</label>' +
        '<input id="productName" type="text" name="productName" >';

    var price = '<label for="price">Preț</label>' +
        '<input id="price" type="text" name="price" >';

    var stoc = '<label for="stock">Stoc</label>' +
        '<input id="stock" type="text" name="productStock" >';

    var description = '<label for="productDescription">Descriere</label>' +
        '<textarea  id="productDescription" rows="4" cols="50" name="description" ></textarea>';

    var image = '<label for="productImage">Selectați o imagine</label>' +
        '<input  id="productImage" type="file"  name="productImage" alt="" >';
    var submit = '<button class="usableButton">Adaugă</button>';
    form += productName + description + price + stoc + image + submit + "</form>";
    document.getElementsByClassName("main")[0].innerHTML = form;
}


function deleteProduct(dispatcherUrl) {

    var form = '<form method="post" action="' + dispatcherUrl + '">';
    var product = '<label for="product">Id-ul sau numele produslui</label>' +
        '<input id="product" type="text" name="productId" >';

    var submit = '<button class="usableButton">Șterge</button>';
    form += product +  submit + "</form>";
    document.getElementsByClassName("main")[0].innerHTML = form;

}

function addDiscount(dispatcherUrl) {

    var form = '<form method="post" action="' + dispatcherUrl + '">';
    var product = '<label for="product">Id-ul sau numele produsului</label>' +
        '<input id="product" type="text" name="productId" >';

    var discountPercentage = '<label for="procent">Procentaj discount</label>' +
        '<input id="procent" type="text" name="discountPercentage" >';

    var validFrom = '<label for="validFrom">Data de inceput</label>' +
            '<input id="validFrom" type="datetime-local" name="validFrom">';

    var validUntil = '<label for="validUntil">Data de terminare</label>' +
        '<input id="validUntil" type="datetime-local" name="validUntil">';

    var submit = '<button class="usableButton">Adaugă</button>';
    form += product +  discountPercentage + validFrom + validUntil + submit + "</form>";
    document.getElementsByClassName("main")[0].innerHTML = form;
}


function deleteDiscount(dispatcherUrl) {

    var form = '<form method="post" action="' + dispatcherUrl + '">';
    var product = '<label for="product">Id-ul  produsului pentru care se dorește eliminat discount-ul</label>' +
        '<input id="product" type="text" name="productId" >';

    var submit = '<button class="usableButton">Șterge discount</button>';
    form += product  + submit + "</form>";
    document.getElementsByClassName("main")[0].innerHTML = form;
}

function  addPromotion(dispatcherUrl) {

    var form = '<form method="post" action="' + dispatcherUrl + '">';
    var product = '<label for="product">Id-ul produsului pentru promoție</label>' +
        '<input id="product" type="text" name="productId" >';

    var productUnitsBought = '<label for="productUnitsBought">Numărul de produse cumpărate</label>' +
        '<input id="productUnitsBought" type="text" name="productUnitsBought" >';

    var gift = '<label for="product">Id-ul sau numele produsului ofertit cadou</label>' +
        '<input id="product" type="text" name="productId" >';

    var giftQuantity = '<label for="giftedProductQuantity">Numărul de produse oferite cadou</label>' +
        '<input id="giftedProductQuantity" type="text" name="giftedProductQuantity" >';

    var validFrom = '<label for="validFrom">Data de inceput</label>' +
        '<input id="validFrom" type="datetime-local" name="validFrom">';

    var validUntil = '<label for="validUntil">Data de terminare</label>' +
        '<input id="validUntil" type="datetime-local" name="validUntil">';

    var submit = '<button class="usableButton">Adaugă promoție</button>';
    form += product + productUnitsBought + gift + giftQuantity + validFrom + validUntil + submit + "</form>";
    document.getElementsByClassName("main")[0].innerHTML = form;
}


function deletePromotion(dispatcherUrl) {

    var form = '<form method="post" action="' + dispatcherUrl + '">';
    var product = '<label for="product">Id-ul produsului pentru care se dorește eliminată promoția</label>' +
        '<input id="product" type="text" name="productId" >';

    var submit = '<button class="usableButton">Șterge promoție</button>';
    form += product  + submit + "</form>";
    document.getElementsByClassName("main")[0].innerHTML = form;
}


function addEvent(dispatcherUrl) {

    var form = '<form method="post" action="' + dispatcherUrl + '">';

    var event = '<label for="event">Numele evenimentului</label>' +
        '<input id="event" type="text" name="name" >';

    var validFrom = '<label for="validFrom">Data de inceput</label>' +
        '<input id="validFrom" type="datetime-local" name="startingDate">';

    var validUntil = '<label for="validUntil">Data de terminare</label>' +
        '<input id="validUntil" type="datetime-local" name="EndingDate">';

    var submit = '<button class="usableButton">Creeză eveniment </button>';
    form += event + validFrom + validUntil  + submit + "</form>";
    document.getElementsByClassName("main")[0].innerHTML = form;

}

function addProductToEvent(dispatcherUrl) {

    var form = '<form method="post" action="' + dispatcherUrl + '">';
    var product = '<label for="product">Id-ul produsului pentru care se dorește eliminată promoția</label>' +
        '<input id="product" type="text" name="productId" >';

    var event = '<label for="event">Id-ul evenimentului </label>' +
        '<input id="event" type="text" name="eventId" >';

    var submit = '<button class="usableButton">Adaugă la eveniment</button>';
    form += product + event   + submit + "</form>";
    document.getElementsByClassName("main")[0].innerHTML = form;
}


function deleteEvent(dispatcherUrl) {
    var form = '<form method="post" action="' + dispatcherUrl + '">';
    var event = '<label for="event">Id-ul evenimentului </label>' +
        '<input id="event" type="text" name="eventId" >';

    var submit = '<button class="usableButton">Șterge eveniment</button>';
    form +=  event   + submit + "</form>";
    document.getElementsByClassName("main")[0].innerHTML = form;
}
