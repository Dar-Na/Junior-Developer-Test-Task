<?php

namespace Core;

use Infrastructure\AbstractModel;

class FurnitureModel extends AbstractModel
{

    private $height;
    private $width;
    private $product_length;

    public function __construct()
    {
        $this->connect();
        $a = func_get_args();
        $i = func_num_args();
        if (method_exists($this,$f='__construct'.$i)) {
            call_user_func_array(array($this,$f),$a);
        }
    }

    public function __construct1($data) {
        $this->setSku($data['sku']);
        $this->setProductName($data['name']);
        $this->setPrice($data['price']);

        $this->setHeight(str_replace(',', '.', $data['height']));
        $this->setWidth(str_replace(',', '.', $data['width']));
        $this->setProductLength(str_replace(',', '.', $data['length']));
    }


    public function setHeight($height) {
        $this->height = $height;
    }

    public function getHeight() {
        return $this->height;
    }

    public function setWidth($width) {
        $this->width = $width;
    }

    public function getWidth() {
        return $this->width;
    }

    public function setProductLength($product_length) {
        $this->product_length = $product_length;
    }

    public function getProductLength() {
        return $this->product_length;
    }

    public function insertProduct()
    {
        if ($this->isExistTable('furniture')) {
            $sql = "INSERT INTO furniture (id, height, width, product_length) VALUES (NULL, ?, ?, ?);";
            $stmt = mysqli_prepare($this->db, $sql);
            $height = $this->getHeight();
            $width = $this->getWidth();
            $length = $this->getProductLength();
            $stmt->bind_param("ddd", $height, $width, $length);
            $stmt->execute();

            $sql = "SELECT MAX(id) FROM furniture";
            $result = mysqli_query($this->db, $sql);

            while ($row = $result->fetch_assoc()) {
                $maxId = (int)implode(", ", $row);
                echo $maxId;
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
                $sku = $this->getSku();
                $name = $this->getProductName();
                $price = $this->getPrice();
                $str = 'furniture';
                $varNUll = null;
                $stmt->bind_param("ssdsddd", $sku, $name, $price, $str, $varNUll, $varNUll, $maxId);
                $stmt->execute();
            }

            if(mysqli_stmt_errno($stmt) !== 0) {
                $error = mysqli_error($this->db);
                $this->db->query("DELETE FROM furniture WHERE furniture.id = " . $maxId . ";");
                echo $error;
            } else {
                Router::redirect('/');
            }
        }
    }

    public function deleteProduct($sku)
    {
        $sql = "SELECT all_products.id_furniture FROM all_products WHERE all_products.sku='" . $sku . "'";
        $result = mysqli_query($this->db, $sql);
        while ($row = $result->fetch_assoc()) {
            if (implode(", ", $row) !== null) {
                $id = implode(", ", $row);
                $this->db->query("DELETE FROM furniture WHERE furniture.id = '" . $id . "'");
                $this->db->query("DELETE FROM all_products WHERE all_products.sku='".$sku."'");
            }
        }
    }

    protected function createTable($table)
    {
        $sql = '';

        if ($table === "furniture") {
            $sql = $sql . "CREATE TABLE furniture (
                        id INT AUTO_INCREMENT NOT NULL,
                        height FLOAT NOT NULL,
                        width FLOAT NOT NULL,
                        product_length FLOAT NOT NULL,
                        PRIMARY KEY(id)
                            )";
        }

        if ($table === "all_products") {
            $sql = $sql . "CREATE TABLE all_products (
                        sku VARCHAR(64) PRIMARY KEY UNIQUE NOT NULL,
                        product_name VARCHAR(80) NOT NULL,
                        price FLOAT NOT NULL,
                        product_type VARCHAR(64) NOT NULL,
                        id_book INT REFERENCES book,
                        id_dvd INT REFERENCES dvd,
                        id_furniture INT REFERENCES furniture
                         )";
        }

        if ($this->db->query($sql) === true) {
            echo "Table " . $table . " created successfully \r\n";
            Router::redirect('/');
        } else {
            echo "Error creating table: " . $this->db->error . "\r\n";
        }
    }
}