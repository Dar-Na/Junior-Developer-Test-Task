<?php

namespace Core;

use Infrastructure\AbstractController;

class ControllerModel extends AbstractController
{
    public function isUniqueSku($sku) {
        $sql = "SELECT all_products.product_name FROM all_products WHERE all_products.sku='" . $sku . "';";

        if ($res = $this->db->query($sql)) {
            if ($res->num_rows !== 1) {
                return false;
            } else {
                return true;
            }
        }

        return false;
    }

    public function insertProduct($type, $propertiesArr, $valuesArr) {
        //$propertiesArr - fields name for TYPE table
        //$valuesArr[0] - values for TYPE table
        //$valuesArr[1] - values for all_products table
        $type = lcfirst($type);
        if ($this->isExistTable($type)) {
            $sql = "INSERT INTO " . $type . " ( ";
            foreach ($propertiesArr as $property) {
                $sql = $sql . $property . ", ";
            }
            $sql = rtrim($sql, ", ") . " ) VALUES ( ";
            foreach ($valuesArr[0] as $value) {
                if ($value === NULL) {
                    $sql = $sql . "NULL, ";
                } else {
                    $sql = $sql . "'" . $value . "', ";
                }

            }
            $sql = rtrim($sql, ", ") . ");";
            var_dump($sql);

            $this->db->query($sql);

            $sql = "SELECT MAX(id) FROM " . $type;
            $result = mysqli_query($this->db, $sql);

            while ($row = $result->fetch_assoc()) {
                $maxId = (int)implode(", ", $row);
                $sql = "INSERT INTO `all_products` 
                            (`sku`, 
                             `product_name`, 
                             `price`, 
                             `product_type`, 
                             `id_book`, 
                             `id_dvd`, 
                             `id_furniture`) 
                        VALUES ( ?, ?, ?, ?, ?, ?, ?);";
                $stmt = mysqli_prepare($this->db, $sql);
                $id_book = $valuesArr[1][3];
                $id_dvd = $valuesArr[1][4];
                $id_furniture = $valuesArr[1][5];

                if ($type === "book")
                {
                    $id_book = $maxId;
                }
                if ($type === 'dvd')
                {
                    $id_dvd = $maxId;
                }
                if ($type === 'furniture')
                {
                    $id_furniture = $maxId;
                }

                $stmt->bind_param(
                    "ssdsddd",
                    $valuesArr[1][0], //sku
                    $valuesArr[1][1],  //product_name
                    $valuesArr[1][2],       //price
                    $type,                  //type
                    $id_book,               //id_book
                    $id_dvd,                //id_dvd
                    $id_furniture           //id_furniture
                );
                $stmt->execute();
            }

            if(mysqli_stmt_errno($stmt) !== 0) {
                $error = mysqli_error($this->db);
                $this->db->query("DELETE FROM " . $type  . " WHERE " . $type . ".id = " . $maxId . ";");
                echo $error;
            } else {
                Router::redirect('/');
            }
        }
    }

    public function deleteProduct($type, $sku) {
        $sql = "SELECT all_products.id_" . $type . " FROM all_products WHERE all_products.sku='" . $sku . "'";
        $result = mysqli_query($this->db, $sql);
        while ($row = $result->fetch_assoc()) {
            if (implode(", ", $row) !== null) {
                $id = implode(", ", $row);
                $this->db->query("DELETE FROM " . $type . " WHERE " . $type . ".id = '" . $id . "'");
                $this->db->query("DELETE FROM all_products WHERE all_products.sku='".$sku."'");
            }
        }
    }

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
                $this->deleteProduct($type, $sku);
                Router::redirect('/');
            }
        } else {
            echo 'Please, checked products to delete';
        }

    }
}