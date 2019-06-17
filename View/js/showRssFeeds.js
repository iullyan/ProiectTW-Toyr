var rssFeedUrl;



function getRssUrl(data) {
    rssFeedUrl = data;


}

function fetchRssFeedUrl(type) {

    $.ajax({
        type: "GET",
        data: 'json',
        dataType: "json",
        url: '../../ProiectTW-Toyr/Controller/Utils/getRssUrl.php?type=' + type,
        async: false,
        success: function (data) {
            getRssUrl(data);
            alert(data);

        },
        error: function () {
            alert("Error when getting rss url")
        }
    });

}

//order by can be : new,promotion, sold
function loadRssFeed(orderBy) {

    var optionsArray = ['new', 'promotion', 'sold'];
    if (  optionsArray.includes(orderBy)) {
        fetchRssFeedUrl(orderBy);
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