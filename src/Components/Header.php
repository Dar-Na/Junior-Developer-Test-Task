<?php

namespace Components;
include_once "consts.php";

class Header {
    public static function view() { ?>
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="description" content="Junior Developer test task for SCANDIWEB">
            <meta name="keywords" content="HTML, CSS, PHP">
            <meta name="author" content="Dzianis Dziurdz">
            <title>Product List</title>
            <link rel="icon"
                  type="image/png"
                  href="https://img.icons8.com/color-glass/48/000000/earth-element.png"
            />
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
            <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet">
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
            <script src="http://localhost/Junior-Developer-Test-Task/resources/scripts.js"></script>
        </head>

        <nav class="navbar">
            <div class="container-fluid">
                <a class="navbar-brand mx-1 fw-semibold fs-3">Product List</a>
                <div class="d-flex">
                    <?php
                        if(SITE_URL . "/addproduct" === 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']) {
                            ?>
                                <button class="btn btn-outline-primary mx-1" type="submit">SAVE</button>
                                <a href="<?php echo SITE_URL . "/" ?>" class="btn btn-danger mx-1" role="button">CANCEL</a>
                            <?php
                        } else {
                            ?>
                                <a href="<?php echo SITE_URL . "/addproduct" ?>" class="btn btn-outline-primary mx-2" role="button">ADD</a>
                                <button class="btn btn-danger mx-1" type="submit">MASS DELETE</button>
                            <?php
                        }
                    ?>
                </div>
            </div>
        </nav>
        <hr class="border border-1 opacity-100">
    <?php
    }
}