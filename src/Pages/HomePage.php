<?php

namespace Pages;

use Components\Card;
use Core\ControllerModel;


class HomePage {
    public static function view() {    ?>
        <div class="row row-cols-1 row-cols-md-3 g-4 mt-1 mx-5">
            <?php
                $result = (new ControllerModel()) -> getAll();

                while ($row = $result->fetch_assoc()) {
                    $card = new Card($row['product_type'], $row);
                    echo $card->view();
                }
            ?>
        </div>
        <?php
    }
}