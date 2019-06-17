var rssFeedUrl;
var imagesLocation;

function getRssUrl(data) {
    rssFeedUrl = data;

}

function getImagesLocation(data) {
    imagesLocation = data;

}

function fetchRssFeedUrl(type) {

    $.ajax({
        type: "GET",
        data: 'json',
        dataType: "json",
        url: '../../ProiectTW-Toyr/Controller/Utils/getRssUrl.php?type=' + type,
        async: false,
        success: function (data) {
            getRssUrl(data);
        },
        error: function () {
            alert("Error when getting rss url")
        }
    });

}


function fetchImagesLocation() {
    $.ajax({
        type: "GET",
        data: 'json',
        dataType: "json",
        url: '../../ProiectTW-Toyr/Controller/Utils/getImagesLocation.php?',
        async: false,
        success: function (data) {
            getImagesLocation(data);
        },
        error: function () {
            alert("Error when getting images url")
        }
    });
}

//order by can be : new,promotion, sold
function loadRssFeed(orderBy) {

    var optionsArray = ['new', 'promotion', 'sold'];
    if (optionsArray.includes(orderBy)) {
        {
            fetchRssFeedUrl(orderBy);
            fetchImagesLocation();
        }
    } else
        console.error("incorrect orderby");

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            processXML(this);
        }
    };
    xhttp.open("GET", rssFeedUrl, false);
    xhttp.send();
}


function processXML(xml) {


    var xmlDoc = xml.responseXML;
    var items = xmlDoc.getElementsByTagName('item');
    var discounts = xmlDoc.getElementsByTagName('discount');
    var promotions = xmlDoc.getElementsByTagName('promotion');
    var productList = "";
    for (var i = 0; i < items.length; i++) {

        var discountValue = 0;
        var basePrice = 0;
        var newPrice = 0;
        var giftFlag = false;
        var productName = '';
        var imgName = ' ';
        var link = " ";


        var item = items[i];


        productName = item.getElementsByTagName("name")[0].textContent;
        basePrice = item.getElementsByTagName("price")[0].textContent;
        imgName = item.getElementsByTagName("image")[0].textContent;
        link = item.getElementsByTagName("link")[0].textContent;

        var discountData = item.getElementsByTagName("discount")[0];
        if (discountData.textContent.localeCompare("false")) {
            discountValue = discountData.getElementsByTagName("discountPercentage")[0].textContent;
            newPrice = discountData.getElementsByTagName("priceWithDiscount")[0].textContent;
        }

        var promotionData = item.getElementsByTagName("promotions")[0];
        if (promotionData.textContent.localeCompare("false"))
            giftFlag = true;

        productList += buildHTML(productName, discountValue, basePrice, newPrice, giftFlag, imgName, link)

    }
    document.getElementsByClassName("productsContainer")[0].innerHTML = productList;


}


buildHTML = function buildHTML(name, discount, basePrice, newPrice, giftFlag, imgName, link) {
    var disco = "hello";
    var html = '<div class="product-card">';
    html += checkDiscount(discount);
    html += checkGift(giftFlag);
    html += '<div class="product-tumb">';
    html += createImageUrl(imgName);
    html +=
        '</div>' +
        '<div class="product-details">' +
         '<div class="product-name">' +
        '<h4 ><a href="';
    html += link;
    html +='">' + name + '</a></h4></div>' +
        '<div class="product-bottom-details">';
    html += checkForNewPrice(newPrice, basePrice);
    html += '<br><br>';
    html += '<p class="product-links">' +
        '<a href="';
    html += link;
    html += '" class="usableButton"><i class="fa fa-shopping-cart"></i> Vezi detalii</a>' + ' </p>' +
        '</div>' +
        '</div>' +
        '</div>';

    return html;
};


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


