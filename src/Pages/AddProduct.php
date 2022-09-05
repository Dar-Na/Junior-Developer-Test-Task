<?php

namespace Pages;

include_once "consts.php";

class AddProduct {
    //            <form id="product_form" action="' . SITE_URL . '/addproduct" class="needs-validation" method="post" novalidate>

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
                            pattern="^(?:[1-9]\d*|0(?!(?:\.0+)?$))?(?:\.\d+)?$"
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
        
        <div id="invalidFeedBack" class="m-4 fw-bold"></div>
        
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
                                pattern="^(?:[1-9]\\\d*|0(?!(?:\\\.0+)?$))?(?:\\\.\\\d+)?$"
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
                                pattern="^(?:[1-9]\\\d*|0(?!(?:\\\.0+)?$))?(?:\\\.\\\d+)?$"
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
                                pattern="^(?:[1-9]\\\d*|0(?!(?:\\\.0+)?$))?(?:\\\.\\\d+)?$"
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
                                pattern="^(?:[1-9]\\\d*|0(?!(?:\\\.0+)?$))?(?:\\\.\\\d+)?$"
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
                                pattern="^(?:[1-9]\\\d*|0(?!(?:\\\.0+)?$))?(?:\\\.\\\d+)?$"
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

//            (function () {
//                "use strict"
//            
//                // Fetch all the forms we want to apply custom Bootstrap validation styles to
//                let forms = document.querySelectorAll(".needs-validation")
//                
//                // Loop over them and prevent submission
//                Array.prototype.slice.call(forms)
//                    .forEach(function (form) {
//                        form.addEventListener("submit", function (event) {
//                            console.log(form.checkValidity());
//                            if (form.checkValidity()) {
//                                event.preventDefault()
//                                event.stopPropagation()
//                            }
//                    
//                            form.classList.add("was-validated")
//                        })
//                    })
//            })()
            
            function check(el) {
                if (el.checkValidity()) {
                    el.classList.remove("is-invalid")
                    el.classList.add("is-valid")
                } 
                else {
                    el.classList.remove("is-valid")
                    el.classList.add("is-invalid")
                }
            }
            
            $("#sku").change(function(e) {
                $.ajax({
                    type: "POST",
                    url: "' . SITE_URL . '/validate",
                    data: $(this).serialize(),
                    success: function (res) {
                       let ind = res.search("isExist");
                       let str = JSON.parse(res.substring(ind-2, ind+15));
                       if (str.isExist === true || !document.forms["product_form"]["sku"].value) {
                           $("#sku")[0].classList.remove("is-valid")
                           $("#sku")[0].classList.add("is-invalid")
                           document.getElementById("invalidFeedBack").innerHTML = 
                            "Please, write unique SKU.";
                       } else {
                           $("#sku")[0].classList.remove("is-invalid")
                           $("#sku")[0].classList.add("is-valid")
                           document.getElementById("invalidFeedBack").innerHTML = "";
                       }
                    },
                });
                
                e.preventDefault();
            });
            
            $("#name").change(function () {
                check($(this)[0]);
            });
            
            $("#price").change(function () {
                check($(this)[0]);
            });
            
            $("#productType").change(function () {
                check($(this)[0]);
            });
            
            $("#product_form").submit(function (e) {
                $("#sku").trigger("change");
//                $("#name").trigger("change");
//                $("#price").trigger("change");
//                $("#productType").trigger("change");
                
                let inputs = document.querySelectorAll("input");
                for(let i = 0; i < inputs.length; i++) {
                    if (i > 0) {
                        if (inputs[i].checkValidity()) {
                            inputs[i].classList.remove("is-invalid")
                            inputs[i].classList.add("is-valid")
                        } 
                        else {
                            inputs[i].classList.remove("is-valid")
                            inputs[i].classList.add("is-invalid")
                        }
                    }
                }
                let invalidArr = document.querySelectorAll(".is-invalid");
                if (invalidArr.length !== 0) {
                     e.preventDefault();
                     e.stopPropagation();
                }
                
                $("#product_form")[0].classList.add("was-validated")
            });
            
            OnSelectionChange();
        </script>
        ';
    }
}