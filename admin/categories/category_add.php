<?php
require_once '../../config/env.php';
require_once '../../config/db.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $category = $_POST['category_name'];
    $image = $_FILES['imagen'];

    // var_dump($_FILES);

    if (empty($category) || empty($image['name']) || $image['error']) {
        $errors[] = 'Todos los campos son obligatorios';
    }

    if ($image['size'] > 1000000) {
        $errors[] = 'La imagen es muy grande';
    }

    $ext = pathinfo($image['name'], PATHINFO_EXTENSION);

    // validar que solo se suban imagenes
    if (!in_array($ext, ['jpg', 'jpeg', 'png'])) {
        $errors[] = 'Solo imagenes son permitidas';
    }

    if (empty($errors)) {

        // directorio de subir archivos
        $uploads = 'uploads/category_pictures/';

        // validar si no existe el directorio para crearlo
        if (!is_dir($uploads)) {
            mkdir($uploads);
        }
        // generar nombre unico
        $image_name = md5(uniqid(rand(), true)) . ".jpg";

        // subir imagen
        move_uploaded_file($image['tmp_name'], $uploads . $image_name);

        $sql = $conn->prepare("INSERT INTO categories(category_name, category_image)VALUES(?,?)");
        $sql->bind_param('ss', $category, $image_name);

        if ($sql->execute()) {
            header("location:category_view.php?categoria_agregada=true");
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
                    <a href="category_view.php" class="btn btn-outline-danger ms-3 py-1">
                        <i class='bx bx-arrow-back fw-bold'></i></a>
                    <span class="fs-4 me-3 d-block">Agregar Categoria</span>

                </div>
                <hr>
                <div class="card-body">
                    <?php foreach ($errors as $error) : ?>
                        <div class="alert alert-danger alert-dismissible show text-center" role="alert">
                            <small> <i class="fa-solid fa-triangle-exclamation"></i> <?php echo $error ?></small>
                        </div>
                    <?php endforeach; ?>

                    <form action="" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>

                        <div class="mb-4">
                            <label for="" class="form-label">Nombre Categoria</label>
                            <input type="text" class="form-control" name="category_name" id="" placeholder="" required>
                            <small class="invalid-feedback">La categoria es obligatoria*</small>
                        </div>


                        <div class="mb-3">
                            <!-- <label for="" class="form-label">Imagen</label> -->
                            <input type="file" class="form-control" name="imagen" id="" required>
                            <small class="invalid-feedback">La imagen es obligatoria*</small>
                        </div>

                        <button type="submit" class="btn btn-primary px-5 mt-3 w-100 w-lg-50"><i class="fa-solid fa-save pe-2"></i>Agregar</button>
                    </form>

                </div>
            </div>

        </div>
    </section>

</main><!-- End #main -->

<?php include '../../includes/templates/footer.php'; ?>