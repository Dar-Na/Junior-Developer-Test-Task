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
<html lang="en">

    <body class="mt-4 border-0 bd-example m-5">

        <!-- BODY -->
        <?php

        #HEADER
        (new Components\Header)->view();

        $route = new Router();

        $route->get('/', function () {
            HomePage::view();
        });

        $route->get('/addproduct', function () {
            AddProduct::view();
        });

        $route->post('/addproduct', function ($data) {
            $class = '\Core\\' . $data['productType'] . 'Model';
            $m = new $class($data);
            $m->insertProduct();
        });

        if (isset($_GET['arrayToDel'])) {
            $m = new ControllerModel();
            $m -> massDelete();
        }

        #FOOTER
        (new Components\Footer)->view();

        ?>
    </body>
</html>
