<?php
	include './src/modules/initIndex.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Car Rental Agency &#8226; Home </title>

	<!-- SEO meta tags -->
	<meta name="description" content="Car Rental Agency. Rent out cars. Get cars on rent.">

	<!-- Assets - css & icons -->
	<link rel="stylesheet" href="./assets/css/common.css">
	<link rel="stylesheet" href="./assets/css/index.css">

	<!-- Bootstrap CSS -->
	<link
		href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
		rel="stylesheet"
		integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
		crossorigin="anonymous"
	/>
</head>
<body class="body_class">
	<nav aria-label="Nav" class="navbar navbar-expand-md sticky-top navbar-dark bg-danger bg-gradient">
		<div class="container">
			<a href="" class="navbar-brand">
				Car Rental Agency
			</a>
			<button
				class="navbar-toggler"
				type="button"
				data-bs-toggle="collapse"
				data-bs-target="#navbarSupportedContent"
				aria-controls="navbarSupportedContent"
				aria-expanded="false"
				aria-label="Toggle navigation"
			>
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a href="./public/renter-registration.php" class="nav-link nav-collapse-links">Renter Registration</a>
					</li>
					<li class="nav-item">
						<a href="./public/agency-registration.php" class="nav-link nav-collapse-links">Agency Registration</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<header class="header">
		<div class="header-textbox">
			<h1 class="heading-primary">
				<span class="heading-primary-main text-light">Rent A Car</span>
				<span class="heading-primary-sub text-light">or </span>
				<span class="heading-primary-main text-light">Give Cars On Rent</span>
			</h1>

			<a href="./public/renter-login.php" class="btn btn-primary" role="button">Renter Login</a>
			<a href="./public/agency-login.php" class="btn btn-primary" role="button">Agency Login</a>
		</div>
	</header>

	<script
		src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
		crossorigin="anonymous"
	></script>
</body>
</html>