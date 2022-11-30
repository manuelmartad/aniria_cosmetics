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
                    <div class="card p-3 shadow-lg card-animated">
                        <div class="card-title text-center">
                            <span> Usuarios Registrados</span>
                        </div>
                        <div class="card-body fs-3 text-center">
                            <a a href="<?php echo ADMIN ?>users/user_view.php">
                                <i class='bx bx-user-check text-primary' style="font-size:70px ;"></i>
                                <span>
                                    <?php $users =  $conn->query("SELECT * FROM users");
                                    echo $users->num_rows; ?>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-3">
                    <div class="card p-3 shadow-lg card-animated">
                        <div class="card-title text-center">
                            <span> Administradores Registrados</span>
                        </div>
                        <div class="card-body fs-3 text-center">
                            <a a href="<?php echo ADMIN ?>users/user_view.php">
                                <i class='bx bx-user-circle text-info' style="font-size:70px ;"></i>
                                <span> <?php $users =  $conn->query("SELECT * FROM users WHERE role = 'admin'");
                                        echo $users->num_rows; ?></span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-3">
                    <div class="card p-3 shadow-lg card-animated">
                        <div class="card-title text-center">
                            <span> Compras realizadas</span>
                        </div>
                        <div class="card-body fs-3 text-center">
                            <a a href="<?php echo ADMIN ?>orders/order_view.php">
                                <i class='bx bx-cart text-warning' style="font-size:70px ;"></i>
                                <span>
                                    <?php $orders =  $conn->query("SELECT * FROM orders");
                                    echo $orders->num_rows; ?>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-3">
                    <div class="card p-3 shadow-lg card-animated">
                        <div class="card-title text-center">
                            <span> Total de venta</span>
                        </div>
                        <div class="card-body fs-3 text-center">
                            <a a href="<?php echo ADMIN ?>orders/order_view.php">
                                <i class='bx bx-money-withdraw text-success' style="font-size:70px ;"></i>
                                <span class="text-danger">$
                                    <?php $users =  $conn->query("SELECT sum(total) AS total FROM orders");
                                    $sum = $users->fetch_assoc();
                                    echo number_format($sum['total'], 2); ?>
                                </span>
                            </a>
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