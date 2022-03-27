<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		$regType = test_input($_POST['registrationType']);

		if ($registered) {
			if ($regType == "agency") {
				echo '<div class="text-success"><b>Your agency has been registered.</b> Click <a href="./agency-login.php">here</a> to login.</div>';
			} else if ($regType == "renter") {
				echo '<div class="text-success"><b>You have been registered as a renter.</b> Click <a href="./renter-login.php">here</a> to login.</div>';
			}
		} else {
			if (strlen($emailError) >= 1) {
				echo '<div class="text-danger">'.$emailError.'</div>';
			}

			if (strlen($passwordError) >= 1) {
				echo '<div class="text-danger">'.$passwordError.'</div>';
			}

			if (strlen($confirmPasswordError) >= 1) {
				echo '<div class="text-danger">'.$confirmPasswordError.'</div>';
			}

			if (strlen($passwordMatchError) >= 1) {
				echo '<div class="text-danger">'.$passwordMatchError.'</div>';
			}

			if (strlen($alreadyRegisteredError) >= 1) {
				echo '<div class="text-danger">'.$alreadyRegisteredError.'</div>';
			}

			if (strlen($registrationError) >= 1) {
				echo '<div class="text-danger">'.$registrationError.'</div>';
			}
		}
	}
?>