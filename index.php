<?php
require 'config/env.php';
require 'config/db.php';
if (!$_SESSION['login']) {
	header('location:auth/login.php');
}

$sql = "SELECT * FROM products WHERE stars <> 0 ORDER BY stars DESC LIMIT 6";
$products = $conn->query($sql);

include 'includes/templates/indexHeader.php';

?>

<div class="bg-image">
	<div style="padding: 150px 100px;" class="d-none d-sm-block">
		<h1>El maquillaje es arte,<br> la belleza es espiritu</h1>
		<a type="button" id="redirect" class="btn btn-outline-primary mt-2 text-uppercase px-4"> Empieza Ahora</a>
	</div>

</div>
<!-- 
<div id="carouselId" class="carousel slide" data-bs-ride="carousel">
	<ol class="carousel-indicators">
		<li data-bs-target="#carouselId" data-bs-slide-to="0" class="active" aria-current="true" aria-label="First slide"></li>
		<li data-bs-target="#carouselId" data-bs-slide-to="1" aria-label="Second slide"></li>
	</ol>
	<div class="carousel-inner" role="listbox">
		<div class="carousel-item active">
			<img src="assets//img//hero-bg2.jpg" class="w-100 d-block" alt="First slide">
		</div>
		<div class="carousel-item">
			<img src="assets///img///hero2.jpg" class="w-100 d-block" alt="Second slide">
		</div>
	
	</div>
	<button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
		<span class="visually-hidden">Previous</span>
	</button>
	<button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
		<span class="carousel-control-next-icon" aria-hidden="true"></span>
		<span class="visually-hidden">Next</span>
	</button>
</div> -->

<!-- Add Swiper HTML Layout
Now, we need to add basic Swiper layout to our app: -->

<!-- Slider main container -->
<div class="swiper">
	<!-- Additional required wrapper -->
	<div class="swiper-wrapper text-center">
		<!-- Slides -->
		<?php while ($producto = $products->fetch_array()) : ?>

			<div class="swiper-slide p-5">
				<img src="admin/products/uploads/<?php echo $producto['product_image'] ?>" alt="product-img" height="400" width="400" />
			</div>
			<?php endwhile; ?>
			<!-- <div class="swiper-slide">Slide 2</div>
			<div class="swiper-slide">Slide 3</div> -->
	</div>
	<!-- If we need pagination -->
	<!-- <div class="swiper-pagination"></div> -->

	<!-- If we need navigation buttons -->
	<div class="swiper-button-prev"></div>
	<div class="swiper-button-next"></div>

	<!-- If we need scrollbar -->
	<!-- <div class="swiper-scrollbar"></div> -->
</div>

<!-- product categories -->
<section class="product-category section bg-linear">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="title text-center">
					<h2>categoria de productos</h2>
				</div>
			</div>
			<div class="col-md-6">
				<div class="category-box">
					<a href="#!">
						<img src="theme/images/shop/category/category-1.jpg" alt="" />
						<div class="content">
							<h3>Clothes Sales</h3>
							<p>Shop New Season Clothing</p>
						</div>
					</a>
				</div>
				<div class="category-box">
					<a href="#!">
						<img src="theme/images/shop/category/category-2.jpg" alt="" />
						<div class="content">
							<h3>Smart Casuals</h3>
							<p>Get Wide Range Selection</p>
						</div>
					</a>
				</div>
			</div>
			<div class="col-md-6">
				<div class="category-box category-box-2">
					<a href="#!">
						<img src="theme/images/shop/category//test.jpg" alt="" />
						<div class="content">
							<h3>Jewellery</h3>
							<p>Special Design Comes First</p>
						</div>
					</a>
				</div>
			</div>
		</div>

	</div>
</section>
<!-- trendy products -->
<section class="products section bg-gray">
	<div class="container">
		<div class="row">
			<div class="title text-center">
				<h2>productos en tendencia</h2>
			</div>
		</div>

		<div class="row">
			<?php while ($product = $products->fetch_assoc()) { ?>
				<div class="col-md-6 col-lg-4">
					<div class="product-item">
						<div class="product-thumb">
							<span class="bage">Sale</span>
							<img class="img-responsive" src="admin/products/uploads/<?php echo $product['product_image'] ?>" alt="product-img" style="height: 400px!important ;" />
							<div class="preview-meta">
								<ul class="w-25">
									<li>
										<span data-bs-toggle="modal" data-bs-target="#product-modal<?php echo $product['product_id'] ?>">
											<i class="fa-solid fa-magnifying-glass"></i> </span>
									</li>
									<li>
										<a type="button" class="like" data-id="<?php echo $product['product_id'] ?>"><i class="fa-solid fa-heart"></i></a>
									</li>
									<li>
										<a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a>
									</li>
								</ul>
							</div>
						</div>
						<div class="product-content">
							<h4><a href="product-single.html">Reef Boardsport</a></h4>
							<p class="price">$200</p>
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
											<a href="#" class="btn btn-link ps-0">Ver Detalles del Producto</a>
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