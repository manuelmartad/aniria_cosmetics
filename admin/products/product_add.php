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
            <div class="col-md-6 px-3 mx-auto">

                <div class="card shadow mt-3 mb-3">
                    <!-- <div class="card-header pt-3">
                        <h3>Agregar Producto</h3>
                    </div> -->
                    <div class="card-body">
                        <?php foreach ($errors as $error) { ?>
                            <div class="alert alert-danger alert-dismissible show text-center" role="alert">
                                <small> <i class="fa-solid fa-triangle-exclamation"></i> <?php echo $error ?></small>
                            </div>

                        <?php   } ?>
                        <form method="POST" enctype="multipart/form-data" class="needs-validation p-4" novalidate id="addProduct">

                            <div class="mb-3">
                                <label for="" class="form-label">Nombre</label>
                                <input type="text" class="form-control form-control-sm" required name="prod_name" id="prod_name" placeholder="Nombre Producto" value="<?= $prod_name; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Precio</label>
                                <input type="text" class="form-control form-control-sm" required name="prod_price" placeholder="$ 0.00" value="<?= $prod_price ?>">
                            </div>


                            <div class="mb-3">
                                <label for="" class="form-label">Elegir imagen</label>
                                <input type="file" class="form-control form-control-sm" id="image" name="image" required>
                            </div>

                            <div class="mb-3">
                                <?php $sql = "SELECT UPPER(category_name) AS 'category_name', category_id FROM categories";
                                $num = $conn->query($sql);
                                if ($num->num_rows > 0) {
                                ?>
                                    <label class="form-label p-0">Categoria</label>
                                    <select class="form-select form-select-sm" name="category" id="">
                                        <option selected disabled>--Seleccione una categoria--</option>
                                        <?php
                                        $row = $num->fetch_all(MYSQLI_ASSOC);
                                        foreach ($row as $value) { ?>
                                            <option value="<?php echo $value['category_id']; ?>"><?php echo $value['category_name']; ?></option>
                                    <?php                   }
                                    } else {
                                        echo 'No rows';
                                    }
                                    ?>
                                    </select>
                            </div>

                            <button class="btn btn-primary float-end" type="submit">guardar<i class="fa-solid fa-save ps-2"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>


<?php include '../../includes/templates/footer.php'; ?>