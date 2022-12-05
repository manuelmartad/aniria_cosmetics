<?php
require 'config/env.php';
require 'config/db.php';

$errors = [];

var_dump($_SESSION['spot']);
// exit;

if (isset($_POST['spot'])) {
    $_SESSION['spot'] = $_POST['spot'];
    foreach ($_SESSION['cart'] as $item) {
        // echo '<pre>';
        // var_dump($item);
        // echo '</pre>';
        $q = $conn->query("SELECT a.product_id, a.product_name, b.quantity, b.spot_id FROM products a
    JOIN product_spot b ON a.product_id = b.product_id 
    WHERE a.product_id = '{$item['productId']}' and spot_id = '{$_POST['spot']}'");
        $d = $q->fetch_assoc();

        if ($item['productQty'] > $d['quantity']) {
            $errors[] = "No hay stock para el producto {$d['product_name']}";
        }
    }
    if (empty($errors)) {
        header('location:checkout.php');
    }
}



include 'includes/templates/indexHeader.php';
?>
<div class="container">
    <div class="p-3">
        <h3 class="text-center p-3">Elige tu punto de venta mas cercano</h3>
        <div class="text-center my-5 p-3">
            <?php foreach ($errors as $error) {
                echo '<div class="alert alert-danger" role="alert">
                  <small>' . $error . ' en punto de venta ' . $_SESSION['spot'] . '</small>
              </div>';
            } ?>

            <div class="row">
                <?php
                $sql = "SELECT * FROM sale_spot";
                $r = $conn->query($sql);
                if ($r->num_rows > 0) :
                    while ($d = $r->fetch_assoc()) : ?>
                        <div class="col-md-6 p-3">
                            <form method="post">
                                <input type="hidden" name="spot" value="<?php echo $d['spot_id'] ?>">
                                <h4><?php echo $d['sale_spot'] ?></h4>
                                <button type="submit" class="btn btn-link">
                                    <img src="assets//img//aniria.jpg" alt="" width="500" height="300" class="rounded-3 img-fluid">
                                </button>
                                <div class="mt-3">
                                    <h6><?php echo $d['spot_address'] ?></h6>
                                </div>
                            </form>
                        </div>
                <?php endwhile;
                else :
                    echo "No hay puntos de venta registrados..";
                endif ?>
            </div>
        </div>

    </div>
</div>





<?php include 'includes/templates/indexFooter.php';
?>