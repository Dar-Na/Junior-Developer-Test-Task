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

    public function getAllProperties(): array
    {
        return ['id', 'height', 'width', 'product_length'];
    }

    public function getAllValues(): array
    {
        return [
            [
                NULL,
                $this->getHeight(),
                $this->getWidth(),
                $this->getProductLength()
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