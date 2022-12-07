    <!-- ======= Mobile nav toggle button ======= -->
    <i class="bx bx-menu mobile-nav-toggle d-xl-none"></i>

    <!-- ======= Header ======= -->

    <header id="header">
            <div class="d-flex flex-column">

                    <?php $r = $conn->query("SELECT * FROM users WHERE id = {$_SESSION['id']}");
                        $d = $r->fetch_assoc() ?>

                    <div class="profile">
                            <img src="<?php echo ADMIN . 'users/uploads/' . $d['image'] ?>" alt="" class="rounded-circle" width="100" height="100">
                            <h1 class="text-light"><a href="<?php echo ADMIN ?>dashboard/dashboard.php"><?php echo $d['username'] ?></a></h1>
                    </div>


                    <nav id="navbar" class="nav-menu navbar">
                            <ul>

                                    <li><a href="<?php echo ADMIN ?>dashboard/dashboard.php" class="nav-link active"><i class='bx bx-home'></i>
                                                    <span>Dashboard</span></a></li>
                                    <li><a href="<?php echo ADMIN ?>notifications/notifications.php" class="nav-link position-relative">
                                                    <i class='bx bx-bell'></i><span>Notificaciones</span>
                                                    <span class="position-absolute px-2 py-1 end-80 top-10 start-40 translate-middle badge rounded-pill bg-danger">
                                                            <span><?php $r = $conn->query("SELECT active FROM notifications
                                                            WHERE active = 'Y'");
                                                                        echo ($r->num_rows) ?></span> </a></li>
                                    <li><a href="<?php echo ADMIN ?>orders/order_view.php" class="nav-link"><i class='bx bx-cart'></i>
                                                    <span>Pedidos</span></a></li>
                                    <li><a href="<?php echo ADMIN ?>users/user_view.php" class="nav-link"><i class='bx bx-user'></i>
                                                    <span>Usuarios</span></a></li>
                                    <li><a href="<?php echo ADMIN ?>products/product_view.php" class="nav-link"><i class='bx bx-box'></i>
                                                    <span>Productos</span></a></li>
                                    <li><a href="<?php echo ADMIN ?>stock/view_stock.php" class="nav-link"><i class='bx bxs-shopping-bag'></i>
                                                    <span>Stock</span></a></li>
                                    <li><a href="<?php echo ADMIN ?>categories/category_view.php" class="nav-link"><i class='bx bx-category'></i>
                                                    <span>Categorias</span></a></li>
                                    <li><a href="<?php echo ADMIN ?>sellspots/sellspot_view.php" class="nav-link"><i class='bx bxs-map'></i>
                                                    <span>Puntos de Venta</span></a></li>


                                    <li><a type="button" id="signout" class="nav-link"><i class='bx bx-log-out'></i><span>Salir</span></a></li>
                            </ul>
                    </nav>
            </div>
    </header>
    <!-- End Header -->