

    
    function getUrlByProductsOrder(productListDispatcher, orderBy, offset, recordsNr, categoryId=null){

        url = productListDispatcher + '?orderBy=' + orderBy + '&offset=' +offset + '&recordsNr=' + recordsNr;
        if(! empty(categoryId))
            url += '&categoryId=' + categoryId;

        return url;

    }

    function  getUrlByProductPriceInterval(productListDispatcher, priceLowerbound, priceUpperBound, offset, recordsNr, categoryId=null){

        url = productListDispatcher + '?priceLowerBound=' + priceLowerbound + '&priceUpperBound=' + priceUpperBound +
            '&offset=' +offset + '&recordsNr=' + recordsNr;
        if(! isset(categoryId))
            url += '&categoryId=' + categoryId;

        return url;
    }


    function  getUrlByProductLowerBound(productListDispatcher, ageLowerBound, offset, recordsNr, categoryId=null){

        url = productListDispatcher + '?ageLowerBound=' + ageLowerBound +
            '&offset=' +offset + '&recordsNr=' + recordsNr;
        if(! isset(categoryId))
            url += '&categoryId=' + categoryId;

        return url;
    }

    function getUrlByProductCategoryId(productListDispatcher, categoryId, offset, recordsNr){

        return productListDispatcher + '?categoryId=' + categoryId + '&offset=' + offset + '&recordsNr=' + recordsNr;

    }

    function getUrlForCategories(webServiceUrl) {

        return webServiceUrl + "Category/getCategories.php";

    }

