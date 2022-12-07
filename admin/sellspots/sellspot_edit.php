<?php
require_once '../../config/env.php';
require_once '../../config/db.php';

$id = $_GET['edit'] ?? null;
$sql = "SELECT * FROM sale_spot WHERE spot_id = '$id'";
$r = $conn->query($sql);
$d = $r->fetch_assoc();
$salespot = $d['sale_spot'];
$address = $d['spot_address'];
$location = $d['location'];
$errors = array();

if (!intval($_GET['edit']) || intval($_GET['edit']) > $d['spot_id']) {
    header("location:../../404.html");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $salespot = $_POST['salespot'];
    $address = $_POST['address'];
    $location = $_POST['location'];

    if (!$salespot || !$address || !$location) {
        $errors[] = "Hay un error en los campos";
    }

    if (empty($errors)) {
        $q = $conn->query("UPDATE sale_spot set sale_spot = '$salespot', 
        spot_address = '$address', location = '$location' 
        WHERE spot_id = '$id'");

        if ($q) {
            header("location:sellspot_view.php?updated=1");
        }
    }
}

// var_dump($d);

include '../../includes/templates/header.php';
include '../../includes/templates/nav.php';
?>

<main id="main">


    <!-- ======= Skills Section ======= -->
    <section id="skills" class="skills section-bg">
        <div class="container">


            <div class="card p-3 shadow-lg col-8 mx-auto">
                <div class="card-title d-flex justify-content-between">
                    <!-- <span class="fs-4 ms-3">Administrar Categorias</span>
                    <a href="category_add.php" class="btn btn-link"><i class="fa-solid fa-plus me-1"></i> Agregar
                        Categoria</a> -->
                </div>
                <div class="card-body">
                    <!-- ======= Portfolio Section ======= -->
                    <section id="portfolio" class="portfolio">
                        <div class="container">

                            <form action="" method="post" class="needs-validation" novalidate>
                                <div class="mb-3">
                                    <label for="" class="form-label">Punto de Venta</label>
                                    <input type="text" class="form-control" name="salespot" id="" value="<?php echo $salespot ?>" required>
                                    <small id="helpId" class="invalid-feedback">Este campo es obligatorio</small>
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Dirección</label>
                                    <input type="text" class="form-control" name="address" id="" value="<?php echo $address ?>" required>
                                    <small id="helpId" class="invalid-feedback">Este campo es obligatorio</small>
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Ubicación</label>
                                    <input type="text" class="form-control" name="location" id="" value="<?php echo $location ?>" required>
                                    <small id="helpId" class="invalid-feedback">Este campo es obligatorio</small>
                                </div>
                                <div>
                                    <button class="btn btn-primary">Actualizar punto de venta</button>
                                </div>
                            </form>

                        </div>
                    </section>
                    <!-- End Portfolio Section -->
                </div>
            </div>

        </div>
    </section><!-- End Skills Section -->

    <!-- ======= Portfolio Section ======= -->

    <!-- End Portfolio Section -->



</main><!-- End #main -->


<?php include '../../includes/templates/footer.php'; ?>