function loadCategories() {

    $.ajax({

        type: "GET",
        url: document.categoriesUrl,
        data: 'json',
        dataType: "json",
        async: true,
        success: function (data) {

            var categoriesList = '<ul>';
            var singleCategory = '';
            var href = '';
            for (var i = 0; i < data.length; i++) {

                href =  document.productListPage + "?categoryId=" + data[i].id + "&categoryName=" + data[i].name;

                singleCategory = '<li><a href="' + href + '">' +data[i].name + '</a>' + '</li>';
                categoriesList += singleCategory;
            }
            categoriesList += '</ul>';
            $(".categoriesContent").html(categoriesList);
        },
        error: function () {
            console.log("Unable to fetch categories");
        }
    });
}






