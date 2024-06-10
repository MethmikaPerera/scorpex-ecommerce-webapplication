<!-- Footer -->
<footer class="bg3 p-t-75 p-b-32">
	<div class="container">
		<div class="row">
			<div class="col-sm-6 col-lg-3 p-b-50">
				<h4 class="stext-301 cl0 p-b-30">
					Categories
				</h4>

				<ul>
					<?php
					$cat_rs = Database::search("SELECT * FROM `category` LIMIT 4");
					$cat_n = $cat_rs->num_rows;

					for ($i = 0; $i < $cat_n; $i++) {
						$cat_d = $cat_rs->fetch_assoc();
					?>
						<li>
							<a href="products.php" class="stext-107 cl7 hov-cl1 trans-04">
								<?php echo $cat_d["name"]?>
							</a>
						</li>

					<?php
					}
					?>
				</ul>
			</div>

			<div class="col-sm-6 col-lg-3 p-b-50">
				<h4 class="stext-301 cl0 p-b-30">
					Useful Links
				</h4>

				<ul>
					<li>
						<a href="index.php" class="stext-107 cl7 hov-cl1 trans-04">
							Home
						</a>
					</li>

					<li>
						<a href="products.php" class="stext-107 cl7 hov-cl1 trans-04">
							Products
						</a>
					</li>

					<li>
						<a href="watchlist.php" class="stext-107 cl7 hov-cl1 trans-04">
							Watchlist
						</a>
					</li>

					<li>
						<a href="cart.php" class="stext-107 cl7 hov-cl1 trans-04">
							Cart
						</a>
					</li>
				</ul>
			</div>

			<div class="col-sm-12 col-md-6 col-lg-3 p-b-50">
				<h4 class="stext-301 cl0 p-b-30">
					GET IN TOUCH
				</h4>

				<p class="stext-107 cl7 size-201 text-center text-md-start col-12">
					Any questions? Let us know.
				</p>

				<div class="p-t-18">
					<a href="contact.php" class="text-decoration-none">
						<button class="flex-c-m stext-101 cl0 size-103 bg1 bor1 hov-btn2 p-lr-15 trans-04">
							Contact Us
						</button>
					</a>
				</div>
			</div>

			<div class="col-sm-12 col-md-6 col-lg-3 p-b-50">
				<h4 class="stext-301 cl0 p-b-30">
					Newsletter
				</h4>

				<div>
					<div class="wrap-input1 w-full p-b-4">
						<input class="input1 bg-none plh1 stext-107 cl7" type="text" name="email" placeholder="email@scorpex.com" id="newsletteremail">
						<div class="focus-input1 trans-04"></div>
					</div>

					<div class="p-t-18">
						<button class="flex-c-m stext-101 cl0 size-103 bg1 bor1 hov-btn2 p-lr-15 trans-04" onclick="newslettersubs();">
							Subscribe
						</button>
					</div>
				</div>
			</div>
		</div>

		<div class="p-t-40">
			<div class="foot-logo mb-2"></div>
			<p class="stext-107 cl6 txt-center">Copyright &copy;2024 | All rights reserved.</p>
		</div>
	</div>
</footer>

<!-- Back to top -->
<div class="btn-back-to-top" id="myBtn">
	<span class="symbol-btn-back-to-top">
		<i class="fa-solid fa-chevron-up"></i>
	</span>
</div>