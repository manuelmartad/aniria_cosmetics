<?php
require_once '../../config/env.php';
require_once '../../config/db.php';


$sql = "SELECT * FROM sell_spot";
$result = $conn->query($sql);



include '../../includes/templates/header.php';
include '../../includes/templates/nav.php';
?>

<main id="main">


    <!-- ======= Skills Section ======= -->
    <section id="skills" class="skills section-bg">
        <div class="container">


            <div class="card p-3 shadow-lg">
                <div class="card-title d-flex justify-content-between">
                    <!-- <span class="fs-4 ms-3">Administrar Categorias</span>
                    <a href="category_add.php" class="btn btn-link"><i class="fa-solid fa-plus me-1"></i> Agregar
                        Categoria</a> -->
                </div>
                <div class="card-body">
                    <!-- ======= Portfolio Section ======= -->
                    <section id="portfolio" class="portfolio">
                        <div class="container">


                            <div class="row" data-aos="fade-up">
                                <div class="col-lg-12 d-flex justify-content-center">
                                    <!-- <ul id="portfolio-flters">
                                        <li data-filter="*" class="filter-active">All</li>
                                        <li data-filter=".filter-app">App</li>
                                        <li data-filter=".filter-card">Card</li>
                                        <li data-filter=".filter-web">Web</li>
                                    </ul> -->
                                </div>
                            </div>

                            <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="100">
                                <?php while ($spot = $result->fetch_assoc()) { ?>

                                    <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                                        <div class="portfolio-wrap">
                                            <!-- <img src="<?php echo ASSETS ?>img/portfolio/portfolio-1.jpg" class="img-fluid" alt=""> -->
                                            <img src="<?php echo $spot['location'] ?>" class="img-fluid" alt="">
                                            <iframe src="<?php echo $spot['location'] ?>" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="card-img-top" alt="image desc" width="400" height="300"></iframe>
                                            <div class="portfolio-links">
                                                <a href="<?php echo $spot['location'] ?>" data-gallery="portfolioGallery" class="portfolio-lightbox" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="card-img-top" alt="image desc" width="400" height="300" data-gallery="portfolioGallery" class="portfolio-lightbox"><i class="fa-solid fa-eye"></i></a>
                                                <a href="#" title="More Details"><i class="fa-solid fa-pen-alt"></i></a>
                                                <a href="#" title="More Details"><i class="fa-solid fa-trash"></i></a>
                                            </div>
                                        </div>
                                        <p class="text-center fs-5 mt-3"><?php echo $spot["spot_address"] ?></p>
                                    </div>

                                    <!-- <div class="col-lg-4 col-md-6 portfolio-item filter-web">
                                    <div class="portfolio-wrap">
                                        <img src="<?php echo ASSETS ?>img/portfolio/portfolio-2.jpg" class="img-fluid" alt="">
                                        <div class="portfolio-links">
                                            <a href="<?php echo ASSETS ?>img/portfolio/portfolio-2.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox" title="Web 3"><i class="fa-solid fa-eye"></i></a>
                                            <a href="#" title="More Details"><i class="fa-solid fa-pen-alt"></i></a>
                                            <a href="#" title="More Details"><i class="fa-solid fa-trash"></i></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                                    <div class="portfolio-wrap">
                                        <img src="<?php echo ASSETS ?>img/portfolio/portfolio-3.jpg" class="img-fluid" alt="">
                                        <div class="portfolio-links">
                                            <a href="<?php echo ASSETS ?>img/portfolio/portfolio-3.jpg" data-gallery="portfolioGallery" class="portfolio-lightbox" title="App 2">
                                                <i class="fa-solid fa-eye"></i></a>
                                            <a href="#" title="More Details"><i class="fa-solid fa-pen-alt"></i></a>
                                            <a href="#" title="More Details"><i class="fa-solid fa-trash"></i></a>
                                        </div>
                                    </div>
                                </div> -->
                                <?php } ?>

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