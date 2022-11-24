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
				<p class="copyright-text">Copyright &copy;<?php echo date('Y') ?>, Designed &amp; Developed by <a href="https://themefisher.com/">TRW71</a></p>
			</div>
		</div>
	</div>
</footer>

</div>

<!-- Main jQuery -->
<script src="theme/plugins/jquery/dist/jquery.min.js"></script>



<!-- Bootstrap 5.2 -->
<script src="<?php echo ASSETS ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
<script src="<?php echo ASSETS ?>vendor/sweetalert/sweetalert2.min.js"></script>

<script src="<?php echo JS ?>scripts.js"></script>
<!-- Main Js File -->
<script src="theme/js/script.js"></script>

<script>
	$(function() {
		const swiper = new Swiper('.swiper', {
			// Optional parameters
			direction: 'horizontal',
			loop: true,

			// spaceBetween: 200,

			// autoHeight: true,

			// If we need pagination
			pagination: {
				el: '.swiper-pagination',
			},
			effect: 'slide',
			// Navigation arrows
			navigation: {
				nextEl: '.swiper-button-next',
				prevEl: '.swiper-button-prev',
			},

			// And if we need scrollbar
			scrollbar: {
				el: '.swiper-scrollbar',
			},
			autoplay: {
				delay: 3000,
			},
			// Default parameters
			slidesPerView: 4,
			spaceBetween: 100,
			// Responsive breakpoints
			breakpoints: {
				// when window width is >= 320px
				320: {
					slidesPerView: 1,
					spaceBetween: 80
				},
				// when window width is >= 480px
				480: {
					slidesPerView: 1,
					spaceBetween: 100
				},
				// when window width is >= 640px
				640: {
					slidesPerView: 2,
					spaceBetween: 100
				}
			}
		});
	});
</script>



<script>
	$("#redirect").click(function() {
		location.href = "products.php";
	})
</script>


<script>
	paypal.Buttons({

		style: {

			layout: 'vertical',

			color: 'black',

			shape: 'rect',

			label: 'paypal',

			// tagline: horizontal
		},

		// Sets up the transaction when a payment button is clicked

		createOrder: (data, actions) => {

			return actions.order.create({

				purchase_units: [{

					amount: {

						value: <?php echo $total ?> // Can also reference a variable or function

					}

				}]

			});

		},

		// Finalize the transaction after payer approval

		onApprove: (data, actions) => {

			return actions.order.capture().then(function(orderData) {

				// Successful capture! For dev/demo purposes:

				console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));

				const transaction = orderData.purchase_units[0].payments.captures[0];

				// alert(`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`);

				// When ready to go live, remove the alert and show a success message within this page. For example:

				// const element = document.getElementById('paypal-button-container');

				// element.innerHTML = '<h3>Thank you for your payment!</h3>';

				// Or go to another URL: 
				// actions.redirect('confirmation.php');
				location.href = "confirmation.php";
			});

		}

	}).render('#paypal-button-container');
</script>



</body>

</html>