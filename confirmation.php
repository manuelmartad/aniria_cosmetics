<?php
require 'config/env.php';
require 'config/db.php';
require 'config/funciones.php';

include 'includes/templates/indexHeader.php';
$_SESSION['cart'] = array();

?>

<section class="products section bg-gray">
    <div class="container">
        <div class="block text-center">
            <!-- <i class="tf-ion-android-checkmark-circle"></i> -->
          <i class="bx bx-check-circle mb-3" style="font-size:80px"></i>

            <h2 class="text-center">¡Gracias! por su pago</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, sed.</p>
            <a href="index.php" class="btn btn-primary mt-3">seguir comprando</a>
        </div>
    </div>

</section>

<?php include 'includes/templates/indexFooter.php' ?>