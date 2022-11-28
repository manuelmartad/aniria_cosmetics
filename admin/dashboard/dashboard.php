<?php require_once '../../config/env.php';
require_once '../../config/db.php';


include '../../includes/templates/header.php';
include '../../includes/templates/nav.php';
?>

<main id="main">
    <!-- ======= Skills Section ======= -->
    <section id="skills" class="skills section-bg">
        <div class="container p-3">
            <div class="row">
                <div class="col-md-6 col-lg-4 mb-3">
                    <div class="card p-3 shadow-lg">
                        <div class="card-title text-center">
                            <span> Usuarios Registrados</span>
                        </div>
                        <div class="card-body d-flex align-items-center justify-content-around fw-bold" style="font-size: 60px;">
                            <i class="fa-solid fa-user-alt"></i>
                            <?php $users =  $conn->query("SELECT * FROM users");
                            echo $users->num_rows; ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-3">
                    <div class="card p-3 shadow-lg">
                        <div class="card-title">
                            <span> Administradores Registrados</span>
                        </div>
                        <div class="card-body d-flex align-items-center justify-content-around fw-bold" style="font-size: 60px;">
                            <i class="fa-solid fa-user-gear text-primary"></i>
                            <?php $users =  $conn->query("SELECT * FROM users WHERE role = 'admin'");
                            echo $users->num_rows; ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-3">
                    <div class="card p-3 shadow-lg">
                        <div class="card-title">
                            <span> Compras realizadas</span>
                        </div>
                        <div class="card-body d-flex align-items-center justify-content-around fw-bold" style="font-size: 60px;">

                            <i class="fa-solid fa-shopping-cart text-primary"></i>
                            <?php $orders =  $conn->query("SELECT * FROM orders");
                            echo $orders->num_rows; ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-3">
                    <div class="card p-3 shadow-lg">
                        <div class="card-title">
                            <span> Total de venta</span>
                        </div>
                        <div class="card-body d-flex align-items-center justify-content-around fw-bold" style="font-size: 60px;">
                            <i class="fa-solid fa-dollar text-primary"></i>
                            <span class="text-success">
                                <?php $users =  $conn->query("SELECT sum(total) AS total FROM orders");
                                $sum = $users->fetch_assoc();
                                echo number_format($sum['total'], 2); ?>
                            </span>

                        </div>
                    </div>
                </div>



            </div>




        </div>
    </section><!-- End Skills Section -->

    <!-- ======= Portfolio Section ======= -->

    <!-- End Portfolio Section -->



</main><!-- End #main -->

<?php include '../../includes/templates/footer.php'; ?>