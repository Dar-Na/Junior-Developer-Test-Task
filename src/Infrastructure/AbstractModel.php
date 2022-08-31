<?php

namespace Infrastructure;

include_once "consts.php";

abstract class AbstractModel {

    protected $db;
    protected $sku;
    protected $product_name;
    protected $price;

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

    public function setSku($sku) {
        $this->sku = $sku;
    }

    public function getSku() {
        return $this->sku;
    }

    public function setProductName($product_name) {
        $this->product_name = $product_name;
    }

    public function getProductName() {
        return $this->product_name;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function getPrice() {
        return $this->price;
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

    abstract protected function createTable($table);
    abstract public function insertProduct();
    abstract public function deleteProduct($sku);
}