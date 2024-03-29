<?php
require_once '../../config/env.php';
require_once '../../config/db.php';


$sql = "SELECT * FROM sale_spot";
$result = $conn->query($sql);



include '../../includes/templates/header.php';
include '../../includes/templates/nav.php';
?>

<main id="main">


    <!-- ======= Skills Section ======= -->
    <section id="skills" class="skills section-bg">
        <div class="container">


            <div class="card p-3 shadow-lg col-10 mx-auto">
                <?php if (isset($_GET['updated']) && $_GET['updated'] == 1) {
                    echo '<div class="alert alert-success alert-dismissible fade show p-3 text-center" role="alert">
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
<small>Punto de venta actualizado</small></div>';
                } ?>

                <div class="card-title d-flex justify-content-between">
                    <!-- <span class="fs-4 ms-3">Administrar Categorias</span>
                    <a href="category_add.php" class="btn btn-link"><i class="fa-solid fa-plus me-1"></i> Agregar
                        Categoria</a> -->
                </div>
                <div class="card-body">
                    <!-- ======= Portfolio Section ======= -->
                    <section id="portfolio" class="portfolio">
                        <div class="container">

                            <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="100">
                                <?php while ($spot = $result->fetch_assoc()) : ?>

                                    <div class="col-lg-6 col-md-6 portfolio-item">
                                        <div class="portfolio-wrap">
                                            <img src="<?php echo $spot['location'] ?>" class="img-fluid" alt="">
                                            <iframe src="<?php echo $spot['location'] ?>" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="card-img-top" alt="image desc" width="400" height="300"></iframe>
                                            <div class="portfolio-links">
                                                <a href="<?php echo $spot['location'] ?>" data-gallery="portfolioGallery" class="portfolio-lightbox" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="card-img-top" alt="image desc" width="400" height="300" data-gallery="portfolioGallery" class="portfolio-lightbox"><i class="fa-solid fa-eye"></i></a>
                                                <a href="sellspot_edit.php?edit=<?php echo $spot['spot_id'] ?>" title="More Details"><i class="fa-solid fa-pen-alt"></i></a>
                                                <a type="button" class="deleteSpot" data-id="<?php echo $spot['spot_id'] ?>"><i class="fa-solid fa-trash"></i></a>
                                            </div>
                                        </div>
                                        <p class="text-center fs-5 mt-3"><?php echo $spot["spot_address"] ?></p>
                                    </div>

                                <?php endwhile; ?>

                            </div>

                        </div>
                    </section>
                    <!-- End Portfolio Section -->
                </div>
            </div>

        </div>
    </section><!-- End Skills Section -->

    <!-- ======= Portfolio Section ======= -->

    <!-- End Portfolio Section -->



</main><!-- End #main -->


<?php include '../../includes/templates/footer.php'; ?>