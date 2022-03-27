<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		include '../src/modules/rentCar.php';
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Car Rental Agency &#8226; Available Cars</title>

	<!-- SEO meta tags -->
	<meta name="description" content="Car Rental Agency. Rent out cars. Get cars on rent.">

	<!-- Assets - css & icons -->
	<link rel="stylesheet" href="../assets/css/common.css">
	<link rel="stylesheet" href="../assets/css/available-cars.css">

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
			<a href="../" class="navbar-brand">
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
					<?php
						include '../src/modules/showAddCarLink.php';
						include '../src/modules/displayAppropriateNav.php';
					?>
				</ul>
			</div>
		</div>
	</nav>

	<?php
		include '../src/modules/showRentStatus.php';
	?>
	<main>
		<?php
			include '../src/modules/showAvailableCars.php';
		?>
	</main>

	<script
		src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
		crossorigin="anonymous"
	></script>

	<script src="../assets/js/available-cars.js"></script>

	<?php
		$conn = null;
	?>
</body>
</html>