<?php
require_once '../../config/db.php';
require '../../config/env.php';
include '../../config/funciones.php';


if ($_SESSION['login'] == false) {
    header('location:login.php');
}
if ($_SESSION['role'] !== 'admin') {
    header('location: index.php');
}

$errors = array();

$r = $conn->query("SELECT a.*,b.*,c.* FROM product_spot a
JOIN products b ON a.product_id = b.product_id 
JOIN sale_spot c ON a.spot_id = c.spot_id
-- JOIN notifications d ON a.spot_id = d.spot_id
WHERE a.quantity < 5");
while ($data = $r->fetch_assoc()) {

    if ($data['quantity'] == 0) {
        $errors[] = "El producto " . $data['product_name'] . " se encuentra agotado en punto de venta <strong>" . $data['sale_spot'] . "</strong>";
    }
    if ($data['quantity'] < 5) {
        $errors[] = "El producto " . $data['product_name'] . " esta apunto de agotarse en punto de venta <strong>" . $data['sale_spot'] . "</strong>";
    }
}
$q = $conn->query("SELECT * FROM notifications WHERE active = 'Y'");
// var_dump($data);
if ($q->num_rows > 0) {
    while ($fetch = $q->fetch_assoc()) {
        $errors[] = $fetch['text'];
    }
}




include '../../includes/templates/header.php';
include '../../includes/templates/nav.php';

?>

<main id="main">


    <!-- ======= Skills Section ======= -->
    <section id="skills" class="skills section-bg">
        <div class="container">
            <div class="col-md-12 px-3 mx-auto">
                <div class="card p-3 shadow-lg mt-3 mb-3">
                    <!-- <span class="fs-4 me-3 d-block">Notificaciones</span>
                    <hr> -->

                    <div class="card-body">
                        <?php

                        foreach ($errors as $error) {
                            echo '<div class="alert alert-danger alert-dismissible show fade p-3" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <small> <i class="bx bx-bell align-middle fs-3 me-1"></i>' . $error . '</small>
                        </div>';
                        }
                        ?>



                    </div>
                </div>
            </div>
        </div>
    </section>
</main>


<?php include '../../includes/templates/footer.php'; ?>