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

$id = $_GET['id'] ?? null;
$q = $conn->query("SELECT * FROM products WHERE product_id = '$id'");
$d = $q->fetch_assoc();
$name = $d['product_name'];
$price = $d['product_price'];
$oldImage = $d['product_image'];
$category = $d['category_id'];

$errors = array();

if (!intval($_GET['id']) || intval($_GET['id']) > $d['product_id']) {
    header("location:../../404.html");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = sanitizeData($_POST['prod_name']);
    $price =  sanitizeData($_POST['prod_price']);
    $image = $_FILES['image'];
    $category = isset($_POST['category']) ? $_POST['category'] : '';

    if (empty($name) || empty($price) || empty($category)) {
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
        $image_name = "";
        if ($image['name']) {
            unlink($uploads . $oldImage);

            // generar nombre unico
            $image_name = md5(uniqid(rand(), true)) . ".jpg";

            // subir imagen
            move_uploaded_file($image['tmp_name'], $uploads . $image_name);
        } else {
            $image_name = $oldImage;
        }



        $r = $conn->query("UPDATE  products SET product_name = '$name', product_price = '$price', product_image = '$image_name', category_id = '$category'
        WHERE product_id = '$id'");


        if ($r) {
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
            <div class="col-md-8 px-3 mx-auto">

                <div class="card p-3 shadow-lg mt-3 mb-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="product_view.php" class="btn btn-outline-danger ms-3 py-1">
                            <i class='bx bx-arrow-back fw-bold px-3'></i></a>
                        <span class="fs-4 me-3 d-block">Editar Producto</span>

                    </div>
                    <hr>

                    <div class="card-body">
                        <?php foreach ($errors as $error) { ?>
                            <div class="alert alert-danger alert-dismissible show text-center" role="alert">
                                <small> <i class="fa-solid fa-triangle-exclamation"></i> <?php echo $error ?></small>
                            </div>

                        <?php   } ?>
                        <form method="POST" enctype="multipart/form-data" class="needs-validation" novalidate id="addProduct">


                            <div class="mb-3">
                                <label for="prod_name" class="form-label">Producto</label>
                                <input type="text" class="form-control" required name="prod_name" id="prod_name" value="<?= $name; ?>">
                                <small class="invalid-feedback">El nombre es obligatorio*</small>
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">Precio</label>
                                <input type="text" class="form-control" required name="prod_price" value="<?= $price ?>">
                                <small class="invalid-feedback">El precio es necesario*</small>

                            </div>


                            <div class="mb-3">
                                <label for="" class="form-label">Elegir imagen</label>
                                <input type="file" class="form-control" id="image" name="image" required>
                                <small class="invalid-feedback">La imagen es obligatoria*</small>
                                <img src="uploads/<?php echo $oldImage ?>" alt="" width="200" height="200" class="mt-4">
                            </div>


                            <div class="mb-3">
                                <?php $sql = "SELECT UPPER(category_name) AS 'category_name', category_id FROM categories";
                                $num = $conn->query($sql);
                                if ($num->num_rows > 0) :
                                ?>
                                    <label class="form-label p-0">Categoría</label>
                                    <select class="form-select" name="category" id="">
                                        <option selected disabled>--Seleccione una categoría--</option>
                                        <?php
                                        $row = $num->fetch_all(MYSQLI_ASSOC);
                                        foreach ($row as $value) : ?>
                                            <option value="<?php echo $value['category_id']; ?>" <?php echo $value['category_id'] == $category ? 'selected' : '' ?>><?php echo $value['category_name']; ?></option>
                                        <?php endforeach; ?>
                                    <?php else :
                                    echo "No hay categorias registradas";
                                endif;
                                    ?>
                                    </select>
                            </div>

                            <button class="btn btn-primary w-100" type="submit">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>


<?php include '../../includes/templates/footer.php'; ?>