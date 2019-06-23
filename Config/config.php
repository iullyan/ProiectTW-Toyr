<?php
//Application APP_PORT
define('APP_PORT', 9999);

//Web store management service url
define('WEB_STORE_MANAGEMENT_PORT', 9999);
define('WEB_CONST_URL_PART', 'http://localhost:'. WEB_STORE_MANAGEMENT_PORT .'/ProiectTW-Toyr/WebServices/StoreManagement/Controller/');

//Web users management url
define('WEB_USERS_MANAGEMENT_PORT', 9999);
define('WEB_CONST_URL_PART_USERS', 'http://localhost:'. WEB_USERS_MANAGEMENT_PORT.'/ProiectTW-Toyr/WebServices/UsersManagement/Controller/User/');

//Number of products for RSS feeds
define('RSS_FEED_NR_OF_PRODUCTS', 100);
define('RECORDS_PER_PAGE', 6);

//Product page
define('PRODUCT_PAGE', 'http://localhost:'. APP_PORT .'/ProiectTW-Toyr/View/pages/product.php');

//RSS links

define('NEWEST_PRODUCTS', 'http://localhost:'.APP_PORT.'/ProiectTW-Toyr/Controller/RSSfeeds/NewestProducts.php');
define('MOST_SOLD_PRODUCTS', 'http://localhost:'.APP_PORT.'/ProiectTW-Toyr/Controller/RSSfeeds/MostSoldProducts.php');
define('SPECIAL_OFFERS', 'http://localhost:'.APP_PORT.'/ProiectTW-Toyr/Controller/RSSfeeds/SpecialOffers.php');

//Images
define('FRONT_IMAGE', 'http://localhost:'.APP_PORT.'/ProiectTW-Toyr/Resources/eventsImages/');
define('PRODUCT_IMAGES_UPLOAD', $_SERVER['DOCUMENT_ROOT'] . '/ProiectTW-Toyr/Resources/productImages/');
define('IMAGES_LOCATION', 'http://localhost:'.APP_PORT.'/ProiectTW-Toyr/Resources//productImages/');

//Order products
define ("PRODUCT_ORDERBY", serialize (array ('discount', 'nrSold', 'priceAsc', 'priceDesc', 'new', 'promotion')));




//Pages url

define("PAGES_URL", 'http://localhost:'. APP_PORT .'/ProiectTW-Toyr/View/pages/');

//Index
define("INDEX_URL", 'http://localhost:'. APP_PORT .'/ProiectTW-Toyr/index.php');

//Login and register URL

define("LOGIN_PAGE", 'http://localhost:'. APP_PORT .'/ProiectTW-Toyr/View/pages/login.php');
define("REGISTER_PAGE", 'http://localhost:'. APP_PORT .'/ProiectTW-Toyr/View/pages/register.php');

//Event page
define("EVENT_PAGE", 'http://localhost:'. APP_PORT .'/ProiectTW-Toyr/View/pages/event.php');

//ProductList page URL

define("PRODUCT_LIST_PAGE", 'http://localhost:'. APP_PORT .'/ProiectTW-Toyr/View/pages/productList.php');


//Dispatchers
define('ADD_PRODUCT_DISPATCHER', 'http://localhost:'. APP_PORT .'/ProiectTW-Toyr/Controller/Dispatcher/addProduct.php');
define('ADD_DISCOUNT_DISPATCHER', 'http://localhost:'. APP_PORT .'/ProiectTW-Toyr/Controller/Dispatcher/addDiscount.php');
define('ADD_PRODUCT_TO_EVENT_DISPATCHER', 'http://localhost:'. APP_PORT .'/ProiectTW-Toyr/Controller/Dispatcher/addProductToEvent.php');
define('ADD_PROMOTION_DISPATCHER', 'http://localhost:'. APP_PORT .'/ProiectTW-Toyr/Controller/Dispatcher/addPromotion.php');
define('ADD_EVENT_DISPATCHER', 'http://localhost:'. APP_PORT .'/ProiectTW-Toyr/Controller/Dispatcher/addEvent.php');




define("PRODUCT_LIST_DISPATCHER", 'http://localhost:'. APP_PORT .'/ProiectTW-Toyr/Controller/Dispatcher/showProducts.php');