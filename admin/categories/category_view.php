<?php
require_once '../../config/env.php';
include '../../includes/templates/header.php';
include '../../includes/templates/nav.php';
?>

<main id="main">


    <!-- ======= Skills Section ======= -->
    <section id="skills" class="skills section-bg">
        <div class="container">


            <div class="card p-3 shadow-lg">
                <div class="card-title d-flex justify-content-between">
                    <span class="fs-4 ms-3">Administrar Categorias</span>
                    <a href="category_add.php" class="btn btn-link"><i class="fa-solid fa-plus me-1"></i> Agregar
                        Categoria</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover text-center">
                        <thead style="background:linear-gradient(#020202, #464646);color:#fdfdfd">
                            <tr>
                                <td>ID</td>
                                <td>Nombre</td>
                                <td>Imagen</td>
                                <td>Acción</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="align-middle">
                                <td>10</td>
                                <td>Color negro mate</td>
                                <td>Imagen</td>
                                <td><button class="btn btn-link"><i class="fa-solid animate fs-5 fa-pen-alt text-warning"></i></button> |
                                    <button class="btn btn-link"><i class="fa-solid animate fs-5 fa-trash text-danger"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </section><!-- End Skills Section -->

    <!-- ======= Portfolio Section ======= -->

    <!-- End Portfolio Section -->



</main><!-- End #main -->


<?php include '../../includes/templates/footer.php'; ?>