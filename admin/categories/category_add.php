<?php
require_once '../../config/env.php';
include '../../includes/templates/header.php'; 
include '../../includes/templates/nav.php';
?>


<main id="main">


    <!-- ======= Skills Section ======= -->
    <section id="skills" class="skills section-bg">
        <div class="container">


            <div class="card p-3 shadow-lg col-md-6 mx-auto">
                <div class="card-title d-flex justify-content-between">
                    <span class="fs-4 ms-3">Agregar Categoria</span>
                    <a href="category_view.php" class="btn btn-link">
                        Regresar</a>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="" class="form-label">Nombre Categoria</label>
                            <input type="text" class="form-control form-control-sm" name="" id="" aria-describedby="helpId" placeholder="">
                        </div>


                        <div class="mb-3">
                            <label for="" class="form-label">Imagen</label>
                            <input type="file" class="form-control form-control-sm" name="" id="" placeholder="" aria-describedby="fileHelpId">
                        </div>
                    </form>

                </div>
            </div>





        </div>
    </section><!-- End Skills Section -->

    <!-- ======= Portfolio Section ======= -->

    <!-- End Portfolio Section -->



</main><!-- End #main -->



<?php include '../../includes/templates/footer.php'; ?>