$(document).ready(function () {


    $.ajax({

        type: "GET",
        url:  document.eventWebServiceUrl,
        data: 'json',
        dataType: "json",
        async: false,
        success: function (data) {
                var href= 'href="' + document.eventPage + "?id=" + data.id +
                    "&name=" + data.name +
                    "&validFrom=" + data.starting_date +
                    "&validUntil=" + data.ending_date + '"';
                var imageSrc = 'src="' + document.eventsImages + data.image + '"';

                var image = '<img class="frontImage" ' + imageSrc + ' alt=" ">';
                var html = '<a ' + href + " > " + image + '</a>';
                 $('.middle').html(html);

        },
        error: function () {

            console.error("Problem when calling web service");

        }
    });
});