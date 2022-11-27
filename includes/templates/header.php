<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title><?php echo TITLE ?></title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="<?php echo ASSETS ?>img/favicon.png" rel="icon">
    <link href="<?php echo ASSETS ?>img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <!-- <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet"> -->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <!-- <link href="/assets/vendor/aos/aos.css" rel="stylesheet"> -->
    <link href="<?php echo ASSETS ?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo ASSETS ?>vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?php echo ASSETS ?>vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="<?php echo ASSETS ?>vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="<?php echo ASSETS ?>vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo ASSETS ?>vendor/sweetalert/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo ASSETS ?>vendor/datatables/datatables.min.css" />


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <!-- Template Main CSS File -->
    <link href="<?php echo CSS ?>style.css" rel="stylesheet">



    <style>
        *:not(i) {
            font-family: 'Montserrat', sans-serif !important;
        }

        .navbar .bx {
            font-size: 35px !important;
        }

        @media only screen and (max-width:900px) {

            #no-more-tables tbody,
            #no-more-tables tr,
            #no-more-tables td {
                display: block;
                font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif !important;

            }

            #no-more-tables thead tr {
                position: absolute;
                top: -9999px;
                left: -9999px;

            }


            #no-more-tables td {
                position: relative;
                padding-left: 50%;
                border: none;
                border: 1px solid #ccc;

            }

            #no-more-tables td:before {
                content: attr(data-title);
                position: absolute;
                left: 6px;
                font-weight: bold;
            }

            #no-more-tables tr {
                /* padding-top: 20px; */
                margin-top: 40px;
                border-bottom: 1px solid #ccc;

            }

            #login-card {
                margin-top: 120px !important;
            }
        }
    </style>
</head>

<body>