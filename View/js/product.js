
let url = 'http://localhost/ProiectTW-Toyr/WebServices/StoreManagement/Controller/Product/getProduct.php?productId=6'; //de aici isi ia datele json

function discounts(out)
{   //Calculeaza prețul în funcție de discount(dacă există)
    var date = new Date(); 
    if(out.record.discount==false)
    return `${out.record.product.price}`;
    var valf = new Date(out.record.discount.valid_from); //ia datele din baza de date
    var valu = new Date(out.record.discount.valid_until);
    if(valf<date && date<valu)
    return `${out.record.product.price-out.record.product.price*out.record.product.discount_percentage/100}`;
    else
    return `${out.record.product.price}`;
}

function promotions(out)
{   //Verifică dacă nu există cumva o promotie
    var date = new Date(); 
    if(out.record.promotions==false) //verifica daca esixta promotii
    return ``;
    var aux=``; // un aux de stocare
    result=out.record.promotions;
    for (var key in result) //ne plimbam prin optiun
    {   
        if (result.hasOwnProperty(key))
        {
            var valf = new Date(result[key].valid_from);
            var valu = new Date(result[key].valid_until);
            if(valf<date && date<valu) //copmparam sa vedem daca ne incadram in data
             {   
                aux=aux + `<p style=" margin-left: 2%">Cumpara ${product_units_bought} ${out.record.product.name} si vei primi cadou ${gifted_product_quantity}`;    //concatenam stringul   
             
                let url2 = `http://localhost/ProiectTW-Toyr/WebServices/StoreManagement/Controller/Product/getProduct.php?productId=${out.record.promotions.gifted_product_id}`; //cautam numele cadoului intrand pe pagina lui
                    fetch(url2)
                    .then(res => res.json()) 
                    .then((out2) => {
                    aux= aux + ` ${out2.record.product.name}.</p>\n`; // concatenam si numele
                    })
                    .catch(err => { throw err });
             }
        }
    }
    return aux;
}

function construction(out)
{   //literalmente constructia pagini
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
                                        <span class="image">
                                                <img src="../../Resources/productImages/${out.record.product.image}.jpg" width="120" height="120" alt="" style="margin-left: 2%;margin-top: 0.8%;border-radius: 20px ;">
                                                <img src="../../Resources/productImages/${out.record.product.image}.jpg" width="120" height="120" alt="" style="margin-left: 2%;margin-bottom: 0.8%;border-radius: 20px ;">
                                        </span>
                                </div>
                            </div>
                        </div>
                
                   <p>  </p>
                
                ${promotions(out)}
                <h2 style="margin: 1% 2%"> Descriere </h2>
                <p style="margin: 1% 2% 2% 2%"> ${out.record.product.description}</p>
                    </div>
                </div>
            </div>`;
}

fetch(url) //captam jsonul
.then(res => res.json())
.then((out) => {
  //Aici procesezi jsonul
  var produs = out.record.product.description;
  document.getElementById("demo").innerHTML =  construction(out);
})
.catch(err => { throw err });