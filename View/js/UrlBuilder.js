

    
    function getUrlByProductsOrder(productListDispatcher, orderBy, offset, recordsNr, categoryId=null){

        url = productListDispatcher + '?orderBy=' + orderBy + '&offset=' +offset + '&recordsNr=' + recordsNr;
        if(categoryId)
            url += '&categoryId=' + categoryId;

        return url;

    }

    function  getUrlByProductPriceInterval(productListDispatcher, priceLowerbound, priceUpperBound, offset, recordsNr, categoryId=null){

        url = productListDispatcher + '?priceLowerBound=' + priceLowerbound + '&priceUpperBound=' + priceUpperBound +
            '&offset=' +offset + '&recordsNr=' + recordsNr;
        if(categoryId)
            url += '&categoryId=' + categoryId;

        return url;
    }

    function getUrlByProductLowerBoundPrice(productListDispatcher, priceLowerbound, offset, recordsNr, categoryId=null)
    {
        url = productListDispatcher + '?priceLowerBound=' + priceLowerbound + '&offset=' +offset + '&recordsNr=' + recordsNr;
        if(categoryId)
            url += '&categoryId=' + categoryId;

        return url;
    }

    function getUrlByProductUpperBoundPrice(productListDispatcher, priceUpperbound, offset, recordsNr, categoryId=null)
    {
        url = productListDispatcher + '?priceUpperBound=' + priceUpperbound + '&offset=' + offset + '&recordsNr=' + recordsNr;
        if(categoryId)
            url += '&categoryId=' + categoryId;
        return url;
    }

    function  getUrlByAgeLowerBound(productListDispatcher, ageLowerBound, offset, recordsNr, categoryId=null){

        url = productListDispatcher + '?ageLowerBound=' + ageLowerBound +
            '&offset=' +offset + '&recordsNr=' + recordsNr;
        if(categoryId)
            url += '&categoryId=' + categoryId;

        return url;
    }

    function getUrlByProductCategoryId(productListDispatcher, categoryId, offset, recordsNr){

        return productListDispatcher + '?categoryId=' + categoryId + '&offset=' + offset + '&recordsNr=' + recordsNr;

    }

    function getUrlForCategories(webServiceUrl) {

        return webServiceUrl + "Category/getCategories.php";

    }

    function getUrlForSpecialEventProducts(productListDispatcher, eventId, offset, recordsNr) {
        return productListDispatcher + '?eventId=' + eventId + '&offset=' + offset + '&recordsNr=' + recordsNr;
    }

