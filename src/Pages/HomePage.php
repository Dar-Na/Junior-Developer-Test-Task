<?php

namespace Pages;

use Components\Card;
use Core\Model;


class HomePage {

/*<input type="button" onclick="location.href='<?php echo SITE_URL; ?>/addproduct';" value="Go to Add Product page" />*/

    public static function view() {    ?>
        <div class="row row-cols-1 row-cols-md-3 g-4 mt-1">
            <?php

            $result = (new Model()) ->getAll();

            while ($row = $result->fetch_assoc()) {
                $card = new Card($row['product_type'], $row);
                echo $card->view();
            }

            ?>
        </div>
        <?php
    }
}