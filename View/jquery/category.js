getWebServiceUrl = function ()
{

    var webServiceUrl;
    var response;
    return "http://localhost:9999/StoreManagement/Controller/";


};


buildHTML = function (tag, html,  attrs) {

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
            url: getWebServiceUrl() + "Category/getCategories.php",
            data: 'json',
            dataType: "json",
            success: function (data) {
               var categoriesList = '<ul>';
               var singleCategory = '';
               var href = '';
                for (var i = 0; i < data.length; i++) {
                    href = buildHTML("a", data[i].name, {href: "Controller/Dispatcher/showProducts.php?=${data[i].id}"}, {});
                    singleCategory = buildHTML("li", href, {});
                    categoriesList += singleCategory;
                }
                categoriesList += '</ul>';
                $(".categoriesContent").html(categoriesList);
            }
        });
    });





