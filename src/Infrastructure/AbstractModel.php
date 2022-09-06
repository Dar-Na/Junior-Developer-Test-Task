<?php

namespace Infrastructure;

abstract class AbstractModel {
    protected $sku;
    protected $product_name;
    protected $price;

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

    abstract public function getAllProperties();
    abstract public function getAllValues();

}