<?php
require 'config/env.php';
require 'config/db.php';
if (!$_SESSION['login']) {
	header('location:auth/login.php');
}

$sql = "SELECT * FROM products WHERE stars <> 0 ORDER BY stars DESC LIMIT 6";
$products = $conn->query($sql);

include 'includes/templates/indexHeader.php';
// echo '<code>';
// print_r($_SERVER);
// echo '</code>';

?>

<div class="bg-image">
	<div class="p-5">
		<h1 class="d-none d-sm-block">El maquillaje es arte,<br> la belleza es espiritu</h1>
		<a type="button" id="redirect" class="btn btn-outline-primary mt-2 text-uppercase px-4"> Empieza Ahora</a>
	</div>

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
						<img src="assets//img//main-1.jpg" alt="" />
						<div class="content">
							<h3>Iluminadores</h3>
							<p>Compra maquillaje de nueva temporada</p>
						</div>
					</a>
				</div>
				<div class="category-box">
					<a href="#!">
						<img src="theme/images/shop/category/category-2.jpg" alt="" />
						<div class="content">
							<h3>Polvo Fijador</h3>
							<p>Obtenga una amplia gama de selección</p>
						</div>
					</a>
				</div>
			</div>
			<div class="col-md-6">
				<div class="category-box category-box-2">
					<a href="#!">
					<img src="assets//img//main-3.jpg" alt="" class="w-100" />
						<div class="content">
							<h3>Corrector Barra</h3>
							<p>El diseño especial es lo primero</p>
						</div>
					</a>
				</div>
			</div>
		</div>

	</div>
</section>
<!-- most liked products -->
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
							<img class="img-responsive" src="admin/products/uploads/<?php echo $product['product_image'] ?>" alt="product-img" style="height: 375px!important ;" />
							<div class="preview-meta">
								<ul class="w-25">
									<li>
										<span data-bs-toggle="modal" data-bs-target="#product-modal<?php echo $product['product_id'] ?>">
											<i class="fa-solid fa-magnifying-glass"></i> </span>
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