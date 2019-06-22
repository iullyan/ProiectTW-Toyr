function send(dispatcherUrl) {


    $.ajax({

        type: "POST",
        contentType: "application/json",
        data: '',
        url: document.webUrl,
        async: true,
        success: function (data) {
            $('.productsContainer').html(data.productList);
            document.offset = data.offset;



        },
        error: function () {
            $('.productsContainer').html("No products found");

        }
    });

}