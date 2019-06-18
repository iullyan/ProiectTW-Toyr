$(document).ready(function () {

    $.ajax({
        type: "GET",
        data: 'json',
        dataType: "json",
        url:  webConstUrl.webUrl + "getProducts?categoryId=" + categoryid,
        async: true,
        success: function (data) {
            var index;
            var records = data.records;
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
                html += link;
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

            $(".productsContainer").html(categoriesList);
        },
        error: function () {
            alert("Error when getting web service url")
        }
    });

});


