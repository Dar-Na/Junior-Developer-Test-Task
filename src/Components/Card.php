<?php

namespace Components;

class Card {
    private $product_type;
    private $data;

    public function __construct($product_type, $array) {
        $this->product_type = $product_type;
        $this->data = $array;
    }

    private function viewBook($arr) {
        return "
            <div class='col' style='max-width: 17rem;'>
                <div class='card'>
                    <div class='card-body'>
                        <input class='form-check-input' type='checkbox' style='margin-top: -0.5rem; margin-left: -0.5rem;' onchange='changeClass(this.parentNode, this)'/> 
                        <div class='card-text text-center' style='margin-top: -1rem;'> 
                            <span class='card-text'>"
                                . $arr['sku'] .
                            "</span>
                            <br>
                            <span class='card-text'>"
                                . $arr['product_name'] .
                            "</span>
                            <br>
                            <span class='card-text'>"
                                . number_format((float)$arr['price'], 2, '.', '') .
                                " $ 
                            </span>
                            <br>
                            <span class='card-text'>
                                Weight: "
                                . number_format((float)$arr['weight'], 1, '.', '') .
                                " (KG) 
                            </span>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        ";
    }

    private function viewDvd($arr) {

    }

    private function viewFurniture($arr) {

    }

    public function view() {
        $funcName = 'view' . $this->product_type;
        return $this->$funcName($this->data);
    }
}