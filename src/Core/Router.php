<?php

namespace Core;
include_once "consts.php";

class Router {

    private $current_url;
    public $request;

    public function __construct() {
        $this->current_url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $this->request = str_replace(SITE_URL, '', $this->current_url);
    }

    private static function isCurrentMethodOrUri($uri, $method, $callback) {
        if ($uri === $_SERVER['REQUEST_URI'] && $method === $_SERVER['REQUEST_METHOD']) {
            echo $callback();
        }
    }

    public function get($uri, $callback) {
        $uri = SITE_PREFIX . $uri;
        self::isCurrentMethodOrUri( $uri, "GET", $callback);
    }
    public function post($uri, $callback) {
        self::isCurrentMethodOrUri($uri, "POST", $callback);
    }
    public function put($uri, $callback) {
        self::isCurrentMethodOrUri($uri, "PUT", $callback);
    }
    public function delete($uri, $callback) {
        self::isCurrentMethodOrUri($uri, "DELETE", $callback);
    }

}