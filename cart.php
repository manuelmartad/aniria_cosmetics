<?php
require 'config/env.php';

if (!$_SESSION['login']) {
    header('location:auth/login.php');
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['productId'];

    unset($_SESSION['cart'][$id]);
    // $_SESSION['cart'] = $_SESSION['cart'];
    header("location:cart.php");
}

// echo '<pre>';
// var_dump(($_SESSION['cart']));
// echo '</pre>';
include 'includes/templates/indexHeader.php';

?>

<!-- trendy products -->
<section class="products section bg-gray">
    <div class="container">
        <?php if (!empty($_SESSION['cart'])) { ?>



            <div class="table-responsive">
                <table class="table border-dark  text-center align-middle" id="no-more-tables">
                    <thead>
                        <tr>
                            <th scope="col">Producto</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="">
                        <?php
                        $total = 0;
                        $subtotal = 0;
                        $iva = 1.16;
                        foreach ($_SESSION["cart"] as $key => $item) : ?>
                            <tr class="">
                                <td data-title="Producto"><img src="<?php echo ADMIN ?>products/uploads/<?php echo $item["productImage"] ?>" alt="" width="100" height="100"></td>
                                <td scope="row" data-title="Nombre"><?php echo $key . ' ' . $item["productName"] ?></td>
                                <td data-title="Cantidad"><?php echo $item["productQty"] ?></td>
                                <td data-title="Precio"><span>$</span><?php echo $item["productQty"] * number_format($item["productPrice"], 2) ?></td>

                                <td data-title="Acciones">
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
                            <td Total" colspan="3" class="text-end">Sub Total</td>
                            <td colspan="2" class="text-start">$<?php echo number_format($subtotal, 2) ?></td>
                        </tr>
                        <tr class="fw-bold fs-4">
                            <td colspan="3" class="text-end">Total</td>
                            <td colspan="2" class="text-start text-success">$<?php echo number_format($subtotal * $iva, 2) ?></td>

                        </tr>

                    </tfoot>
                </table>
                <div>
                    <a href="choose.php" name="cartInfo" class="btn btn-primary">Siguiente</a>
                </div>

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



<?php include 'includes/templates/indexFooter.php'; ?>