var rssFeedUrl;



function getWebServiceUrl(data) {
    rssFeedUrl = data;


}

function fetchRssFeedUrl(type) {

    $.ajax({
        type: "GET",
        data: 'json',
        dataType: "json",
        url: '../../ProiectTW-Toyr/Controller/Utils/geRssUrl.php?type=' . type,
        async: false,
        success: function (data) {
            getWebServiceUrl(data);

        },
        error: function () {
            alert("Error when getting web service url")
        }
    });

}

//order by can be : new,promotion, sold
function loadRssFeed(orderBy) {

    var optionsArray = ['new', 'promotion', 'sold'];
    if (  optionsArray.includes(orderBy)) {
        fetchRssFeedUrl(orderBy);
        alert(orderBy);
    }
    else
        console.error("incorrect orderby");

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            processXML(this);
        }
    };
    xhttp.open("GET", rssFeedUrl  , true);
    xhttp.send();
}
function processXML(xml) {

    document.getElementsByClassName("productsContainer").innerHTML = "<p>hello bitches</p>";
}