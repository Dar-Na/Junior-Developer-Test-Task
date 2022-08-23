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
        ) or die("Connect failed: %s\n". $this -> db -> error);
    }

    public function getAll() {
        //TODO
        echo "GET ALL";
    }
}