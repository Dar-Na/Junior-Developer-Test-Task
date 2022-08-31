<?php

namespace Pages;

include_once "consts.php";

class AddProduct {
    public static function view() {
        echo '
        <div onload="ClearForm()" class="m-4">
            <form id="product_form" action="' . SITE_URL . '/addproduct" class="needs-validation" method="post" novalidate>
                <div class="mb-3 row">
                    <label for="sku" class="col-sm-2 col-form-label">SKU</label>
                    <div class="col-sm-3">
                        <input 
                            type="text" 
                            name="sku" 
                            class="form-control" 
                            id="sku" 
                            placeholder="Please, provide sku" 
                            required
                            />
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="name" class="col-sm-2 col-form-label">NAME</label>
                    <div class="col-sm-3">
                        <input 
                           type="text" 
                            name="name" 
                            class="form-control" 
                            id="name" 
                            placeholder="Please, provide product name" 
                            required
                            />
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="price" class="col-sm-2 col-form-label">Price ($)</label>
                    <div class="col-sm-3">
                        <input 
                            type="text" 
                            name="price" 
                            class="form-control" 
                            id="price" 
                            placeholder="Please, provide price" 
                            required
                            >
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="productType" class="col-sm-2 col-form-label">Select product type</label>
                    <div class="col-sm-3">
                        <select 
                            class="form-select" 
                            id="productType" 
                            name="productType" 
                            onchange="OnSelectionChange()" 
                            required
                            >
                            <option selected disabled value="">Choose type</option>
                            <option value="Book">Book</option>
                            <option value="Dvd">DVD</option>
                            <option value="Furniture">Furniture</option>
                        </select>
                    </div>
                </div>
                <div id="productTypeVal">
                
                </div>
            </form>
            
        </div>
        <script>
        
            function ClearForm(){
                document.product_form.reset();
            }
        
            function OnSelectionChange() {
                let data = document.getElementById("productType");
                let doc = document.getElementById("productTypeVal");
                let divF = `
                <div id="furniture">
                    <div class="mb-3 row">
                        <label for="height" class="col-sm-2 col-form-label">Height (CM)</label>
                        <div class="col-sm-3">
                            <input 
                                type="text" 
                                class="form-control" 
                                name="height" 
                                id="height" 
                                placeholder="Please, provide height" 
                                required
                                >
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="width" class="col-sm-2 col-form-label">Width (CM)</label>
                        <div class="col-sm-3">
                            <input 
                                type="text" 
                                class="form-control" 
                                name="width" 
                                id="width" 
                                placeholder="Please, provide width" 
                                required
                                >
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="length" class="col-sm-2 col-form-label">Length (CM)</label>
                        <div class="col-sm-3">
                            <input 
                                type="text" 
                                class="form-control" 
                                name="length" 
                                id="length"
                                placeholder="Please, provide length" 
                                required
                                >
                        </div>
                    </div>
                </div>`;
                let divB = `
                <div id="book">
                    <div class="mb-3 row">
                        <label for="weight" class="col-sm-2 col-form-label">Weight (KG)</label>
                        <div class="col-sm-3">
                            <input 
                                type="text" 
                                class="form-control" 
                                name="weight" 
                                id="weight" 
                                placeholder="Please, provide weight" 
                                required
                                >
                        </div>
                    </div>
                </div>
                `;
                let divD = `
                <div id="dvd">
                    <div class="mb-3 row">
                        <label for="size" class="col-sm-2 col-form-label">Size (MB)</label>
                        <div class="col-sm-3">
                            <input 
                                type="text" 
                                class="form-control" 
                                name="size" id="size" 
                                placeholder="Please, provide size" 
                                required
                                >
                        </div>
                    </div>
                </div>
                `;

                if(data.value === "Furniture") {
                    doc.innerHTML = divF;
                }
                else if(data.value === "Book" ) {
                    doc.innerHTML = divB;
                }
                else if(data.value === "Dvd") {
                    doc.innerHTML = divD;
                }
                else {
                    doc.innerHTML = "";
                }
            }

            (function () {
              "use strict"
            
              // Fetch all the forms we want to apply custom Bootstrap validation styles to
              var forms = document.querySelectorAll(".needs-validation")
            
              // Loop over them and prevent submission
              Array.prototype.slice.call(forms)
                .forEach(function (form) {
                  form.addEventListener("submit", function (event) {
                    if (!form.checkValidity()) {
                      event.preventDefault()
                      event.stopPropagation()
                    }
            
                    form.classList.add("was-validated")
                  }, false)
                })
            })()

            OnSelectionChange();
        </script>
        ';
    }
}