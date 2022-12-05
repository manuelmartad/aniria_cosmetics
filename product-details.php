<?php
require 'config/env.php';
require 'config/db.php';
if (!$_SESSION['login']) {
    header('location:auth/login.php');
}

if ($_GET['productId']) {
    $id = $_GET['productId'];

    $sql = "SELECT a.*, b.category_name FROM products a
    JOIN categories b ON a.category_id = b.category_id
    WHERE a.product_id  = '$id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc(); // fetch data 
        // echo '<pre>';
        // var_dump($product);
        // echo '</pre>';

        // $_SESSION['commentid'] = $product['product_id'];
    }
    // else {
    //     $sql = "SELECT a.*, b.category_name FROM products a
    //     JOIN categories b ON a.category_id = b.category_id
    //     WHERE a.product_id  = '$id'";
    //     $result = $conn->query($sql);
    //     $product = $result->fetch_all(); // fetch data 
    // }



    // $product_name = $product[1];

} else {
    header("location:404.html");
}




include 'includes/templates/indexHeader.php';

?>


<section class="single-product">
    <div class="container">

        <div class="row mt-3">
            <div class="col-md-5">
                <div class="single-product-slider">
                    <div id='carousel-custom' class='carousel slide' data-ride='carousel'>
                        <div class='carousel-outer'>
                            <!-- me art lab slider -->
                            <div class='carousel-inner'>
                                <div class='item active'>
                                    <img src="admin/products/uploads/<?php echo $product['product_image'] ?>" style="height:475px!important;width:100%!important" alt=''>
                                </div>

                            </div>

                        </div>


                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="single-product-details mt-3">

                    <h2><?php echo $product['product_name'] ?></h2>
                    <p class="product-price">$<?php echo $product['product_price'] ?></p>

                    <p class="product-description mt-2">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laborum ipsum dicta quod, quia doloremque aut deserunt commodi quis. Totam a consequatur beatae nostrum, earum consequuntur? Eveniet consequatur ipsum dicta recusandae.
                    </p>


                    <div class="mt-3">
                        <ul>
                            <li id="numlikes" class="mb-3">
                                <?php $likes = $conn->query("SELECT * FROM likes WHERE product_id = {$product['product_id']} AND user_id = {$_SESSION['id']}");
                                if ($likes->num_rows > 0) {
                                    echo '<a type="button">';
                                    echo "<i id='icon' class='bx bx-heart fs-1 text-danger bxs-heart'></i>";
                                    echo '</a>';
                                    $fetchLikes = $conn->query("SELECT COUNT(likes) AS LOVE FROM likes WHERE product_id = {$product['product_id']} AND user_id != {$_SESSION['id']} ");
                                    $numlikes = $fetchLikes->fetch_column();
                                    if ($numlikes > 1) {
                                        echo "<span> A ti y a " . $numlikes  . " personas les gusta este producto</span>";
                                    } else {
                                        echo "<span>Te gusta este producto</span>";
                                    }
                                } else {
                                    echo '<a disabled type="button" id="like" data-id="' . $product['product_id'] . '">';
                                    echo "<i id='icon' class='bx bx-heart fs-2'></i>";
                                    echo '</a>';
                                } ?>
                            </li>
                        </ul>
                    </div>
                    <!-- <p class="my-3 text-dark"> <span id="like_counter"></span></p> -->

                    <div class="d-flex gap-3">
                        <p>Categoria:</p>
                        <ul class="ms-0 ps-0">
                            <li><a href="#"><?php echo $product['category_name'] ?></a></li>

                        </ul>

                    </div>

                    <form method="post" id="form_cart">
                        <input type="hidden" name="productId" value="<?php echo $product['product_id'] ?>">
                        <input type="hidden" name="productPrice" value="<?php echo $product["product_price"] ?>">
                        <input type="hidden" name="productName" value="<?php echo $product["product_name"] ?>">
                        <input type="hidden" name="productImage" value="<?php echo $product["product_image"] ?>">
                        <div class="d-flex gap-3 align-items-center">
                            <p>Cantidad:</p>
                            <input type="number" name="productQty" value="1" min="1" max="20" class="form-control form-control-sm w-25 mb-3">
                        </div>
                        <button type="submit" class="btn btn-primary my-3 px-4"><i class="fa-solid fa-cart-shopping pe-2"></i>Agregar al Carrito</button>
                    </form>
                    <!-- <a href="cart.html" class="btn btn-primary mt-2">Agregar al carrito</a> -->

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="mt-3">
                    <div class="border ps-3 pe-2 p-5">
                        <div id="comment-section">

                            <?php
                            $comments = $conn->query("SELECT a.*, b.* FROM comments a
                            JOIN users b ON a.user_id = b.id 
                            WHERE product_id = '$id' ORDER BY date ASC");
                            foreach ($comments as $comment) : // fetch data 
                                // var_dump($_SESSION);

                            ?>
                                <ul class="d-flex align-content-center gap-3">
                                    <li><img src="admin///users//uploads/<?php echo $comment['image'] ?>" style="border-radius:50% ;" alt="" width="60" height="60"></li>
                                    <li>
                                        <p class="mb-1"><?php echo $comment['fname'] . ' ' . $comment['lname'] ?></p>
                                        <span><?php echo $comment['date'] ?></span>
                                        <p class="text-justify">
                                            <?php echo $comment['comment_text'] ?>
                                        </p>
                                    </li>
                                </ul>
                            <?php endforeach; ?>
                        </div>

                        <div class="mb-3 pe-2">
                            <form method="post" id="comment-form">
                                <input type="hidden" name="productid" value="<?php echo $product['product_id'] ?>">
                                <input type="hidden" name="userid" value="<?php echo $_SESSION['id'] ?>">
                                <div class="mb-3">
                                    <input type="text" class="form-control form-control-sm" name="comment" id="comment" placeholder="Agregar un comentario..">
                                </div>
                                <div class="position-relative pb-1">
                                    <button type="submit" class="btn btn-primary position-absolute end-0">Comentar</button>
                                </div>
                            </form>

                        </div>

                    </div>
                </div>
            </div>


        </div>
    </div>
</section>




<?php include 'includes/templates/indexFooter.php' ?>