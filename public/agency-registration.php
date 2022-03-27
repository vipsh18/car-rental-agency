<?php
	include '../src/modules/initIndex.php';
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		if (isset($_POST['agencyEmail']) && isset($_POST['agencyPassword']) && isset($_POST['agencyPassword2'])) {
			include '../src/modules/registerAgency.php';
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Car Rental Agency &#8226; Agency Registration</title>

	<!-- SEO meta tags -->
	<meta name="description" content="Car Rental Agency. Rent out cars. Get cars on rent.">

	<!-- Assets - css & icons -->
	<link rel="stylesheet" href="../assets/css/common.css">
	<link rel="stylesheet" href="../assets/css/registration-common.css" >

	<!-- Bootstrap CSS -->
	<link
		href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
		rel="stylesheet"
		integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
		crossorigin="anonymous"
	/>
</head>
<body class="body_class">
	<?php include '../src/modules/registrationNav.php'; ?>

	<main>
		<div class="row">
			<div class="col-lg-6 col-md-12 reg-img-container">
				<img src="../assets/img/car-rent-shake-hand.jpg" alt="Image shows a handshake with a car in the background." class="reg-img img-fluid rounded">
			</div>
			<div class="col-lg-6 col-md-12 reg-form-div text-center">
				<h2>Enter Agency Details</h2>
				<?php
					include dirname(__FILE__) . '\..\src\modules\showRegistrationStatus.php';
				?>
				<form action="" method="POST" class="reg-form">
					<div class="form-floating mb-3">
						<input type="email" class="form-control" name="agencyEmail" id="agencyEmail" placeholder="Agency email address" required maxlength="255">
						<label for="agencyEmail">Agency email address</label>
					</div>

					<div class="form-floating mb-3">
						<input type="password" class="form-control" name="agencyPassword" id="agencyPassword" placeholder="Password"  required minlength="8" maxlength="255">
						<label for="agencyPassword">Password</label>
					</div>

					<div class="form-floating mb-3">
						<input type="password" class="form-control" name="agencyPassword2" id="agencyPassword2" placeholder="Confirm Password" required minlength="8" maxlength="255">
						<label for="agencyPassword2">Confirm Password</label>
					</div>

					<input type="hidden" value="agency" name="registrationType">

					<button class="btn btn-primary" type="submit">Register</button> <hr>
					<a href="./renter-registration.php" role="button" class="btn btn-info">Register as Renter</a>
				</form>
			</div>
		</div>
	</main>

	<script
		src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
		crossorigin="anonymous"
	></script>
</body>
</html>