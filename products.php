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

<!-- Main Menu Section -->
<!-- <section class="menu">
		<nav class="navbar navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>

				</div>
				
				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav">

						<li class="dropdown">
							<a href="index.html">Home</a>
						</li>

						<li class="dropdown">
							<a href="admin/dashboard.php">admin</a>
						</li>

					</ul>

					<ul class="nav navbar-nav">
						<li class="dropdown">
							<a href="admin/dashboard.php">iniciar</a>
						</li>

						<li class="dropdown">
							<a href="admin/dashboard.php">registro</a>
						</li>
					</ul>
				</div>



			</div>
			</div>
		</nav>
	</section> -->

<!-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">Inicio</a>
        <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa-solid fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse d-lg-flex" id="collapsibleNavId">
            <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="#" aria-current="page">Nosotros</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin/dashboard/dashboard.php">Admin</a>
                </li>
                <li class="nav-item dropdown mt-sm-1 mt-lg-0">
                    <a class="nav-link py-2" href="#" id="dropdownId" data-bs-toggle="dropdown" aria-expanded="false">Mi Cuenta</a>
                    <div class="dropdown-menu animate__animated animate__bounceIn animate__faster" aria-labelledby="dropdownId">
                        <a class="dropdown-item" href="#">Mi Password</a>
                    </div>
                </li>
            </ul>
            <ul>
                <li class="nav-item mt-lg-0 mt-sm-1"> <a id="logout" class="dropdown-item" type="button">Cerrar sesión</a>
                </li>
            </ul>



        </div>


    </div>
</nav> -->




<!-- trendy products -->
<section class="products section bg-gray">
    <div class="container">
        <form action="" method="post" class="col-md-6  mx-auto">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Buscar.." aria-label="Button" aria-describedby="">
                <button class="btn btn-primary" type="button" id="">Buscar</button>

            </div>
        </form>
        <div class="row">
            <div class="title text-center">
                <h2>productos</h2>
            </div>
        </div>

        <div class="row">
			<?php while ($product = $products->fetch_assoc()) { ?>
				<div class="col-md-6 col-lg-4">
					<div class="product-item">
						<div class="product-thumb">
							<span class="bage">Sale</span>
							<img class="img-responsive" src="admin/products/uploads/<?php echo $product['product_image'] ?>" alt="product-img" style="height: 300px!important ;" />
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
											<p class="fs-3 my-3 text-dark">$<?php echo number_format($product['product_price'],2) ?></p>
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