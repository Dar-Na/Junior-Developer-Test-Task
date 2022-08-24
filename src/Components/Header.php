<?php

namespace Components;

class Header {
    public static function view() { ?>
        <head>
            <meta charset="UTF-8">
            <meta name="description" content="Junior Developer test task for SCANDIWEB">
            <meta name="keywords" content="HTML, CSS, PHP">
            <meta name="author" content="Dzianis Dziurdz">
            <title>Product List</title>
            <link rel="icon"
                  type="image/png"
                  href="https://img.icons8.com/color-glass/48/000000/earth-element.png"
            />
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css"
                  rel="stylesheet"
                  integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx"
                  crossorigin="anonymous"
            />
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
                    integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa"
                    crossorigin="anonymous"></script>
            <link rel="stylesheet" href="http://localhost/Junior-Developer-Test-Task/resources/main.css">
        </head>

        <nav class="navbar">
            <div class="container-fluid">
                <a class="navbar-brand mx-1 fw-semibold fs-3">Product List</a>
                <div class="d-flex">
                    <button class="btn btn-outline-primary mx-2" type="submit">ADD</button>
                    <button class="btn btn-danger mx-1" type="submit">MASS DELETE</button>
                </div>
            </div>
        </nav>
        <hr class="border border-1 opacity-100">
    <?php
    }
}