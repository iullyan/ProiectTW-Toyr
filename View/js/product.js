function discounts(out) {   //Calculeaza prețul în funcție de discount(dacă există)

if(out.record.discount)
        return `<strike style="font-size: 60%">${out.record.product.price} Lei</strike> (-${out.record.discount.discount_percentage}%)<br>${out.record.discount.price_with_discount} `;
    else
        return `${out.record.product.price}`;
}


async function promotions(out, webServiceUrl) {   //Verifică dacă nu există cumva o promotie
    var date = new Date();
    if (out.record.promotions === false) //verifica daca esixta promotii
        return ``;
    var aux = `<br><div style=" margin-left: 20%;"><h3>Cadouri</h3>`; // un aux de stocare
    result = out.record.promotions;

    for (i in result)//ne plimbam prin optiun
    {
        if (result.hasOwnProperty(i)) {

            aux = aux + `<p>Cumpara ${result[i].product_units_bought} ${out.record.product.name} si vei primi cadou ${result[i].gifted_product_quantity} `;    //concatenam stringul

            let url2 = webServiceUrl + 'getProduct.php?productId=' + result[i].gifted_product_id; //cautam numele cadoului intrand pe pagina lui var response = await fetch(url);

            var response = await fetch(url2);
            var json = await response.json();

            aux +=`<a style="text-decoration: none; " href=product.php?productId=${result[i].gifted_product_id} >${json.record.product.name}</a>`; // concatenam si numele
        }
    }
    aux += "</div>";

    return aux;
}



function construction(out, webServiceUrl) {   //literalmente constructia paginii
    promotions(out, webServiceUrl).then(function(result){ document.getElementById("promotions").innerHTML= result;});
    return `<div class="middle" style="background-color:white; margin-top: 2%; margin-left: 15%; margin-right: 15%;border-radius: 20px ;">
                <div class="middle">
                    <div class="menu">
                        <span id="productTitle" >
                            <h2 style="float:left; margin-left: 20%">${out.record.product.name}</h2><br><br>
                            <h4 style="float:left; margin-left: 20%">Cod Produs: ${out.record.product.id}</h4><br><br><br>
                            <h1 style="float:right; margin-right: 20%">${discounts(out)} Lei</h1>
                        </span>
                        <div>
                            <div id="container">
                                <div id="inner">
                                        
                                        <input style="margin-right: 20%" type="submit" value="Adăugați în coș" class="buton" style="float:right;margin-right: 2%">
                                        <img style=" float:left; margin-left: 20%" src="../../Resources/productImages/${out.record.product.image}" width="300" height="300" alt="" style="margin-left: 2%;margin-right: 2%;border-radius: 20px ;overflow: hidden;float: left;">

                                </div>
                            </div>
                        </div>
                
                   <p>  </p>
                <div id="promotions"> </div>
                <div style=" margin-left: 20%;  margin-right: 20%;">
                    <h3> Descriere </h3>
                    <p> ${out.record.product.description}</p>
                    
                    <h3> Vârsta recomandata : ${out.record.product.age_lower_bound} </h3>
                    
                    
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
