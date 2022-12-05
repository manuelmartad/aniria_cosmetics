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

$prod_name = "";
$prod_price = "";
$category = "";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $prod_name = sanitizeData($_POST['prod_name']);
    $prod_price =  sanitizeData($_POST['prod_price']);
    $image = $_FILES['image'];
    $category = isset($_POST['category']);

    if (empty($prod_name) || empty($prod_price) || empty($category)) {
        $errors[] = "Todos los campos son obligatorios";
    }

    if ($image['size'] > 1000000) {
        $errors[] = 'La imagen es muy pesada';
    }

    if (empty($errors)) {

        // directorio de subir archivos
        $uploads = 'uploads/';

        // validar si no existe el directorio para crearlo
        if (!is_dir($uploads)) {
            mkdir($uploads);
        }
        // generar nombre unico
        $image_name = md5(uniqid(rand(), true)) . ".jpg";

        // subir imagen
        move_uploaded_file($image['tmp_name'], $uploads . $image_name);

        $sql = $conn->prepare("INSERT INTO products(product_name, product_price, product_image, category_id)VALUES(?,?,?,?)");
        $sql->bind_param('sdsi', $prod_name, $prod_price, $image_name, $category);


        if ($sql->execute()) {
            $_SESSION["success"] = '<div class="alert alert-success alert-dismissible show text-center" role="alert">
            <small> <i class="fa-solid fa-check pe-2"></i>Producto Agregado</small>
        </div>';
            header("location:product_view.php");
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
            <div class="col-md-12 px-3 mx-auto">
                <div class="card p-3 shadow-lg mt-3 mb-3">
                    <span class="fs-4 me-3 d-block">Notificaciones</span>
                    <hr>

                    <div class="card-body">
                        <?php foreach ($errors as $error) : ?>
                            <div class="alert alert-danger alert-dismissible show text-center" role="alert">
                                <small> <i class="fa-solid fa-triangle-exclamation"></i> <?php echo $error ?></small>
                            </div>
                        <?php endforeach; ?>


                        <div class="alert alert-success alert-dismissible show fade p-3 fs-5" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <small> <i class="bx bx-bell align-middle fs-3"></i> Esta es una notificacion de prueba</small>
                        </div>

                        <div class="alert alert-success alert-dismissible show fade p-3 fs-5" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <small> <i class="bx bx-bell align-middle fs-3"></i> Esta es una notificacion de prueba</small>
                        </div>

                        <div class="alert alert-success alert-dismissible show fade p-3 fs-5" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <small> <i class="bx bx-bell align-middle fs-3"></i> Esta es una notificacion de prueba</small>
                        </div>

                        <div class="alert alert-success alert-dismissible show fade p-3 fs-5" role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <small> <i class="bx bx-bell align-middle fs-3"></i> Esta es una notificacion de prueba</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>


<?php include '../../includes/templates/footer.php'; ?>