<?php
require_once "config/db.php";
require_once "config/funciones.php";
session_start();

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $sql = "DELETE FROM products WHERE product_id = $id";
    $conn->query($sql);

    // $msg = json_encode("El usuario ha sido bloqueado");
    // echo trim($msg, '"');
    $_SESSION["success"] = '<div class="alert alert-success alert-dismissible show text-center" role="alert">
        <small> <i class="fa-solid fa-check"></i>Usuario Eliminado</small>
    </div>';

    echo json_encode($_SESSION["success"]);
}

if (isset($_POST['productId'])) {
    $productId = $_POST['productId'];

    $sql = "UPDATE products SET stars = stars + 1 WHERE product_id = '$productId'";
    if ($conn->multi_query($sql)) {
        echo 200;
    }
}



if (isset($_POST['comment'])) {
    $com = $_POST['comment'];
    $id = $_POST['productid'];
    $userid = $_POST['userid'];
    $date = date("F j, Y, g:i a");

    $sql = "INSERT INTO comments(comment_text, date, product_id, user_id) VALUES('$com', '$date', '$id', '$userid')";
    if ($conn->query($sql)) {
        echo 200;
    }
}

if (isset($_POST['input'])) {
    $input = $_POST['input'];

    $result = $conn->query("SELECT * FROM products WHERE product_name LIKE '%{$input}%'");
    // $data = $result->fetch_assoc();

    if ($result->num_rows > 0) { ?>
        <div class="row">
            <?php while ($product = $result->fetch_assoc()) : ?>
                <div class="col-md-6 col-lg-4">
                    <div class="product-item">
                        <div class="product-thumb">
                            <span class="bage">Sale</span>
                            <img class="img-responsive" src="admin/products/uploads/<?php echo $product['product_image'] ?>" alt="product-img" style="height: 375px!important ;" />
                            <div class="preview-meta">
                                <ul class="w-25">
                                    <li>
                                        <span data-bs-toggle="modal" data-bs-target="#product-modal<?php echo $product['product_id'] ?>">
                                            <i class="fa-solid fa-magnifying-glass"></i> </span>
                                    </li>
                                    <!-- <li>
                                    <a type="button" class="like" data-id="<?php echo $product['product_id'] ?>"><i class="fa-solid fa-heart"></i></a>
                                </li> -->
                                    <li>
                                        <a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="product-content">
                            <h4><a href="#"><?php echo $product['product_name'] ?></a></h4>
                            <p class="price">$<?php echo $product['product_price'] ?></p>
                        </div>
                    </div>
                </div>


                <!-- Modal -->
                <div class="modal product-modal fade" id="product-modal<?php echo $product['product_id'] ?>" role="dialog" tabindex="-1">

                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                            <div class="text-end">
                                <button type="button" class="btn-close float-right p-3" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body mt-0 pt-0">

                                <div class="row">
                                    <div class="col-md-8 col-sm-6 col-xs-12">
                                        <div>
                                            <img class="img-fluid" src="admin/products/uploads/<?php echo $product['product_image'] ?>" alt="product-img">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                        <div class="mt-3">
                                            <h2 class="fs-2"><?php echo $product['product_name'] ?></h2>
                                            <p class="my-3 text-dark"> <span>A <?php echo $product['stars'] ?> </span>les gusta este producto</p>
                                            <p class="fs-3 my-3 text-dark">$<?php echo number_format($product['product_price'], 2) ?></p>
                                            <p class="text-justify fs-6">
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem iusto nihil cum. Illo laborum numquam rem aut officia dicta cumque.
                                            </p>
                                            <form method="post" id="form_cart">
                                                <input type="hidden" name="productId" value="<?php echo $product['product_id'] ?>">
                                                <input type="hidden" name="productPrice" value="<?php echo $product["product_price"] ?>">
                                                <input type="hidden" name="productName" value="<?php echo $product["product_name"] ?>">
                                                <input type="hidden" name="productImage" value="<?php echo $product["product_image"] ?>">
                                                <input type="number" name="productQty" value="1" min="1" max="20" class="form-control form-control-sm w-50">
                                                <button type="submit" class="btn btn-primary my-3 px-4"><i class="fa-solid fa-cart-shopping pe-2"></i>Agregar al Carrito</button>
                                            </form>
                                            <a href="product-details.php?productId=<?php echo $product['product_id'] ?>" class="btn btn-link ps-0">Ver Detalles del Producto</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php endwhile;  ?>

        </div>
    <?php } else { ?>
        <div class="text-center">
            <p class="text-light bg-danger p-3 w-100">No hay nada relacionado con tu busqueda..</p>
            <!-- <i class='bx bx-sad' style="font-size:180px;"></i> -->
            <svg class="w-6 h-6" width="250" height="250" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        </div>
<?php }
} ?>