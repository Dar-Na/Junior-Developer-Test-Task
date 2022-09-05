<?php

namespace Components;

use Infrastructure\AbstractComponent;

class Footer extends AbstractComponent {
    public function view() {
        ?>
            <footer class="mt-4">
                <hr class="border border-1 opacity-100">
                <div class="text-center mx-auto">
                    <div class="bottom-0">
                        <p>Scandiweb Test assignment</p>
                    </div>
                </div>
            </footer>
        <?php
    }
}