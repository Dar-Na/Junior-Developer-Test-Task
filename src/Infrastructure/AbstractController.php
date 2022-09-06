<?php

namespace Infrastructure;

include_once "consts.php";

abstract class AbstractController
{

    protected $db;

    public function __construct() {
        $this->connect();
    }

    public function connect() {
        $this->db = new \mysqli(
            DB_HOST,
            DB_USER,
            DB_PASSWORD,
            DB_NAME
        );


        //mysqli_report(MYSQLI_REPORT_OFF);
    }

    protected function isExistTable($table) {
        if ($res = $this->db->query("SHOW TABLES LIKE '" . $table . "'")) {
            if ($res->num_rows !== 1) {
                $this->createTable($table);
                return false;
            } else {
                return true;
            }
        }
    }

    protected function createTable($table) {
        $sql = '';

        if ($table === "book") {
            $sql = $sql . "CREATE TABLE book (
                        id INT AUTO_INCREMENT NOT NULL,
                        weight FLOAT NOT NULL,
                        PRIMARY KEY(id)
                            )";
        }

        if ($table === "dvd") {
            $sql = $sql . "CREATE TABLE dvd (
                        id INT AUTO_INCREMENT NOT NULL,
                        product_size FLOAT NOT NULL,
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
    abstract public function insertProduct($type, $propertiesArr, $valuesArr);
    abstract public function deleteProduct($type, $sku);
}