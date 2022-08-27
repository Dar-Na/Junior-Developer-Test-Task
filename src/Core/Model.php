<?php

namespace Core;

include_once "consts.php";

class Model {

    private $db;

    public function __construct() {
        $this->db = new \mysqli(
            DB_HOST,
            DB_USER,
            DB_PASSWORD,
            DB_NAME
        );

        mysqli_report(MYSQLI_REPORT_OFF);
        # id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        # sku VARCHAR(64) NOT NULL UNIQUE,
        # product_name VARCHAR(80) NOT NULL,
        # price NOT NULL FLOAT
        #
        # types DVD                                     Book                            Furniture
        #       product_size (MB) NOT NULL FLOAT        weight (KG) NOT NULL FLOAT      height  (CM)  NOT NULL  FLOAT
        #                                                                               width   (CM)  NOT NULL  FLOAT
        #                                                                               length  (CM)  NOT NULL  FLOAT

        $this->isExistTable("all_products");
        $this->isExistTable("dvd");
        $this->isExistTable("book");
        $this->isExistTable("furniture");

//        $this->insertProduct('Jhasdo1', 'furniture for all', 214, 'furniture', null, null, 13, 42, 52);
//        $this->insertProduct('JO12354', "good book", 423, 'book', 423);
    }

    private function createTable($table) {
        $sql = "";
        if ($table === "dvd") {
            $sql = $sql . "CREATE TABLE dvd (
                        id INT AUTO_INCREMENT NOT NULL,
                        product_size FLOAT NOT NULL,
                        PRIMARY KEY(id)
                            )";
        }

        if ($table === "book") {
            $sql = $sql . "CREATE TABLE book (
                        id INT AUTO_INCREMENT NOT NULL,
                        weight FLOAT NOT NULL,
                        PRIMARY KEY(id)
                            )";
        }

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
                        id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
                        sku VARCHAR(64) UNIQUE NOT NULL,
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
        } else {
            echo "Error creating table: " . $this->db->error . "\r\n";
        }
    }

    private function isExistTable($table) {
        if ($res = $this->db->query("SHOW TABLES LIKE '" . $table . "'")) {
            if ($res->num_rows !== 1) {
                $this->createTable($table);
            }
        }
    }

    public function insertProduct(
        $sku,
        $product_name,
        $price,
        $product_type,
        $weight = null,
        $product_size = null,
        $height = null,
        $width = null,
        $product_length = null
    ) {
        $sql = "";
        $maxId = 0;
        if ($product_type === 'book') {
            $sql = "INSERT INTO book (weight) VALUES(" . $weight . ")";
            if ($this->db->query($sql) === true && $sql !== "" ) {
                $sql = "SELECT MAX(id) FROM book";
                $result = mysqli_query($this->db, $sql);
                while ($row = $result->fetch_assoc()) {
                    $maxId = (int)implode(", ", $row);
                    $sql = "INSERT INTO `all_products`
                            (`id`,
                             `sku`,
                             `product_name`,
                             `price`,
                             `product_type`,
                             `id_book`,
                             `id_dvd`,
                             `id_furniture`)
                        VALUES (NULL, '"
                                . $sku . "', '"
                                . $product_name. "', '"
                                . $price . "', '"
                                . $product_type . "', '"
                                . (int)implode(", ", $row)
                                . "', NULL, NULL);";
                }
            }
        }
        if ($product_type === 'dvd') {
            $sql = "INSERT INTO dvd (product_size) VALUES(" . $product_size . ")";
            if ($this->db->query($sql) === true && $sql !== "" ) {
                $sql = "SELECT MAX(id) FROM dvd";
                $result = mysqli_query($this->db, $sql);
                while ($row = $result->fetch_assoc()) {
                    $maxId = (int)implode(", ", $row);
                    $sql = "INSERT INTO `all_products` 
                            (`id`, 
                             `sku`, 
                             `product_name`, 
                             `price`, 
                             `product_type`, 
                             `id_book`, 
                             `id_dvd`, 
                             `id_furniture`) 
                        VALUES (NULL, '"
                                . $sku . "', '"
                                . $product_name. "', '"
                                . $price . "', '"
                                . $product_type . "', "
                                . "NULL, '"
                                . (int)implode(", ", $row)
                                . "', NULL);";
                }
            }
        }
        if ($product_type === 'furniture') {
            $sql = "INSERT INTO furniture 
                        (height, 
                         width, 
                         product_length) 
                    VALUES (". $height . ", "
                        . $width .", "
                        . $product_length .")";
            if ($this->db->query($sql) === true && $sql !== "" ) {
                $sql = "SELECT MAX(id) FROM furniture";
                $result = mysqli_query($this->db, $sql);
                while ($row = $result->fetch_assoc()) {
                    $maxId = (int)implode(", ", $row);
                    $sql = "INSERT INTO `all_products` 
                            (`id`, 
                             `sku`, 
                             `product_name`, 
                             `price`, 
                             `product_type`, 
                             `id_book`, 
                             `id_dvd`, 
                             `id_furniture`) 
                        VALUES (NULL, '"
                                . $sku . "', '"
                                . $product_name. "', '"
                                . $price . "', '"
                                . $product_type . "', "
                                . "NULL, NULL,'"
                                . (int)implode(", ", $row)
                                . "');";
                }
            }
        }


        if ($this->db->query($sql) === true && $sql !== "" ) {
            echo "Data insert  successfully \r\n";
        } else {
            $error = mysqli_error($this->db);
            $this->db->query("DELETE FROM " . $product_type . " WHERE " . $product_type . ".id = " . $maxId . ";");
            echo $error;
        }

    }

    public function getAll() {
        //TODO

//        SELECT dvd.sku, dvd.product_name, dvd.price, dvd.product_size,
//                book.sku, book.product_name, book.price, book.weight,
//                furniture.sku, furniture.product_name, furniture.price,
//                furniture.height, furniture.width, furniture.product_length

//        $sql = "
//        SELECT sku
//            FROM dvd
//        UNION
//        SELECT sku
//            FROM book
//        UNION
//        SELECT sku
//            FROM furniture
//        order by sku;
//        ";

//        echo "<br>";
//        $result = mysqli_query($this->db, $sql, MYSQLI_USE_RESULT);
//        while ($row = $result->fetch_assoc()) {
//            echo implode(", ", $row) . "<br>";
//        }

//        if ($this->db->query($sql) === true) {
//            echo  "DONE\r\n";
//        } else {
//            echo "Error creating table: " . $this->db->error . "\r\n";
//        }

//        DROP VIEW IF EXISTS yourview;
//
//        CREATE VIEW yourview AS
//            SELECT table1.column1,
//            table2.column2
//        FROM
//        table1, table2
//        WHERE table1.column1 = table2.column1;

        $sql = "SELECT 
                all_products.sku, 
                all_products.product_name, 
                all_products.price, 
                all_products.product_type, 
                book.weight,
                dvd.product_size,
                furniture.height,
                furniture.width,
                furniture.width
                FROM all_products
                    LEFT JOIN book ON 
                        all_products.id_book = book.id
                    LEFT JOIN dvd ON 
                        all_products.id_dvd = dvd.id
                    LEFT JOIN furniture ON 
                        all_products.id_furniture = furniture.id
                ";

        echo "<br>";
        $result = mysqli_query($this->db, $sql);
//        while ($row = $result->fetch_assoc()) {
//            echo $row['product_type'];
//            echo implode(", ", $row) . "<br>";
//        }

        return $result;
    }
}