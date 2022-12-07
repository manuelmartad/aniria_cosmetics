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


include '../../includes/templates/header.php';
include '../../includes/templates/nav.php';

?>

<main id="main">


    <!-- ======= Skills Section ======= -->
    <section id="skills" class="skills section-bg">
        <div class="container">
            <div class="col-md-12 px-3 mx-auto">
                <!-- <div class="card p-3 shadow-lg mt-3 mb-3"> -->
                <!-- <span class="fs-4 me-3 d-block">Notificaciones</span>
                    <hr> -->

                <!-- <div class="card-body"> -->
                <?php


                foreach ($errors as $error) :
                    echo '<div class="alert alert-warning alert-dismissible show fade p-3" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <small class="pe-4"> <i class="bx bx-bell text-danger align-middle fs-3 me-1"></i>' . $error . '</small>
                        </div>';
                endforeach;

                $q = $conn->query("SELECT a.*,b.* FROM notifications a
                INNER JOIN sale_spot b ON a.spot_id = b.spot_id WHERE a.active = 'Y'");
                // var_dump($data);
                if ($q->num_rows > 0) {
                    while ($fetch = $q->fetch_assoc()) {
                        $text = $fetch['text'];
                        $id = $fetch['idnotification'];
                        $spot = $fetch['sale_spot'];



                        // foreach ($errors as $error) {
                        echo '<div class="alert alert-success alert-dismissible show fade p-3" role="alert">
                            <button type="button" class="ps-2 btn-close dismissnotification" data-id="' . $id . '" data-bs-dismiss="alert" aria-label="Close"></button>
                            <small class="text-dark"> <i class="bx bx-bell align-middle fs-3 me-1"></i>' . $text . '</small> <span class="fw-bold text-dark pe-4">' . $spot . '</span></div>';
                        // }
                    }
                }
                ?>



                <!-- </div> -->
                <!-- </div> -->
            </div>
        </div>
    </section>
</main>


<?php include '../../includes/templates/footer.php'; ?>