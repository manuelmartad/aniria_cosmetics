<?php
require 'config/env.php';
include 'includes/templates/indexHeader.php';
?>
<div class="container">
    <div class="border">
        <div class="row p-3 align-items-center gap-3">
            <div class="col-md-3 text-lg-end">
                <img src="assets//img//profile-img.jpg" alt="" class="rounded-circle" height="150" width="150">
                <a href="#" class="d-block my-3 text-justify">Cambiar imagen</a>
            </div>
            <div class="col-md-7">
                <div class="d-flex gap-2">
                    <p class="fw-bold">Nombre:</p>
                    <span>Manuel Marta</span>
                </div>
                <div class="d-flex gap-2">
                    <p class="fw-bold">Pais:</p>
                    <span>Mexico</span>
                </div>

                <div class="d-flex gap-2">
                    <p class="fw-bold">Telefono</p>
                    <span>(656) 461-51-34</span>
                </div>

            </div>
        </div>


    </div>
</div>

<?php include 'includes/templates/indexFooter.php';
?>