function discounts(out) {   //Calculeaza prețul în funcție de discount(dacă există)
    var date = new Date().toLocaleString("ro-RO", {timeZone: "Europe/Bucharest"});
    if (out.record.discount === false)
        return `${out.record.product.price}`;
    var valf = new Date(out.record.discount.valid_from); //ia datele din baza de date
    var valu = new Date(out.record.discount.valid_until);
    if (valf < date && date < valu)
        return `<strike style="font-size: 50%">${out.record.product.price} Lei</strike>${out.record.discount.price_with_discount}`;
    else
        return `${out.record.product.price}`;
}


async function promotions(out, webServiceUrl) {   //Verifică dacă nu există cumva o promotie
    var date = new Date();
    if (out.record.promotions === false) //verifica daca esixta promotii
        return ``;
    var aux = ``; // un aux de stocare
    result = out.record.promotions;

    for (i in result)//ne plimbam prin optiun
    {
        if (result.hasOwnProperty(i)) {

            aux = aux + `<p style=" margin-left: 2%">Cumpara ${result[i].product_units_bought} ${out.record.product.name} si vei primi cadou ${result[i].gifted_product_quantity} `;    //concatenam stringul

            let url2 = webServiceUrl + 'getProduct.php?productId=' + result[i].gifted_product_id; //cautam numele cadoului intrand pe pagina lui var response = await fetch(url);

            var response = await fetch(url2);
            var json = await response.json();

            aux +=`<a href=product.php?productId=${result[i].gifted_product_id} >${json.record.product.name}</a>`+ '</p>'; // concatenam si numele
        }
    }

    return aux;
}

function construction(out, webServiceUrl) {   //literalmente constructia paginii
    promotions(out, webServiceUrl).then(function(result){ document.getElementById("promotions").innerHTML= result;});
    return `<div class="middle" style="background-color:#bbb; margin-top: 2%; margin-left: 5%; margin-right: 5%;border-radius: 20px ;margin-bottom: 5%;">
                <div class="middle">
                    <div class="menu">
                        <span id="productTitle" style="margin-left:2%">
                            <h1 style="float:left; margin-left: 2%">${out.record.product.name}</h1>
                            <h1 style="float:right; margin-right: 2%">${discounts(out)} Lei</h1>
                        </span>
                        <div>
                            <div id="container">
                                <div id="inner">
                                        
                                        <input type="submit" value="Adăugați în coș" class="buton" style="float:right;margin-right: 2%">
                                        <img src="../../Resources/productImages/${out.record.product.image}.jpg" width="300" height="300" alt="" style="margin-left: 2%;margin-right: 2%;border-radius: 20px ;overflow: hidden;float: left;">

                                </div>
                            </div>
                        </div>
                
                   <p>  </p>
                <div id="promotions"> </div>
     
                <h2 style="margin: 1% 2%"> Descriere </h2>
                <p style="margin: 1% 2% 2% 2%"> ${out.record.product.description}</p>
                    </div>
                </div>
            </div>`;

}

function load(productId, webServiceUrl) {
    let url = webServiceUrl + 'getProduct.php?productId=' + productId; //de aici isi ia datele json
    fetch(url) //captam jsonul
        .then(res => res.json())
        .then((out) => {
            //Aici procesezi jsonul
            document.getElementById("demo").innerHTML = construction(out, webServiceUrl);
        })
        .catch(err => {
            throw err
        });

}
