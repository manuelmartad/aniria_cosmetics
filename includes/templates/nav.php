    <!-- ======= Mobile nav toggle button ======= -->
    <i class="bi bi-list mobile-nav-toggle d-xl-none"></i>

    <!-- ======= Header ======= -->

    <header id="header">
        <div class="d-flex flex-column">

            <div class="profile">
                <!-- <img src="<?php echo ASSETS ?>img/profile.png" alt="" class="img-fluid rounded-circle bg-white"> -->
                <i class="fa-solid fa-user-gear" style="margin:30px 100px 15px; font-size:3.5rem; color:#F9F9F9"></i>
                <h1 class="text-light"><a href="index.html">Administrador</a></h1>
            </div>

            <nav id="navbar" class="nav-menu navbar">
                <ul>
                    <li><a href="<?php echo ADMIN ?>dashboard/dashboard.php" class="nav-link scrollto active"><i class='bx bx-home' ></i>
                            <span>Dashboard</span></a></li>
                    <li><a href="<?php echo ADMIN ?>orders/order_view.php" class="nav-link scrollto"><i class='bx bx-cart'></i>
                            <span>Pedidos</span></a></li>
                    <li><a href="<?php echo ADMIN ?>users/user_view.php" class="nav-link scrollto"><i class='bx bx-user' ></i>
                            <span>Usuarios</span></a></li>
                    <li><a href="<?php echo ADMIN ?>products/product_view.php" class="nav-link scrollto"><i class='bx bx-box' ></i>
                            <span>Productos</span></a></li>
                    <li><a href="<?php echo ADMIN ?>categories/category_view.php" class="nav-link scrollto"><i class='bx bx-folder-minus' ></i>
                            <span>Categorias</span></a></li>
                    <li><a href="<?php echo ADMIN ?>sellspots/sellspot_view.php" class="nav-link scrollto"><i class='bx bx-location-plus' ></i>
                            <span>Puntos de Venta</span></a></li>


                    <li><a type="button" id="signout" class="nav-link scrollto"><i class='bx bx-log-out' ></i><span>Salir</span></a></li>
                </ul>
            </nav>
        </div>
    </header>
    <!-- End Header -->
    