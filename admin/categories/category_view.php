<?php
require_once '../../config/env.php';
require_once '../../config/db.php';


$sql = "SELECT * FROM categories";
$categories = $conn->query($sql);


include '../../includes/templates/header.php';
include '../../includes/templates/nav.php';
?>

<main id="main">


    <!-- ======= Categories Section ======= -->
    <section id="skills" class="skills section-bg">
        <div class="container">


            <div class="card p-3 shadow-lg">
                <div class="card-title d-flex justify-content-between">
                    <span class="fs-4 ms-3">Administrar Categorias</span>
                    <a href="category_add.php" class="btn btn-link"><i class="fa-solid fa-plus me-1"></i> Agregar
                        Categoria</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover text-center" id="no-more-tables">
                        <thead style="background:linear-gradient(#020202, #464646);color:#fdfdfd">
                            <tr>
                                <td>ID</td>
                                <td>Nombre</td>
                                <td>Imagen</td>
                                <td>Acción</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($category = $categories->fetch_assoc()) : ?>
                                <tr class="align-middle">
                                    <td data-title="ID"><?php echo $category['category_id'] ?></td>
                                    <td data-title="Nombre"><?php echo $category['category_name'] ?></td>
                                    <td data-title="Imagen"><img src="uploads/category_pictures/<?php echo $category['category_image'] ?>" alt="" width="100" height="100"></td>

                                    <td data-title="Acción"><button class="btn btn-link"><i class="fa-solid animate fs-5 fa-pen-alt text-warning"></i></button> |
                                        <button class="btn btn-link"><i class="fa-solid animate fs-5 fa-trash text-danger"></i></button>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </section><!-- End Categories Section -->


</main><!-- End #main -->


<?php include '../../includes/templates/footer.php'; ?>