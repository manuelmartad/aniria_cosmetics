<?php
require_once '../../config/env.php';
require_once '../../config/db.php';

$id = $_GET['edit'] ?? null;
$q = $conn->query("SELECT * FROM categories WHERE category_id = '$id'");
$d = $q->fetch_assoc();

$name = $d['category_name'];
$oldImage = $d['category_image'];

if (!intval($_GET['edit']) || $_GET['edit'] > $id) {
    header("location:../../404.html");
}

$errors = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = $_POST['category_name'];
    $image = $_FILES['imagen'];

    if (empty($name) || empty($image)) {
        $errors[] = 'Todos los campos son obligatorios';
    }

    if ($image['size'] > 1000000) {
        $errors[] = 'La imagen es muy grande';
    }

    if (empty($errors)) {

        $upload = 'uploads/category_pictures/';

        if (!is_dir($upload)) {
            mkdir($upload);
        }

        $image_name = "";

        if ($image['name']) {
            unlink($upload . $oldImage);
            // generar nombre unico
            $image_name = md5(uniqid(rand(), true)) . ".jpg";

            move_uploaded_file($image['tmp_name'], $upload . $image_name);
        } else {
            $image_name = $oldImage;
        }

        $conn->query("UPDATE categories SET category_name = '$name', category_image = '$image_name' WHERE category_id =  '$id'");

        header("location:category_view.php");
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
                <div class="d-flex justify-content-between align-items-center">
                    <a href="category_view.php" class="btn btn-outline-danger rounded ms-3 py-1">
                        <i class='bx bx-arrow-back fw-bold'></i></a>
                    <span class="fs-4 me-3 d-block">Editar Categoria</span>

                </div>
                <hr>
                <div class="card-body">
                    <?php foreach ($errors as $error) { ?>
                        <div class="alert alert-danger alert-dismissible show text-center" role="alert">
                            <small> <i class="fa-solid fa-triangle-exclamation"></i> <?php echo $error ?></small>
                        </div>

                    <?php   } ?>
                    <form action="" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>

                        <div class="mb-4">
                            <label for="" class="form-label">Nombre Categoria</label>
                            <input type="text" class="form-control" name="category_name" id="" required value="<?php echo $name ?>">
                            <small class="invalid-feedback">La categoria es obligatoria*</small>
                        </div>


                        <div class="mb-3">
                            <!-- <label for="" class="form-label">Imagen</label> -->
                            <input type="file" class="form-control" name="imagen" id="">
                            <small class="invalid-feedback">La imagen es obligatoria*</small>
                            <img src="uploads/category_pictures/<?php echo $oldImage ?>" alt="" height="200" width="200" class="mt-3">
                        </div>

                        <button type="submit" class="btn btn-primary px-5 mt-3 w-100 w-lg-50">Actualizar</button>
                    </form>

                </div>
            </div>

        </div>
    </section>

</main><!-- End #main -->



<?php include '../../includes/templates/footer.php'; ?>