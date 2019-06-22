$(document).ready(function() {
    $("#addProduct").submit(function (e) {

        console.log("hello");
        // get the form data
        // there are many ways to get this data using jQuery (you can use the class or id also)
        var url = $(this).attr("action");
        var formData = {
            'name': $('input[name=name]').val(),
            'categoryId': $('input[name=categoryId]').val(),
            'description': $('input[name=description]').val(),
            'unitsInStock': $('input[name=unitsInStock]').val(),
            'price': $('input[name=price]').val(),
            'image': $('input[name=image]').val()
        };

        // process the form
        $.ajax({
            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url: url, // the url where we want to POST
            data: formData, // our data object
            dataType: 'json', // what type of data do we expect back from the server
            encode: true
        })
        // using the done promise callback
            .done(function (data) {

                // log data to the console so we can see
                console.log(data);

                // here we will handle errors and validation messages
            });

        // stop the form from submitting the normal way and refreshing the page
        e.preventDefault();
    });

});