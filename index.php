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
        (new Header)->view();

        $controller = new ControllerModel();

        $route = new Router();

        $route->get('/', function () {
            HomePage::view();
        });

        $route->get('/addproduct', function () {
            AddProduct::view();
        });

        $route->post('/addproduct', function ($data) use ($controller) {
            $class = '\Core\\' . $data['productType'] . 'Model';
            $m = new $class($data);
            $controller->insertProduct(
                    $data['productType'],
                    $m->getAllProperties(),
                    $m->getAllValues()
            );
        });

        $route->post('/validate', function ($data) use ($controller) {
            $res = $controller->isUniqueSku($data['sku']);
            echo json_encode(array("isExist" => $res));
        });

        if (isset($_GET['arrayToDel'])) {
            $controller -> massDelete();
        }

        #FOOTER
        (new Footer)->view();

        ?>
    </body>
</html>
