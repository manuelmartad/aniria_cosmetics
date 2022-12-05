<?php
require 'config/env.php';
require 'config/db.php';
require 'config/funciones.php';

$name = "";
$address = "";
$address1 = "";
$zip = "";
$city = "";
$country = "";

$errors = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $transactionId = $_POST['payment_id'];
    $name = $conn->real_escape_string(sanitizeData($_POST['name']));
    $address = $conn->real_escape_string(sanitizeData($_POST['address']));
    $address1 = $conn->real_escape_string(sanitizeData($_POST['address1']));
    $zip = $conn->real_escape_string(sanitizeData($_POST['zip']));
    $city = $conn->real_escape_string(sanitizeData($_POST['city']));
    $country = $conn->real_escape_string(sanitizeData($_POST['country']));
    $cartItems = $conn->real_escape_string(sanitizeData($_POST['cartItems']));
    $total = $_POST['total'];
    $date = date('d-m-Y');
    $sale_spot = $_SESSION['spot'];

    if (empty($name) || empty($address) || empty($address1) || empty($zip) || empty($city) || empty($country)) {
        $errors[] = "Hay un error en los campos.";
    }

    if ($total == 0) {
        $errors[] = "Se ha producido un error.";
    }

    if (empty($errors)) {

        $sql = $conn->prepare("INSERT INTO orders(transaction_id,name,address,address1,zip,city,country,spot_id,totalItems,total,date)
            VALUES(?,?,?,?,?,?,?,?,?,?,?)");
        $sql->bind_param('ssssissisds', $transactionId, $name, $address, $address1, $zip, $city, $country, $sale_spot, $cartItems, $total, $date);
        if ($sql->execute()) {
            echo 201;
        } else {
            echo "bad";
        }

        foreach ($_SESSION['cart'] as $item) {
            echo '<pre>';
            var_dump($item);
            echo '</pre>';
            $conn->query("UPDATE product_spot SET quantity = quantity - '{$item['productQty']}' 
            WHERE product_id = '{$item['productId']}' AND spot_id = '{$_SESSION['spot']}' ");
        }

        $_SESSION['cart'] = array();
        $_SESSION['spot'] = array();
    }
}

// echo '<pre>';
// var_dump($_SESSION);
// echo '</pre>';


include 'includes/templates/indexHeader.php';
?>

<section class="products section bg-gray">
    <div class="container">
        <div class="row">
            <div class="title text-center">
                <h2>realizar pago</h2>
            </div>
        </div>


        <form method="POST" novalidate>

            <div class="row g-5">
                <div class="col-md-6">
                    <?php
                    foreach ($errors as $error) :
                        echo '<div class="alert alert-danger text-center hide"><i class="fa-solid fa-triangle-exclamation pe-2"></i>' . $error . '</div>';
                    endforeach; ?>
                    <div class="mb-3">
                        <h4>Detalles del pago</h4>
                        <hr>
                        <div class="mb-3">
                            <input type="text" class="form-control" id="name" required value="<?php echo $name ?>" name="name" placeholder="NOMBRE Y APELLIDO*">
                            <small class="text-danger name"></small>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" id="address" required value="<?php echo $address ?>" name="address" placeholder="CALLE Y NUMERO*">
                            <small class="text-danger address"></small>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" id="address1" required value="<?php echo $address1 ?>" name="address1" placeholder="COLONIA*">
                            <small class="text-danger address1"></small>
                        </div>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <input type="text" class="form-control" id="zip" required value="<?php echo $zip ?>" name="zip" placeholder="CODIGO POSTAL*">
                                <small class="text-danger zip"></small>
                            </div>
                            <div class="mb-3 col-md-6">
                                <input type="text" class="form-control" id="city" required value="<?php echo $city ?>" name="city" placeholder="CIUDAD*">
                                <small class="text-danger city"></small>
                            </div>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" id="country" required value="<?php echo $country ?>" name="country" placeholder="PAIS*">
                            <small class="text-danger country"></small>
                        </div>
                    </div>

                    <!-- Set up a container element for the button -->
                    <div id="paypal-button-container"></div>

                </div>



                <div class="col-md-6">
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

                            </div>
                            <img src="<?php echo ASSETS ?>img/verified.png" alt="">
                        </div>
                    </div>



                </div>

                <?php
                //   $sale  $_SESSION['salespot']
                // $total = $total;
                $orderid =  date('His') . rand(00, 99);
                $cartItems = count($_SESSION['cart']);
                ?>

                <input type="hidden" name="total" id="total" value="<?php echo doubleval($total) ?>">
                <input type="hidden" name="cartItems" id="cartItems" value="<?php echo $cartItems ?>">
                <input type="hidden" name="paypal" id="paypal" value="paypal">
            </div>

        </form>



</section>


<?php include 'includes/templates/indexFooter.php' ?>