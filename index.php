<?php

require 'autoloader.php';

use Core\ControllerModel;
use Core\Router;
use Pages\HomePage;
use Pages\AddProduct;
use Components\Header;
use Components\Footer;

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

        $route->post('/addproduct', function ($data) {
            var_dump($data);
            $class = '\Core\\' . $data['productType'] . 'Model';
            $m = new $class($data);
            $m->insertProduct();
        });

        if (isset($_GET['arrayToDel'])) {
            $m = new ControllerModel();
            $m -> massDelete();
        }

        #FOOTER
        Footer::view();

        ?>
    </body>
</html>

