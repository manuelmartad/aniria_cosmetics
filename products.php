<?php
require 'config/env.php';
require 'config/db.php';
if (!$_SESSION['login']) {
	header('location:auth/login.php');
}

$sql = "SELECT * FROM products";
$products = $conn->query($sql);

include 'includes/templates/indexHeader.php';

?>


<section class="products section bg-gray">
	<div class="container">
		<div class="row">
			<div class="title text-center">
				<h2>productos</h2>
			</div>
		</div>
		<form action="" method="post" class="col-md-6 mx-auto mb-5">
			<div class="input-group mb-3">
				<input type="text" class="form-control" name="input" placeholder="Buscar.." id="search-bar">
				<button class="btn btn-primary" type="button" id=""><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(255, 255, 255, 1);transform: ;msFilter:;">
						<path d="M10 18a7.952 7.952 0 0 0 4.897-1.688l4.396 4.396 1.414-1.414-4.396-4.396A7.952 7.952 0 0 0 18 10c0-4.411-3.589-8-8-8s-8 3.589-8 8 3.589 8 8 8zm0-14c3.309 0 6 2.691 6 6s-2.691 6-6 6-6-2.691-6-6 2.691-6 6-6z"></path>
					</svg></button>
			</div>
		</form>


		<div id="products-response"></div>
		<div class="row" id="hidden-card">
			<?php while ($product = $products->fetch_assoc()) { ?>
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
										<a type="button" class="like" data-id="<?php //echo $product['product_id'] 
																				?>"><i class="fa-solid fa-heart"></i></a>
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
				</div><!-- /.modal -->

			<?php }  ?>

		</div>

	</div>
</section>

<?php include 'includes/templates/indexFooter.php' ?>