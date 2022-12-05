<?php
require_once '../../config/env.php';
require_once '../../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["transaction"];

    $sql = "SELECT * FROM orders WHERE transaction_id = '$id'";
    $r = $conn->query($sql);

    if ($r) :
        $d = $r->fetch_assoc(); ?>

        <div class="w-100">
            <div class="mb-3 border-bottom pb-1">
                <span class="d-block fw-bold">ID</span>
                <span><?php echo $d['transaction_id'] ?></span>
            </div>

            <div class="mb-3 border-bottom pb-1"> <span class="d-block fw-bold">Calle</span>
                <span><?php echo $d['address'] ?></span>
            </div>


            <div class="mb-3 border-bottom pb-1"> <span class="d-block fw-bold">Colonia</span>
                <span><?php echo $d['address1'] ?></span>
            </div>

            <div class="mb-3 border-bottom pb-1"> <span class="d-block fw-bold">Codigo Postal</span>
                <span><?php echo $d['zip'] ?></span>
            </div>

            <div class="mb-3 border-bottom pb-1"> <span class="d-block fw-bold">Ciudad</span>
                <span><?php echo $d['city'] ?></span>
            </div>
            <div class="mb-3 border-bottom pb-1"> <span class="d-block fw-bold">Pais</span>
                <span><?php echo $d['country'] ?></span>
            </div>

        </div>

<?php endif;
} ?>