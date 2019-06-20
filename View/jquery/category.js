

buildHTML = function (tag, html, attrs) {

    if (typeof html != 'string') {
        attrs = html;
        html = null
    }
    var h = '<' + tag;
    for (attr in attrs) {
        if (attrs[attr] === false) continue;
        h += ' ' + attr + '="' + attrs[attr] + '"';
    }
    return (h += html ? '>' + html + '</' + tag + '>' : '/>');
};


$(document).ready(function () {

    $.ajax({
        type: "GET",
        data: 'json',
        dataType: "json",
        url: '../../ProiectTW-Toyr/Controller/Utils/getWebServiceUrl.php',
        async: false,
        success: function (data) {
            WebServiceUrl = data;

        },
        error: function () {
            alert("Error when getting web service url")
        }
    });


    $.ajax({

        type: "GET",
        url: WebServiceUrl + "Category/getCategories.php",
        data: 'json',
        dataType: "json",
        async: false,
        success: function (data) {
            var categoriesList = '<ul>';
            var singleCategory = '';
            var href = '';
            for (var i = 0; i < data.length; i++) {
                href = buildHTML("a", data[i].name, {href: "View/pages/productList.php?categoryId=" + data[i].id + "&categoryName=" + data[i].name});
                singleCategory = buildHTML("li", href, {});
                categoriesList += singleCategory;
            }
            categoriesList += '</ul>';
            $(".categoriesContent").html(categoriesList);
            console.log(WebServiceUrl);

        }
    });
});





