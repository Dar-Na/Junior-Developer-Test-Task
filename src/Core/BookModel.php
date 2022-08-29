<?php

namespace Core;

use Infrastructure\AbstractModel;

class BookModel extends AbstractModel
{
    private $weight;

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

        $this->setPrice(str_replace(',', '.', $data['price']));
        $this->setWeight(str_replace(',', '.', $data['weight']));
    }

    public function setWeight($weight) {
        $this->weight = $weight;
    }

    public function getWeight() {
        return $this->weight;
    }

    public function insertProduct()
    {
        if ($this->isExistTable('book')) {
            $sql = "INSERT INTO book (id, weight) VALUES (NULL, ?);";
            $stmt = mysqli_prepare($this->db, $sql);
            $weight = $this->getWeight();
            $stmt->bind_param("d", $weight);
            $stmt->execute();

            $sql = "SELECT MAX(id) FROM book";
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
                $str = 'book';
                $varNUll = null;
                $stmt->bind_param("ssdsddd", $sku, $name, $price, $str, $maxId, $varNUll, $varNUll);
                $stmt->execute();
            }

            if(mysqli_stmt_errno($stmt) !== 0) {
                $error = mysqli_error($this->db);
                $this->db->query("DELETE FROM book WHERE book.id = " . $maxId . ";");
                echo $error;
            } else {
                Router::redirect('/');
            }
        }
    }

    protected function createTable($table)
    {
        $sql = '';

        if ($table === "book") {
            $sql = $sql . "CREATE TABLE book (
                        id INT AUTO_INCREMENT NOT NULL,
                        weight FLOAT NOT NULL,
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

    public function deleteProduct($sku)
    {
        $sql = "SELECT all_products.id_book FROM all_products WHERE all_products.sku='" . $sku . "'";
        $result = mysqli_query($this->db, $sql);
        while ($row = $result->fetch_assoc()) {
            if (implode(", ", $row) !== null) {
                $id = implode(", ", $row);
                $this->db->query("DELETE FROM book WHERE book.id = '" . $id . "'");
                $this->db->query("DELETE FROM all_products WHERE all_products.sku='".$sku."'");
            }
        }
    }
}