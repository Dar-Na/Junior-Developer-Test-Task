<?php

namespace Core;

use Infrastructure\AbstractModel;

class ControllerModel extends AbstractModel
{

    protected function createTable($table) { }

    public function insertProduct() { }

    public function deleteProduct($sku) { }

    public function getAll() {
        $sql = "SELECT 
                all_products.sku, 
                all_products.product_name, 
                all_products.price, 
                all_products.product_type, 
                book.weight,
                dvd.product_size,
                furniture.height,
                furniture.width,
                furniture.product_length
                FROM all_products
                    LEFT JOIN book ON 
                        all_products.id_book = book.id
                    LEFT JOIN dvd ON 
                        all_products.id_dvd = dvd.id
                    LEFT JOIN furniture ON 
                        all_products.id_furniture = furniture.id
                ";

        return mysqli_query($this->db, $sql);
    }

    public function massDelete() {
        if ($_GET['arrayToDel']) {
            $arr = explode(",", array_pop($_GET));
            foreach ($arr as $data) {
                $type = array_values(explode(".", $data))[0];
                $sku = array_values(explode(".", $data))[1];
                $type = ucfirst($type);
                $class = '\Core\\' . $type . 'Model';
                $m = new $class();
                $m->deleteProduct($sku);
                Router::redirect('/');
            }
        } else {
            echo 'Please, checked products to delete';
        }

    }
}