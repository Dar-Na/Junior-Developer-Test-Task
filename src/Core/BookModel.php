<?php

namespace Core;

use Infrastructure\AbstractModel;

class BookModel extends AbstractModel
{
    private $weight;

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
        $this->setWeight(str_replace(',', '.', $data['weight']));
    }

    public function setWeight($weight) {
        $this->weight = $weight;
    }

    public function getWeight() {
        return $this->weight;
    }

    public function getAllProperties(): array
    {
        return ['id', 'weight'];
    }

    public function getAllValues(): array
    {
        return [
            [
                NULL,
                $this->getWeight()
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