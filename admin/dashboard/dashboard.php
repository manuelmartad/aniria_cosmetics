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
                    <div class="card p-3 shadow-lg" style="border-left: 4px solid #d63384;">
                        <div class="card-title text-center">
                            <span> Usuarios Registrados</span>
                        </div>
                        <div class="card-body fs-2 text-center card-animated">
                            <a href="<?php echo ADMIN ?>users/user_view.php" class="position-relative">
                                <i class='bx bx-user-check text-primary' style="font-size:120px; font-weight:300!important"></i>
                                <span class="position-absolute ms-1 mb-4 px-3 py-2 end-120 top-10 bottom-100 start-0 translate-middle badge rounded-pill bg-danger">

                                    <span>
                                        <?php $users =  $conn->query("SELECT * FROM users");
                                        echo $users->num_rows; ?>
                                    </span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-3">
                    <div class="card p-3 shadow-lg" style="border-left: 4px solid #fd7e14;">
                        <div class="card-title text-center">
                            <span> Administradores Registrados</span>
                        </div>
                        <div class="card-body fs-2 text-center card-animated">
                            <a href="<?php echo ADMIN ?>users/user_view.php" class="position-relative">
                                <i class='bx bx-user-circle text-info' style="font-size:120px;"></i>
                                <span class="position-absolute mb-5 px-3 py-2 end-50 top-10 bottom-50 start-10 translate-middle badge rounded-pill bg-danger">
                                    <span> <?php $users =  $conn->query("SELECT * FROM users WHERE role = 'admin'");
                                            echo $users->num_rows; ?></span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-3">
                    <div class="card p-3 shadow-lg" style="border-left: 4px solid #20c997;">
                        <div class="card-title text-center">
                            <span> Compras realizadas</span>
                        </div>
                        <div class="card-body fs-2 text-center card-animated">
                            <a href="<?php echo ADMIN ?>orders/order_view.php" class="position-relative">
                                <i class='bx bx-cart text-warning' style="font-size:120px;"></i>
                                <span class="position-absolute mb-5 px-3 py-2 end-50 top-10 bottom-50 start-10 translate-middle badge rounded-pill bg-danger">
                                    <span>
                                        <?php $orders =  $conn->query("SELECT * FROM orders");
                                        echo $orders->num_rows; ?>
                                    </span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 mb-3">
                    <div class="card p-3 shadow-lg" style="border-left: 4px solid #0d6efd;">
                        <div class="card-title text-center">
                            <span> Total de venta</span>
                        </div>
                        <div class="card-body fs-4 text-center card-animated">
                            <a href="<?php echo ADMIN ?>orders/order_view.php">
                                <i class='bx bx-dollar text-success' style="font-size:80px;"></i>
                                <span class="text-danger align-middle pb-5">
                                    <?php $users =  $conn->query("SELECT sum(total) AS total FROM orders");
                                    $sum = $users->fetch_assoc();
                                    echo number_format($sum['total'], 2); ?>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 mb-3">
                    <div class="card p-3 shadow-lg" style="border-left: 4px solid #0f0f0f;">
                        <div class="card-title text-center">
                            <span> Productos</span>
                        </div>
                        <div class="card-body fs-2 text-center card-animated">
                            <a href="<?php echo ADMIN ?>products/product_view.php" class="position-relative">
                                <i class='bx bx-box text-dark' style="font-size:120px; font-weight:300!important"></i>
                                <span class="position-absolute ms-1 mb-4 px-3 py-2 end-120 top-10 bottom-100 start-0 translate-middle badge rounded-pill bg-danger">

                                    <span>
                                        <?php $q =  $conn->query("SELECT count(product_id) AS product FROM products");
                                        $d = $q->fetch_assoc();
                                        echo $d['product']; ?>
                                    </span>
                            </a>
                        </div>
                    </div>
                </div>



                <div class="col-md-6 col-lg-4 mb-3">
                    <div class="card p-3 shadow-lg" style="border-left: 4px solid #d63384;">
                        <div class="card-title text-center">
                            <span> Categorias</span>
                        </div>
                        <div class="card-body fs-2 text-center card-animated">
                            <a href="<?php echo ADMIN ?>categories/category_view.php" class="position-relative">
                                <i class='bx bx-category text-primary' style="font-size:120px; font-weight:300!important"></i>
                                <span class="position-absolute ms-1 mb-4 px-3 py-2 end-120 top-10 bottom-100 start-0 translate-middle badge rounded-pill bg-danger">

                                    <span>
                                        <?php $q =  $conn->query("SELECT count(category_id) AS category FROM categories");
                                        $d = $q->fetch_assoc();
                                        echo $d['category']; ?>
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