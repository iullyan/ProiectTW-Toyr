
function loadProducts() {


    $.ajax({

        type: "GET",
        contentType: "application/json",
        data: '',
        url: document.webUrl,
        async: true,
        success: function (data) {

            $('.productsContainer').html(data.productList);
            document.offset = data.offset;


        },
        error: function () {

        }
    });

}
$(window).scroll(function () {
    if ($(this).scrollTop() + 1 >= $('body').height() - $(window).height()) {
        if (document.working === false && ! document.offset <= document.productsPerPage ) {
            document.working = true;
            $.ajax({
                type: "GET",
                contentType: "application/json",
                data: '',
                url: document.webUrl,
                async: true,
                success: function (data) {
                    $('.productsContainer').append(data.productList);
                    document.offset = data.offset;
                    setTimeout(function () {
                        document.working = false;
                    }, 4000)

                },
                error: function () {

                }
            });
        }
    }
});