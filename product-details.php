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
                                    <img src="admin/products/uploads/<?php echo $product['product_image'] ?>" alt='' data-zoom-image="admin/products/uploads/<?php echo $product['product_image'] ?>" />
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


                    <div class="product-quantity">
                        <span>Cantidad:</span>
                        <div class="product-quantity-slider">
                            <input id="product-quantity" class="form-control" type="number" value="1" min="1" max="20" name="product-quantity">
                        </div>
                    </div>
                    <div class="product-category">
                        <span>Categoria:</span>
                        <ul class="ms-0 ps-0">
                            <li><a href="#"><?php echo $product['category_name'] ?></a></li>

                        </ul>

                    </div>
                    <div class="mt-3">
                        <ul>
                            <li>
                                <a type="button" class="like" data-id="<?php echo $product['product_id'] ?>"><i class="fa-solid fa-heart fs-3"></i></a>
                            </li>
                        </ul>
                    </div>
                    <p class="my-3 text-dark"> <span id="like_counter"></span></p>

                    <a href="cart.html" class="btn btn-primary mt-2">Agregar al carrito</a>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="mt-3">
                    <div class="border ps-3 pe-2 p-5">
                        <div id="comment-section">

                            <?php
                            $comments = $conn->query("SELECT * FROM comments WHERE product_id = '$id'");
                            foreach ($comments as $comment) : // fetch data 
                                // var_dump($comment);

                            ?>
                                <ul class="d-flex align-content-center gap-3">
                                    <li><img src="theme//images//blog//avater-1.jpg" style="border-radius:50% ;" alt="" width="60" height="60"></li>
                                    <li>
                                        <p class="mb-1">Manuel Marta</p>
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