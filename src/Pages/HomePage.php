<?php

namespace Pages;

use Core\Model;


class HomePage {
    public static function view() {    ?>

        <input type="button" onclick="location.href='<?php echo SITE_URL; ?>/addproduct';" value="Go to Add Product page" />

        <?php

        echo 'HOME PAGE!';
        $result = (new Model()) ->getAll();

        while ($row = $result->fetch_assoc()) {
            echo $row['product_type'];
            echo implode(", ", $row) . "<br>";
        }
    }
}