<?php
require 'config/env.php';
require 'config/db.php';
require 'config/funciones.php';

$name = "";
$address = "";
$zip = "";
$city = "";
$country = "";
$card_number = "";
$expiration_date = "";
$card_pin = "";
$errors = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = $conn->real_escape_string(sanitizeData($_POST['name']));
    $address = $conn->real_escape_string(sanitizeData($_POST['address']));
    $zip = $conn->real_escape_string(sanitizeData($_POST['zip']));
    $city = $conn->real_escape_string(sanitizeData($_POST['city']));
    $country = $conn->real_escape_string(sanitizeData($_POST['country']));
    $card_number = $conn->real_escape_string(sanitizeData($_POST['card_number']));
    $expiration_date = $conn->real_escape_string(sanitizeData($_POST['expiration_date']));
    $card_pin = $conn->real_escape_string(sanitizeData($_POST['card_pin']));

    $buyerName = $conn->real_escape_string(sanitizeData($_POST['buyerName']));
    $cartItems = $conn->real_escape_string(sanitizeData($_POST['cartItems']));
    $orderId = $conn->real_escape_string(sanitizeData($_POST['orderId']));
    $total = $conn->real_escape_string(sanitizeData($_POST['total']));
    $date = date('d-m-Y');

    if (empty($name) || empty($address) || empty($zip) || empty($city) || empty($country) || empty($card_number) || empty($expiration_date) || empty($card_pin)) {
        $errors[] = "Hay un error en los campos.";
    }

    if ($total == 0) {
        $errors[] = "Se ha producido un error.";
    }

    if (empty($errors)) {
        $sql = $conn->prepare("INSERT INTO payment(name,address,zip,city,country,card_number,expiration_date,cvc,buyerName,cartItems,orderId,total,date)
       VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $sql->bind_param('ssissisisiiss', $name, $address, $zip, $city, $country, $card_number, $expiration_date, $card_pin, $buyerName, $cartItems, $orderId, $total, $date);
        if ($sql->execute()) {
            $_SESSION['cart'] = array();
            header("location:confirmation.php");
        }
    }
}

// $_SESSION['message'] =  $errors;
// $mensaje = '<div class="alert alert-danger text-center hide"><i class="fa-solid fa-triangle-exclamation pe-2"></i>' . $errors . '</div>';

include 'includes/templates/indexHeader.php';
?>


<section class="products section bg-gray">
    <div class="container">
        <div class="row">
            <div class="title text-center">
                <h2>realizar pago</h2>
            </div>
        </div>


        <form method="POST" class="needs-validation" novalidate>

            <div class="row g-5">
                <div class="col-md-7">
                    <?php
                    foreach ($errors as $error) :
                        echo '<div class="alert alert-danger text-center hide"><i class="fa-solid fa-triangle-exclamation pe-2"></i>' . $error . '</div>';
                    endforeach; ?>
                    <div class="mb-3">
                        <h4>Detalles del pago</h4>
                        <hr>
                        <div class="mb-3">
                            <input type="text" class="form-control" id="" required value="<?php echo $name ?>" name="name" placeholder="NOMBRE COMPLETO*">
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" id="" required value="<?php echo $address ?>" name="address" placeholder="DOMICILIO*">
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <input type="text" class="form-control" id="" required value="<?php echo $zip ?>" name="zip" placeholder="CODIGO POSTAL*">
                            </div>
                            <div class="mb-3 col-md-6">
                                <input type="text" class="form-control" id="" required value="<?php echo $city ?>" name="city" placeholder="CIUDAD*">
                            </div>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" id="" required value="<?php echo $country ?>" name="country" placeholder="PAIS*">
                        </div>
                    </div>


                    <div class="mb-sm-4">
                        <div class="d-flex align-items-center">
                            <h4>Metodo de pago </h4>
                        </div>
                        <hr>
                        <h6 class="text-muted mb-3">Detalles de la tarjeta de credito<span>(Pago seguro)</span></h6>
                        <div class="mb-3">
                            <input type="text" class="form-control" id="" required value="<?php echo $card_number ?>" name="card_number" placeholder="NUMERO DE TARJETA*">
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" id="" required value="<?php echo $expiration_date ?>" name="expiration_date" placeholder="FECHA DE EXPIRACION (MM/YYYY)*">
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" id="" required value="<?php echo $card_pin ?>" name="card_pin" placeholder="PIN CVC*">
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary text-uppercase px-4 py-2"><small>realizar pedido</small> </button>
                        </div>

                    </div>

                </div>

                <div class="col-md-5">

                    <div class="mb-5">
                        <h4>resumen del pedido</h4>
                        <hr>
                        <?php
                        $subtotal = 0;
                        $total = 0;
                        $iva = 1.16;
                        foreach ($_SESSION['cart'] as $key => $producto) : ?>
                            <div class="row">
                                <div class="col-md-12 col-lg-4 mb-3">
                                    <img src="<?php echo ADMIN ?>products/uploads/<?php echo $producto['productImage'] ?>" alt="" width="150" height="150">
                                </div>
                                <div class="col-md-12 col-lg-4">
                                    <p><?php echo $producto['productName'] ?></p>
                                    <p><?php echo $producto['productQty'] ?> x $<?php echo $producto['productPrice'] ?></p>
                                    <!-- <a href="#">Eliminar</a> -->
                                </div>
                            </div>
                            <hr>
                        <?php

                            $subtotal = $subtotal + ($producto['productQty'] * $producto['productPrice']);
                        endforeach; ?>
                        <div class="row">
                            <div class="col-6">
                                <p>Subtotal</p>
                                <p>Envio</p>
                                <p>Total</p>
                            </div>
                            <div class="col-6 text-end">
                                <?php ?>

                                <p>$<?php echo number_format($subtotal, 2) ?></p>
                                <p><s>Gratis</s></p>
                                <?php $total = $total + ($subtotal * $iva) ?>
                                <p class="fs-4 text-success">$<?php echo number_format($total, 2) ?></p>
                                <!-- <div class="py-3"><button class="btn btn-primary w-100">Aceptar</button>
                        </div> -->
                            </div>
                            <img src="<?php echo ASSETS ?>img/verified.png" alt="">
                        </div>
                    </div>

                    <!-- Set up a container element for the button -->
                    <div id="paypal-button-container"></div>


                </div>

                <?php
                $total = number_format($total, 2);
                $orderid =  date('His') . rand(1111, 9999);
                $cartItems = count($_SESSION['cart']);
                $buyerName = $_SESSION['name'];
                ?>

                <input type="hidden" name="total" value="<?php echo $total ?>">
                <input type="hidden" name="orderId" value="<?php echo $orderid ?>">
                <input type="hidden" name="cartItems" value="<?php echo $cartItems ?>">
                <input type="hidden" name="buyerName" value="<?php echo $buyerName ?>">
            </div>

        </form>



</section>


<?php include 'includes/templates/indexFooter.php' ?>