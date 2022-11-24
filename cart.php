<?php
require 'config/env.php';

include 'includes/templates/indexHeader.php';
if (!$_SESSION['login']) {
    header('location:auth/login.php');
}


if (isset($_POST['productId'])) {
    $id = $_POST['productId'];

    unset($_SESSION['cart'][$id]);
}

// var_dump($_SESSION['cart']);

?>

<!-- trendy products -->
<section class="products section bg-gray">
    <div class="container">
        <?php if (!empty($_SESSION['cart'])) { ?>



            <div class="table-responsive">
                <table class="table table-bordered border-dark border-2 border text-center align-middle" id="cartTable">
                    <thead>
                        <tr>
                            <th scope="col">Producto</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total = 0;
                        $subtotal = 0;
                        $iva = 1.16;
                        foreach ($_SESSION["cart"] as $key => $item) : ?>
                            <tr class="">
                                <td><img src="<?php echo ADMIN ?>products/uploads/<?php echo $item["productImage"] ?>" alt="" width="100" height="100"></td>
                                <td scope="row"><?php echo $key . ' ' . $item["productName"] ?></td>
                                <td><?php echo $item["productQty"] ?></td>
                                <td><span>$</span><?php echo $item["productQty"] * number_format($item["productPrice"], 2) ?></td>

                                <td>
                                    <form method="POST">
                                        <input type="hidden" name="productId" value="<?php echo $item['productId'] ?>">
                                        <button type="submit" class="text-danger btn btn-link">Eliminar</button>
                                    </form>

                                </td>
                                <?php $subtotal = $subtotal + ($item["productQty"] * number_format($item["productPrice"], 2)); ?>
                            </tr> <?php
                                endforeach; ?>

                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-end">IVA</td>
                            <td colspan="2" class="text-start text-success">16%</td>
                        </tr>
                        <tr class="fw-bold fs-5">
                            <td colspan="3" class="text-end">Sub Total</td>
                            <td colspan="2" class="text-start">$<?php echo number_format($subtotal, 2) ?></td>
                        </tr>

                        <tr class="fw-bold fs-4">
                            <td colspan="3" class="text-end">Total</td>
                            <td colspan="2" class="text-start text-success">$<?php echo number_format($subtotal * $iva, 2) ?></td>

                        </tr>

                        <?php
                        // $total = number_format($subtotal * $iva, 2);
                        // $orderid =  date('His') . rand(1111, 9999);
                        // $cartItems = count($_SESSION['cart']);
                        // $buyerName = $_SESSION['name'];
                        // echo $orderid . '<br>';
                        // echo $cartItems . '<br>';
                        // echo $total . '<br>';
                        // echo $buyerName;


                        ?>
                    </tfoot>
                </table>
                <a href="checkout.php" name="cartInfo" class="btn btn-primary float-end">Siguiente</a>

                <!-- <form action="response.php" method="post">
                    <input type="hidden" name="total" value="<?php echo $total ?>">
                    <input type="hidden" name="orderId" value="<?php echo $orderid ?>">
                    <input type="hidden" name="cartItems" value="<?php echo $cartItems ?>">
                    <input type="hidden" name="buyerName" value="<?php echo $buyerName ?>">
                    <button type="submit" name="cartInfo" class="btn btn-primary float-end">Siguiente</button>
                </form> -->


            </div>
        <?php   } else { ?>
            <section class="empty-cart page-wrapper">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="block text-center">
                                <i class="tf-ion-ios-cart-outline"></i>
                                <h2 class="text-center">Su carrito está vacío.</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, sed.</p>
                                <a href="index.php" class="btn btn-primary mt-20">Volver a la tienda</a>
                            </div>
                        </div>
                    </div>
            </section> <?php } ?>
    </div>
</section>



<footer class="footer section text-center">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class="social-media">
                    <li>
                        <a href="https://www.facebook.com/">
                            <i class="fa-brands fw-bold fa-facebook-f"></i>
                    </li>
                    <li>
                        <a href="https://www.instagram.com/">
                            <i class="fa-brands fw-bold fa-instagram"></i> </a>
                    </li>
                </ul>
                <p class="copyright-text">Copyright &copy;<?php echo date('Y') ?>, Designed &amp; Developed by <a href="https://themefisher.com/">Manuel Marta</a></p>
            </div>
        </div>
    </div>
</footer>

</div>

<!-- Main jQuery -->
<script src="theme/plugins/jquery/dist/jquery.min.js"></script>

<!-- Main Js File -->
<script src="theme/js/script.js"></script>

<!-- Bootstrap 5.2 -->
<script src="<?php echo ASSETS ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
<script src="<?php echo ASSETS ?>vendor/sweetalert/sweetalert2.min.js"></script>

<script src="<?php echo JS ?>scripts.js"></script>

<script>
    $(function() {
        $("#checkout").click(function(e) {
            // e.preventDefault();
            location.href = "checkout.php";
        });
    });
</script>


</body>

</html>