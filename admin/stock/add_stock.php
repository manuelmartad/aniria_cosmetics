<?php

// var_dump($msg);
require_once '../../config/db.php';
require '../../config/env.php';
include '../../config/funciones.php';


if ($_SESSION['login'] == false) {
    header('location:login.php');
}
if ($_SESSION['role'] !== 'admin') {
    header('location: index.php');
}

$errors = [];

$quantity = "";
// $prod_price = "";
// $category = "";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // var_dump($_POST);
    // exit;

    $quantity = sanitizeData($_POST['quantity']);
    $product = isset($_POST['product']) ? $_POST['product'] : '';
    $salespot = isset($_POST['salespot']) ? $_POST['salespot'] : '';

    if (empty($salespot) || empty($product)) {
        $errors[] = "Todos los campos son obligatorios";
    }

    $query = "SELECT * FROM PRODUCT_SPOT WHERE product_id = '$product' and SPOT_ID ='$salespot'";
    $a = $conn->query($query);

    // echo '<pre>';
    // var_dump($a);
    // echo '</pre>';
    // // exit;

    if ($a->num_rows > 0) {
        $errors[] = "Este producto ya se encuentra dado de alta en un punto de venta";
    }




    if (empty($errors)) {


        $sql = $conn->prepare("INSERT INTO product_spot(quantity, product_id, spot_id)VALUES(?,?,?)");
        $sql->bind_param('iii', $quantity, $product, $salespot);


        if ($sql->execute()) {
            //     $_SESSION["success"] = '<div class="alert alert-success alert-dismissible show text-center" role="alert">
            //     <small> <i class="fa-solid fa-check pe-2"></i>Stock agregado!</small>
            // </div>';
            // header("location:add_stock.php");
        }
    }
}


include '../../includes/templates/header.php';
include '../../includes/templates/nav.php';

?>


<main id="main">


    <!-- ======= Skills Section ======= -->
    <section id="skills" class="skills section-bg">
        <div class="container">


            <div class="card p-3 shadow-lg col-md-10 col-lg-6 mx-auto">
                <div class="d-flex justify-content-between">
                    <a href="view_stock.php" class="btn btn-outline-danger ms-3 py-1">
                        <i class='bx bx-arrow-back fw-bold px-3'></i></a>
                    <span class="fs-4 me-3 d-block">Agregar Stock</span>

                </div>
                <hr class="mx-3">

                <div class="card-body">
                    <?php foreach ($errors as $error) { ?>
                        <div class="alert alert-danger alert-dismissible show text-center" role="alert">
                            <small> <i class="fa-solid fa-triangle-exclamation"></i> <?php echo $error ?></small>
                        </div>

                    <?php   } ?>

                    <form method="POST" class="" novalidate action="add_stock.php">

                        <small class="validateinput text-danger py-3"></small>

                        <div class="mb-3">
                            <label for="" class="form-label">Cantidad</label>
                            <input type="number" class="form-control" min="0" required name="quantity" id="quantity" value="<? echo $quantity; ?>">
                        </div>

                        <div class="mb-3">
                            <?php $sql = "SELECT UPPER(product_name) AS 'product_name', product_id FROM products";
                            $num = $conn->query($sql);
                            if ($num->num_rows > 0) :
                            ?>
                                <label class="form-label p-0">Producto</label>
                                <select class="form-select" name="product" id="product">
                                    <option selected disabled>--Seleccione un producto--</option>
                                    <?php
                                    $row = $num->fetch_all(MYSQLI_ASSOC);
                                    foreach ($row as $value) : ?>
                                        <option value="<?php echo $value['product_id']; ?>"><?php echo $value['product_id']; ?></option>
                                    <?php endforeach; ?>
                                <?php else :
                                echo "No hay productos registrados";
                            endif;
                                ?>
                                </select>

                        </div>

                        <div class="mb-3">
                            <?php $sql = "SELECT UPPER(sale_spot) AS 'sale_spot', spot_id FROM sale_spot";
                            $num = $conn->query($sql);
                            if ($num->num_rows > 0) :
                            ?>
                                <label class="form-label p-0">Punto de Venta</label>
                                <select class="form-select" name="salespot" id="salespot">
                                    <option selected disabled>--Seleccione un punto de venta--</option>
                                    <?php
                                    $row = $num->fetch_all(MYSQLI_ASSOC);
                                    foreach ($row as $value) : ?>
                                        <option value="<?php echo $value['spot_id']; ?>"><?php echo $value['spot_id']; ?></option>
                                    <?php endforeach; ?>
                                <?php else :
                                echo "No hay puntos de venta registrados";
                            endif;
                                ?>
                                </select>

                        </div>
                        <div class="mt-4">
                            <button class="btn btn-primary w-100" type="submit">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>





        </div>
    </section>

</main><!-- End #main -->



<?php include '../../includes/templates/footer.php'; ?>