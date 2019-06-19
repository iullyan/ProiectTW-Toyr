<?php
//Database configuration
define('DB_HOST', 'localhost:3306');
define('DB_NAME', 'toyr');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8');

//Pagination configuration
define('RECORDS_PER_PAGE', 10);

//Filters for products
define ("PRODUCT_ORDERBY", serialize (array ('discount', 'nrSold', 'priceAsc', 'priceDesc', 'new', 'promotion')));
?>


