<?php

namespace Core;

use Infrastructure\AbstractModel;

class DvdModel extends AbstractModel
{

    private $product_size;

    public function __construct()
    {
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
        $this->setProductSize(str_replace(',', '.', $data['size']));
    }

    public function setProductSize($product_size) {
        $this->product_size = $product_size;
    }

    public function getProductSize() {
        return $this->product_size;
    }

    public function getAllProperties(): array
    {
        return ['id', 'product_size'];
    }

    public function getAllValues(): array
    {
        return [
            [
                NULL,
                $this->getProductSize()
            ],
            [
                $this->getSku(),
                $this->getProductName(),
                $this->getPrice(),
                NULL,
                NULL,
                NULL
            ]
        ];
    }
}