
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
            switch (document.flag) {
                case 0: calculateGeneralUrl(); break;
                case 1: calculateOrderByUrl(); break;
                case 2 : calculateByAgeBoundUrl(); break;
            }



        },
        error: function () {
            $('.productsContainer').html("No products found");

        }
    });

}
$(window).scroll(function () {
    if ($(window).scrollTop() === $(document).height() - $(window).height() ) {
        if (document.working === false  ) {
            document.working = true;
            $.ajax({
                type: "GET",
                contentType: "application/json",
                data: '',
                url: document.webUrl,
                async: true,
                success: function (data) {

                    document.offset = data.offset;
                    switch (document.flag) {
                        case 0: calculateGeneralUrl(); break;
                        case 1: calculateOrderByUrl(); break;
                        case 2 : calculateByAgeBoundUrl(); break;
                    }
                    $('.productsContainer').append(data.productList);

                    setTimeout(function () {
                        document.working=false;
                    }, 0.1)

                },
                error: function () {
                    document.working = true;
                }
            });
        }
    }
});