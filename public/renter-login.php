<?php
	include '../src/modules/initIndex.php';
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		if (isset($_POST['userEmail']) && isset($_POST['userPassword'])) {
			include '../src/modules/login.php';
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Car Rental Agency &#8226; Renter Login</title>

	<!-- SEO meta tags -->
	<meta name="description" content="Car Rental Agency. Rent out cars. Get cars on rent.">

	<!-- Assets - css & icons -->
	<link rel="stylesheet" href="../assets/css/common.css">
	<link rel="stylesheet" href="../assets/css/form-common.css" >

	<!-- Bootstrap CSS -->
	<link
		href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
		rel="stylesheet"
		integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
		crossorigin="anonymous"
	/>
</head>
<body class="body_class">
	<?php include '../src/modules/loginNav.php'; ?>

	<main>
		<div class="form-div text-center">
			<h2>Renter Login</h2>
			<?php
				include dirname(__FILE__) . '\..\src\modules\showLoginStatus.php';
			?>
			<form action="" method="POST" class="login-form">
				<div class="form-floating mb-3">
					<input type="email" class="form-control" name="userEmail" id="userEmail" placeholder="Agency email address" required maxlength="255">
					<label for="userEmail">Renter email address</label>
				</div>
				<div class="form-floating mb-3">
					<input type="password" class="form-control" name="userPassword" id="userPassword" placeholder="Password" required minlength="8" maxlength="255">
					<label for="userPassword">Password</label>
				</div>
				<input type="hidden" value="renter" name="loginType">

				<button class="btn btn-primary" type="submit">Login</button> <hr>
				<a href="./agency-login.php" role="button" class="btn btn-info">Login as Agency</a>
			</form>
		</div>
	</main>

	<script
		src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
		crossorigin="anonymous"
	></script>
</body>
</html>