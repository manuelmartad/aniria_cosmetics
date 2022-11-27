<?php
require_once '../../config/env.php';
require_once '../../config/db.php';

if ($_SESSION['login'] == false) {
    header('location:login.php');
}
if ($_SESSION['role'] !== 'admin') {
    header('location: index.php');
}

$sql = "SELECT a.product_id, a.product_name, a.product_price, a.product_image, b.category_name FROM products a
JOIN categories b ON a.category_id = b.category_id ORDER by a.product_id ASC";
$data = $conn->query($sql);


include '../../includes/templates/header.php';
include '../../includes/templates/nav.php';
?>

<main id="main">


    <!-- ======= Skills Section ======= -->
    <section id="skills" class="skills section-bg">
        <div class="container">

            <div class="card p-3 shadow-lg" id="reload">
                <div class="card-title d-md-flex justify-content-between">
                    <span class="fs-4 ms-3">Administrar Productos</span>
                    <a href="product_add.php" class="btn btn-outline-primary me-3"><i class='bx bx-folder-plus pe-2'></i>Agregar
                        Producto</a>
                </div>
                <div class="card-body">
                    <!-- <?php echo $_SESSION["success"] ?? null;
                    unset($_SESSION["success"]) ?> -->
                    <!-- <div id="response" class="alert alert-success text-center d-none"><small></small></div> -->
                    <table class="table table-bordered text-center" id="no-more-tables">
                        <thead style="background:#020202;color:#fdfdfd">
                            <tr>
                                <td>ID</td>
                                <td>Nombre</td>
                                <td>Precio</td>
                                <td>Categoria</td>
                                <td>Imagen</td>
                                <td>Acción</td>
                            </tr>
                        </thead>
                        <tbody id="reload">
                            <?php if ($data->num_rows > 0) {
                                while ($row = $data->fetch_assoc()) { ?>
                                    <tr class="align-middle">
                                        <td data-title="ID"><?php echo $row['product_id']; ?></td>
                                        <td data-title="Nombre"><?php echo $row['product_name']; ?></td>
                                        <td data-title="Precio"><?php echo $row['product_price']; ?></td>

                                        <td data-title="Categoria"><?php echo $row['category_name']; ?></td>

                                        <td data-title="Imagen"><img src="uploads/<?php echo $row['product_image']; ?>" width="150" height="150" class="rounded-0 pe-3"></td>


                                        <td data-title="Acción"><a href="product_edit.php?id=<?php echo $row['product_id'] ?>" class="btn btn-primary"><i class="fa-solid fa-pen"></i></a>
                                            <button class="btn btn-danger deleteProduct" name="deleteProduct" data-id="<?php echo $row['product_id'] ?>"><i class="fa-solid fa-trash"></i></button>
                                        </td>
                                    </tr>
                            <?php }
                            } ?>
                        </tbody>


                    </table>
                    <nav>
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                        </ul>
                    </nav>
                </div>
            </div>





        </div>
    </section><!-- End Skills Section -->

    <!-- ======= Portfolio Section ======= -->

    <!-- End Portfolio Section -->



</main><!-- End #main -->

<?php include '../../includes/templates/footer.php' ?>