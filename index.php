<?php

require 'autoloader.php';
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
?>

<!DOCTYPE html>
<html>

    <body class="mt-4 border-0 bd-example m-5">

        <!-- BODY -->
        <?php

        #HEADER
        Header::view();

        $route = new Router();

        $route->get('/', function () {
            HomePage::view();
        });

        $route->get('/addproduct', function () {
            AddProduct::view();
        });

        #FOOTER
        Footer::view();

        ?>

    </body>
</html>

