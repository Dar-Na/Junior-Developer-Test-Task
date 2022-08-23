<?php

namespace Pages;

use Core\Model;


class HomePage {
    public static function view() {
        echo 'HOME PAGE';
        echo (new Model()) ->getAll();
    }
}