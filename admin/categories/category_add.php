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


    if (empty($errors)) {

        // directorio de subir archivos
        $uploads = 'uploads/category_pictures/';
        //var_dump($uploads);
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
            $_SESSION['msg'] = '<div class="alert alert-success alert-dismissible fade show text-center" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <strong class="text-uppercase">Nueva categoria agregada!</strong>
            </div>';

            header("location:category_view.php");
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
                <div class="card-title d-flex justify-content-between">
                    <span class="fs-4 ms-3">Agregar Categoria</span>
                    <a href="category_view.php" class="btn btn-link">
                        Regresar</a>
                </div>
                <div class="card-body">
                    <?php foreach ($errors as $error) { ?>
                        <div class="alert alert-danger alert-dismissible show text-center" role="alert">
                            <small> <i class="fa-solid fa-triangle-exclamation"></i> <?php echo $error ?></small>
                        </div>

                    <?php   } ?>
                    <form action="" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                        <div class="mb-4">
                            <label for="" class="form-label">Nombre Categoria</label>
                            <input type="text" class="form-control" name="category_name" id="" aria-describedby="helpId" placeholder="" required>
                        </div>


                        <div class="mb-3">
                            <!-- <label for="" class="form-label">Imagen</label> -->
                            <input type="file" class="form-control" name="imagen" id="" placeholder="" required>
                        </div>

                        <button type="submit" class="btn btn-primary px-5 mt-3"><i class="fa-solid fa-save pe-2"></i>Agregar</button>
                    </form>

                </div>
            </div>





        </div>
    </section>

</main><!-- End #main -->



<?php include '../../includes/templates/footer.php'; ?>