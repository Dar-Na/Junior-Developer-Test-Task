<?php

require __DIR__ . '/autoloader.php';
//require('db_connection.php');

use Core\Router;
use Pages\HomePage;
use Pages\AddProduct;
use Components\Header;
use Components\Footer;

//$conn = OpenCon();
//
//echo "DB connect\n";
//
//CloseCon($conn);
//
//echo "DB connect\n";

$route = new Router();

Header::view();

$route->get('/', function () {
    HomePage::view();
});

$route->get('/addproduct', function () {
    AddProduct::view();
});

Footer::view();

?>

<input type="button" onclick="location.href='<?php echo SITE_URL; ?>/addproduct';" value="Go to Add Product page" />
