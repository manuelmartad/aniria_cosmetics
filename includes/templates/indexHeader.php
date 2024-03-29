<!DOCTYPE html>

<html lang="en">

<head>

  <!-- Basic Page Needs
  ================================================== -->
  <meta charset="utf-8">
  <title><?php echo TITLE ?></title>

  <!-- Mobile Specific Metas
  ================================================== -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">


  <!-- theme meta -->
  <meta name="theme-name" content="aviato" />

  <!-- Favicon -->
  <link rel="shortcut icon" type="image/x-icon" href="theme/images/favicon.png" />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- Themefisher Icon font -->
  <link rel="stylesheet" href="theme/plugins/themefisher-font/style.css">
  <!-- bootstrap.min css -->
  <!-- <link rel="stylesheet" href="theme/plugins/bootstrap/css/bootstrap.min.css"> -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <link href="<?php echo ASSETS ?>vendor/boxicons/css/boxicons.min.css" rel="stylesheet">


  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

  <link rel="stylesheet" href="<?php echo ASSETS ?>vendor/sweetalert/sweetalert2.min.css">
  <!-- Animate css -->
  <!-- <link rel="stylesheet" href="theme/plugins/animate/animate.css"> -->
  <!-- Slick Carousel -->
  <link rel="stylesheet" href="theme/plugins/slick/slick.css">
  <link rel="stylesheet" href="theme/plugins/slick/slick-theme.css">

  <!-- Main Stylesheet -->
  <link rel="stylesheet" href="theme/css/style.css">

  <!-- Replace "test" with your own sandbox Business account app client ID -->
  <script src="https://www.paypal.com/sdk/js?client-id=AUiQrb2y-alc-uA6diDpjtJmb6UigjR_Ak9eM76Z8GizXH9fk9mPIlOmeXWlGW5-l39BzfNeKpOZ2CIf&currency=MXN"></script>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600;700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />

  <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>

  <style>
    .bg-image {
      background-image: url("<?php echo ASSETS ?>img/aniria-hero.jpg");
      background-position: top;
      background-size: cover;
      height: 70vh;
      width: auto;
      padding-top: 0;
    }

    @media only screen and (max-width: 595px) {
      .bg-image {
        background-position: left;
        background-size: cover;
        background-repeat: no-repeat;
        height: 220px;
        width: auto !important;
      }

      #redirect {
        position: relative;
        display: inline-block !important;
        top: 165px;
        right: 0;
        left: -20px;
        width: 100% !important;
        background-color: #000;
        color: #fff;
        padding: -10px 100px !important;
      }

        /* *:not(tfoot), */
        #no-more-tables tbody,
      #no-more-tables tr,
      #no-more-tables td {
        display: block;
      }

      #no-more-tables thead tr {
        position: absolute;
        top: -9999px;
        left: -9999px;
      }


      #no-more-tables tbody td {
        position: relative;
        padding-left: 50%;
        border-bottom: 1px solid #000;

      }

      #no-more-tables td:last-child {
        border-bottom: none;
      }

      /* #no-more-tables td:first {
        border-top: 2px solid;
      } */



      #no-more-tables td:before {
        content: attr(data-title);
        position: absolute;
        left: 6px;
        font-weight: bold;
      }

      #no-more-tables tr {
        margin-top: 40px;
        border-bottom: 1px solid #000;

      }

      #no-more-tables tfoot td {
        border: none;
        display: inline-table;
      }

      #no-more-tables tfoot tr {
        border-bottom: 1px solid;
        margin: 0px;
        display: flex;
        justify-content: space-between;
        padding: 0 20px;

      }

      #no-more-tables tfoot td:first-child {
        border-top: none;
      }


    }

    .top-header i {
      font-size: 25px !important;
    }

    div h1 {
      font-family: 'Dancing Script', cursive !important;
      font-size: 70px;
      font-weight: 700;
      text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.8);
    }

    .main-title {
      font-family: 'Dancing Script', cursive !important;
      font-weight: 500 !important;
      text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.8);
      text-transform: capitalize !important;
      font-size: 40px;
    }

    #paypal-button-container {
      width: 100%;

    }

    @media only screen and (max-width:900px) and (min-width:450px) {

      .bg-image {
        background-position: center center;
        background-size: cover;
        background-repeat: no-repeat;
        height: 400px;
        width: auto;
      }

      #redirect {
        position: relative;
        display: inline-block !important;
        top: 320px;
        right: 0;
        left: 60px;
        width: 80% !important;
        background-color: #000;
        color: #fff;
        padding: -10px 100px !important;
        /* margin: 0 auto; */
        /* text-align: center; */
      }

      /* *:not(tfoot), */
      #no-more-tables tbody,
      #no-more-tables tr,
      #no-more-tables td {
        display: block;
      }

      #no-more-tables thead tr {
        position: absolute;
        top: -9999px;
        left: -9999px;
      }


      #no-more-tables tbody td {
        position: relative;
        padding-left: 50%;
        border-bottom: 1px solid #000;

      }

      #no-more-tables td:last-child {
        border-bottom: none;
      }

      /* #no-more-tables td:first {
        border-top: 2px solid;
      } */



      #no-more-tables td:before {
        content: attr(data-title);
        position: absolute;
        left: 6px;
        font-weight: bold;
      }

      #no-more-tables tr {
        margin-top: 40px;
        border-bottom: 1px solid #000;

      }

      #no-more-tables tfoot td {
        border: none;
        display: inline-table;
      }

      #no-more-tables tfoot tr {
        border-bottom: 1px solid;
        margin: 0px;
        display: flex;
        justify-content: space-between;
        padding: 0 20px;

      }

      #no-more-tables tfoot td:first-child {
        border-top: none;
      }

    }
  </style>

</head>

<body id="body">
  <div class="container">

    <!-- Start Top Header Bar -->
    <section class="top-header">
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-xs-12 col-sm-4">
            <div class="contact-number d-flex">
              <i class='bx bxs-phone'></i>
              <p>+52 (656) 461-51-34</p>
            </div>
          </div>
          <div class="col-md-4 col-xs-12 col-sm-4">
            <!-- Site Logo -->
            <div class="logo text-center">
              <a href="index.php">
                <!-- replace logo here -->
                <h2 class="main-title">aniria cosmetic's</h2>
              </a>
            </div>
          </div>
          <div class="col-md-4 col-xs-12 col-sm-4" id="top-bar">
            <!-- Cart -->
            <ul class="float-end d-flex">

              <!-- <li class="nav-item mx-3">
                <div class="dropdown open">
                  <a type="button" class="nav-link position-relative me-2" id="triggerId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class='bx bx-bell'></i>
                    <span class="position-absolute end-10 top-0 start-100 translate-middle badge rounded-pill bg-danger" id="cartProducts">
                      4 <span class="visually-hidden">unread messages</span>
                    </span>
                  </a>
                  <div class="dropdown-menu" id="dropdown_menu">
                    <a class="dropdown-item" href="#">
                      <small>AQUI VA EL LISTADO DE NOTIFICACIONES</small>
                    </a>
                    <div class="dropdown-divider"></div> <a class="dropdown-item" href="#">
                      <small>AQUI VA EL LISTADO DE NOTIFICACIONES</small>
                    </a>
                    <div class="dropdown-divider"></div> <a class="dropdown-item" href="#">
                      <small>AQUI VA EL LISTADO DE NOTIFICACIONES</small>
                    </a>
                    <div class="dropdown-divider"></div> <a class="dropdown-item" href="#">
                      <small>AQUI VA EL LISTADO DE NOTIFICACIONES</small>
                    </a>
                  </div>
                </div>
              </li> -->

              <li class="nav-item dropdown mt-lg-0">
                <a href="cart.php" class="nav-link me-2 position-relative" id="dropdownId">
                  <!-- <i class="fa-solid fa-cart-shopping pe-1"></i> -->
                  <i class='bx bx-cart-alt'></i>
                  <span class="position-absolute end-10 top-0 start-100 translate-middle badge rounded-pill bg-danger" id="cartProducts">
                    <?php echo !empty($_SESSION['cart']) ? count($_SESSION['cart']) : '0' ?>
                    <span class="visually-hidden">unread messages</span>
                  </span>
                </a>

              </li>

            </ul>

            <!-- / .nav .navbar-nav .navbar-right -->
          </div>
        </div>
      </div>
    </section><!-- End Top Header Bar -->

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
        <a class="navbar-brand" href="index.php"><i class='bx bx-shopping-bag px-1 fs-4'></i>ANIRIA</a>
        <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
          <i class='bx bx-menu fs-1'></i></button>
        <div class="collapse navbar-collapse d-lg-flex" id="collapsibleNavId">
          <ul class="navbar-nav me-auto mt-2 mt-lg-0">
            <li class="nav-item">
              <a class="nav-link active" href="about.php" aria-current="page">Nosotros</a>
            </li>


            <?php if (isset($_SESSION['login']) == true && $_SESSION['role'] == 'admin') : ?>
              <li class="nav-item">
                <a class="nav-link" href="admin/dashboard/dashboard.php">Admin</a>
              </li>
            <?php endif ?>

          </ul>
          <ul class="d-lg-flex gap-3 d-grid">

            <?php if (isset($_SESSION) && isset($_SESSION['login']) == false) : ?>
              <li class="nav-item mt-lg-0 mt-sm-1"> <a href="auth/login.php" class="dropdown-item" type="button">Iniciar sesión</a>
              </li>
              <li class="nav-item mt-lg-0 mt-sm-1"> <a href="auth/register.php" class="dropdown-item" type="button">Registrate</a>
              </li>
            <?php else : ?>
              <li class="nav-item dropdown">
                <a class="nav-link" href="account.php?id=<?php echo $_SESSION['id'] ?>" id="dropdownId">Mi Cuenta</a>
              </li>
              <li class="nav-item"> <a id="logout" class="dropdown-item" type="button">Cerrar sesión</a>
              </li> <?php endif  ?>

          </ul>



        </div>


      </div>
    </nav>