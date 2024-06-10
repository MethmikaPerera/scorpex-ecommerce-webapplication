<?php
session_start();

require "connection.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Home | Scorpex Clothing</title>
	<link rel="icon" href="assets/img/favicon.png" type="image/x-icon">

	<link rel="stylesheet" href="assets/css/bootstrap.css">

	<link rel="stylesheet" href="assets/fonts/fontawesome-free-6.4.2-web/css/fontawesome.min.css">
	<link rel="stylesheet" href="assets/fonts/fontawesome-free-6.4.2-web/css/all.css">
	<link rel="stylesheet" href="assets/fonts/iconic/css/material-design-iconic-font.min.css">
	<link rel="stylesheet" href="assets/fonts/linearicons-v1.0.0/icon-font.min.css">

	<link rel="stylesheet" href="Vendor/animate/animate.css">
	<link rel="stylesheet" href="Vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" href="Vendor/animsition/css/animsition.min.css">
	<link rel="stylesheet" href="Vendor/slick/slick.css">
	<link rel="stylesheet" href="Vendor/sweetalert/sweetalert2.min.css">

	<link rel="stylesheet" href="assets/css/util.css">
	<link rel="stylesheet" href="assets/css/main.css">
	<link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="animsition">

	<?php
	require "index-header.php";
	?>

	<!-- Slider -->
	<section class="section-slide">
		<div class="wrap-slick1">
			<div class="slick1">
				<div class="item-slick1" style="background-image: url(assets/img/slide-01.jpg);">
					<div class="container h-full">
						<div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
							<div class="layer-slick1 animated visible-false" data-appear="fadeInDown" data-delay="0">
								<span class="ltext-101 cl2 respon2">
									Men Polo Collection
								</span>
							</div>

							<div class="layer-slick1 animated visible-false" data-appear="fadeInDown" data-delay="100">
								<h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1">
									New Arrivals
								</h2>
							</div>

							<div class="layer-slick1 animated visible-false" data-appear="zoomIn" data-delay="200">
								<a href="products.php" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 text-decoration-none">
									Shop Now
								</a>
							</div>
						</div>
					</div>
				</div>

				<div class="item-slick1" style="background-image: url(assets/img/slide-02.jpg);">
					<div class="container h-full">
						<div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
							<div class="layer-slick1 animated visible-false" data-appear="fadeInDown" data-delay="0">
								<span class="ltext-101 cl2 respon2">
									Chinese Collar
								</span>
							</div>

							<div class="layer-slick1 animated visible-false" data-appear="fadeInDown" data-delay="100">
								<h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1">
									NEW Collection
								</h2>
							</div>

							<div class="layer-slick1 animated visible-false" data-appear="zoomIn" data-delay="200">
								<a href="products.php" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 text-decoration-none">
									Coming Soon
								</a>
							</div>
						</div>
					</div>
				</div>

				<div class="item-slick1" style="background-image: url(assets/img/slide-03.jpg);">
					<div class="container h-full">
						<div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
							<div class="layer-slick1 animated visible-false" data-appear="fadeInDown" data-delay="0">
								<span class="ltext-101 cl2 respon2">
									Men New-Season
								</span>
							</div>

							<div class="layer-slick1 animated visible-false" data-appear="fadeInDown" data-delay="100">
								<h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1">
									Casual Shirts
								</h2>
							</div>

							<div class="layer-slick1 animated visible-false" data-appear="zoomIn" data-delay="200">
								<a href="products.php" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 text-decoration-none">
									Coming Soon
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Product -->
	<section class="bg0 p-t-23 p-b-140 mt-5">
		<div class="container">
			<div class="p-b-50">
				<h3 class="ltext-103 cl5 text-decoration-underline">
					Latest Products
				</h3>
			</div>

			<?php
			$select_rs = Database::search("SELECT * FROM `product` WHERE `status_id`='1' ORDER BY `id` DESC LIMIT 4");
			$select_num = $select_rs->num_rows;
			?>

			<div class="row isotope-grid">

				<?php
				for ($x = 0; $x < $select_num; $x++) {
					$select_data = $select_rs->fetch_assoc();
				?>

					<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item">
						<!-- Block2 -->
						<div class="block2">
							<div class="block2-pic hov-img0">

								<?php

								$select_img_rs = Database::search("SELECT * FROM `product_images` WHERE `product_id`='" . $select_data["id"] . "'");
								$select_img_data = $select_img_rs->fetch_assoc();

								?>

								<img src="assets/<?php echo $select_img_data["code"]; ?>" alt="IMG-PRODUCT">

								<a href='<?php echo "viewProduct.php?id=" . ($select_data["id"]); ?>' class="block2-btn flex-c-m stext-103 cl0 size-102 bg1 bor2 hov-btn1 p-lr-15 trans-04">View Product</a>

							</div>

							<span class="position-absolute top-0 start-50 translate-middle badge rounded-pill bg-danger fs-15">
								NEW ARRIVAL
							</span>

							<div class="block2-txt flex-w flex-t p-t-14">
								<div class="block2-txt-child1 flex-col-l ">
									<a href='<?php echo "viewProduct.php?id=" . ($select_data["id"]); ?>' class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
										<?php echo $select_data["title"]; ?>
									</a>

									<span class="stext-105 cl3">
										LKR <?php echo $select_data["price"]; ?>.00
									</span>
								</div>

								<div class="block2-txt-child2 flex-r p-t-3">
									<?php
									if (isset($_SESSION["u"])) {
										$session_data = $_SESSION["u"];

										$uw_rs = Database::search("SELECT * FROM `watchlist` WHERE `user_id`='" . $session_data["id"] . "' AND `product_id`='" . $select_data["id"] . "'");
										$uw_num = $uw_rs->num_rows;

										if ($uw_num > 0) {
											$uw_data = $uw_rs->fetch_assoc();
									?>
											<a href="#" class="btn-addwish-b2 dis-block pos-relative text-danger text-decoration-none" onclick="removeFromWatchlist(<?php echo $uw_data['id'] ?>);">
												<i class="fas fa-heart icon-heart1 dis-block trans-04"></i>
												<i class="fas fa-heart-broken icon-heart2 dis-block trans-04 ab-t-l"></i>
											</a>
										<?php
										} else {
										?>
											<a href="#" class="btn-addwish-b2 dis-block pos-relative text-danger text-decoration-none" onclick="addToWatchlist(<?php echo $select_data['id'] ?>);">
												<i class="far fa-heart icon-heart1 dis-block trans-04"></i>
												<i class="fab fa-gratipay icon-heart2 dis-block trans-04 ab-t-l"></i>
											</a>
										<?php
										}
									} else {
										?>
										<a href="#" class="btn-addwish-b2 dis-block pos-relative text-danger text-decoration-none" onclick="addToWatchlist(<?php echo $select_data['id'] ?>);">
											<i class="far fa-heart icon-heart1 dis-block trans-04"></i>
											<i class="fas fa-heart icon-heart2 dis-block trans-04 ab-t-l"></i>
										</a>
									<?php
									}
									?>
								</div>
							</div>
						</div>
					</div>

				<?php
				}
				?>

			</div>

			<!-- Shop more -->
			<div class="flex-c-m flex-w w-full p-t-45">
				<a href="products.php" class="flex-c-m stext-101 cl0 size-103 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer text-decoration-none">
					Shop More
				</a>
			</div>
		</div>
	</section>

	<?php
	require "footer.php";
	?>


	<!--===============================================================================================-->
	<script src="Vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="Vendor/animsition/js/animsition.min.js"></script>
	<script src="Vendor/bootstrap/js/popper.js"></script>
	<script src="Vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
	<script src="Vendor/slick/slick.min.js"></script>
	<script src="assets/js/slick-custom.js"></script>
	<!--===============================================================================================-->
	<script src="Vendor/parallax100/parallax100.js"></script>
	<script>
		$('.parallax100').parallax100();
	</script>
	<!--===============================================================================================-->
	<script src="Vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>
	<script>
		$('.gallery-lb').each(function() { // the containers for all your galleries
			$(this).magnificPopup({
				delegate: 'a', // the selector for gallery item
				type: 'image',
				gallery: {
					enabled: true
				},
				mainClass: 'mfp-fade'
			});
		});
	</script>
	<!--===============================================================================================-->
	<script src="Vendor/isotope/isotope.pkgd.min.js"></script>
	<!--===============================================================================================-->
	<script src="Vendor/sweetalert/sweetalert2.all.min.js"></script>
	<!--===============================================================================================-->
	<script src="assets/js/main.js"></script>

	<script src="assets/js/script.js"></script>
	<script src="assets/js/bootstrap.js"></script>
	<script src="assets/js/bootstrap.bundle.js"></script>
</body>

</html>