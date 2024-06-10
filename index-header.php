<!-- Header -->
<header>
	<!-- Header desktop -->
	<div class="container-menu-desktop">
		<!-- Topbar -->
		<div class="top-bar">
			<div class="content-topbar flex-sb-m h-full container">
				<div class="left-top-bar">
					"Beyond Trends, Beyond Ordinary"
				</div>

				<div class="right-top-bar flex-w h-full">
					<?php
					if (isset($_SESSION["u"])) {
						$session_data = $_SESSION["u"];
					?>
						<a href="userProfile.php" class="flex-c-m trans-04 p-lr-25">
							<?php echo $session_data["fname"] . " " . $session_data["lname"]; ?>
						</a>

						<a class="flex-c-m trans-04 p-lr-25 text-danger" style="cursor: pointer;" onclick="signout();">
							Logout
						</a>

					<?php
					} else {
					?>
						<a href="account-log.php" class="flex-c-m trans-04 p-lr-25">
							Register or Sign In
						</a>
					<?php
					}
					?>
				</div>
			</div>
		</div>

		<div class="wrap-menu-desktop">
			<nav class="limiter-menu-desktop container">

				<!-- Logo desktop -->
				<a href="index.php">
					<img class="logo" src="assets/img/logo-text-black.png" alt="IMG-LOGO" style="height: 50px;">
				</a>

				<!-- Menu desktop -->
				<div class="menu-desktop">
					<ul class="main-menu">
						<li>
							<a href="index.php" class="text-decoration-none">Home</a>
						</li>

						<li>
							<a href="products.php" class="text-decoration-none">Shop</a>
						</li>

						<li>
							<a href="about.php" class="text-decoration-none">About</a>
						</li>

						<li>
							<a href="contact.php" class="text-decoration-none">Contact</a>
						</li>
					</ul>
				</div>

				<!-- Icon header -->
				<div class="wrap-icon-header flex-w flex-r-m">

					<a href="advancedSearch.php" class="icon-header-item cl2 hov-cl1 trans-04">
						<i class="fa-solid fa-magnifying-glass"></i>
					</a>

					<?php
					if (isset($_SESSION["u"])) {
						$session_data = $_SESSION["u"];

						$uid = $session_data["id"];
						$ucart_rs = Database::search("SELECT * FROM `cart` WHERE cart.user_id='" . $uid . "'");
						$ucart_num = $ucart_rs->num_rows;
					?>
						<a href="cart.php" class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti" data-notify="<?php echo $ucart_num ?>">
							<i class="fa-solid fa-cart-shopping"></i>
						</a>

						<?php
						$uwlist_rs = Database::search("SELECT * FROM `watchlist` WHERE user_id='" . $uid . "'");
						$uwlist_num = $uwlist_rs->num_rows;
						?>

						<a href="watchlist.php" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti" data-notify="<?php echo $uwlist_num ?>">
							<i class="fa-regular fa-heart"></i>
						</a>

						<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 dropdown">
							<button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
								<i class="fa-solid fa-circle-user"></i>
							</button>
							<ul class="dropdown-menu">
								<li><a class="dropdown-item" href="userProfile.php">My Profile</a></li>
								<li><a class="dropdown-item" href="orderHistory.php">Order History</a></li>
							</ul>
						</div>
					<?php
					}
					?>

				</div>
			</nav>
		</div>
	</div>

	<!-- Header Mobile -->
	<div class="wrap-header-mobile">
		<!-- Logo moblie -->
		<div class="logo-mobile">
			<a href="index.php"><img src="assets/img/logo-text-black.png" alt="IMG-LOGO"></a>
		</div>

		<!-- Icon header -->
		<div class="wrap-icon-header flex-w flex-r-m m-r-15">
			<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
				<i class="zmdi zmdi-search"></i>
			</div>

			<?php
			if (isset($_SESSION["u"])) {
				$session_data = $_SESSION["u"];

				$uid = $session_data["id"];
				$ucart_rs = Database::search("SELECT * FROM `cart` WHERE cart.user_id='" . $uid . "'");
				$ucart_num = $ucart_rs->num_rows;
			?>
				<a href="cart.php" class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti" data-notify="<?php echo $ucart_num ?>">
					<i class="zmdi zmdi-shopping-cart"></i>
				</a>

				<?php
				$uwlist_rs = Database::search("SELECT * FROM `watchlist` WHERE user_id='" . $uid . "'");
				$uwlist_num = $uwlist_rs->num_rows;
				?>

				<a href="watchlist.php" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti" data-notify="<?php echo $uwlist_num ?>">
					<i class="zmdi zmdi-favorite-outline"></i>
				</a>
			<?php
			}
			?>
		</div>

		<!-- Button show menu -->
		<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
			<span class="hamburger-box">
				<span class="hamburger-inner"></span>
			</span>
		</div>
	</div>


	<!-- Menu Mobile -->
	<div class="menu-mobile">
		<ul class="main-menu-m">
			<li>
				<a href="index.php" class="text-decoration-none">Home</a>
			</li>

			<li>
				<a href="products.php" class="text-decoration-none">Shop</a>
			</li>

			<li>
				<a href="about.php" class="text-decoration-none">About</a>
			</li>

			<li>
				<a href="contact.php" class="text-decoration-none">Contact</a>
			</li>

			<?php
			if (isset($_SESSION["u"])) {
				$session_data = $_SESSION["u"];
			?>
				<li>
					<a href="userProfile.php" class="text-decoration-none">My Account</a>
				</li>

				<li>
					<a style="cursor: pointer;" onclick="signout();" class="text-danger text-decoration-none">Logout</a>
				</li>

			<?php
			} else {
			?>
				<li>
					<a href="account-log.php" class="text-warning text-decoration-none">Register or Sign In</a>
				</li>
			<?php
			}
			?>
		</ul>
	</div>

	<!-- Modal Search -->
	<div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
		<div class="container-search-header">
			<button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
				<img src="assets/img/icons/icon-close2.png" alt="CLOSE">
			</button>

			<form class="wrap-search-header flex-w p-l-15">
				<button class="flex-c-m trans-04">
					<i class="zmdi zmdi-search"></i>
				</button>
				<input class="plh3" type="text" name="search" placeholder="Search...">
			</form>

			<div class="text-end fs-20 mt-2">
				<a href="advancedSearch.php">Advanced Search</a>
			</div>
		</div>
	</div>
</header>