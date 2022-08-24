<?php

namespace Pages;

use Core\Model;


class HomePage {
    public static function view() {    ?>

        <input type="button" onclick="location.href='<?php echo SITE_URL; ?>/addproduct';" value="Go to Add Product page" />

        <?php

        echo 'HOME PAGE!';
        echo (new Model()) ->getAll();
    }
}