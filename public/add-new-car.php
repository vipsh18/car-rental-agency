<?php
	include '../src/modules/initLoggedIn.php';
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		if (isset($_POST['carNumber']) && isset($_POST['carModel']) && isset($_POST['carCapacity']) && isset($_POST['carRent'])) {
			include '../src/modules/addCar.php';
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Car Rental Agency &#8226; Add New Car</title>

	<!-- SEO meta tags -->
	<meta name="description" content="Car Rental Agency. Rent out cars. Get cars on rent.">

	<!-- Assets - css & icons -->
	<link rel="stylesheet" href="../assets/css/common.css">
	<link rel="stylesheet" href="../assets/css/form-common.css">

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
					<li class="nav-item">
						<a href="./view-my-cars.php" class="nav-link nav-collapse-links">View My Cars</a>
					</li>
					<li class="nav-item">
						<a href="./logout.php" class="nav-link nav-collapse-links">Logout</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<main class="text-center form-div">
		<h3 class="mb-3">Add a New Car</h3>

		<?php
			include '../src/modules/carAdditionStatus.php';
		?>

		<form action="" method="POST">
			<div class="form-floating mb-3">
				<input type="text" class="form-control" name="carNumber" id="carNumber" placeholder="Agency email address" required maxlength="20" minlength="8">
				<label for="carNumber">Car Number</label>
			</div>
			<div class="form-floating mb-3">
				<input type="text" class="form-control" name="carModel" id="carModel" placeholder="Car Model" required minlength="1" maxlength="255">
				<label for="carModel">Car Model</label>
			</div>
			<div class="form-floating mb-3">
				<input type="text" class="form-control" name="carCapacity" id="carCapacity" placeholder="Car Capacity" required minlength="1">
				<label for="carCapacity">Car Capacity</label>
			</div>
			<div class="form-floating mb-3">
				<input type="text" class="form-control" name="carRent" id="carRent" placeholder="Car Rent / Day" required minlength="1">
				<label for="carRent">Car Rent / Day</label>
			</div>

			<input type="hidden" value="renter" name="loginType">
			<button class="btn btn-primary" type="submit">Add Car</button>
		</form>
	</main>

	<script
		src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
		crossorigin="anonymous"
	></script>

	<?php
		$conn = null;
	?>
</body>
</html>