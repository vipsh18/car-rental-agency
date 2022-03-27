<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		if (strlen($emailError) >= 1) {
			echo '<div class="text-danger">'.$emailError.'</div>';
		}

		if (strlen($passwordError) >= 1) {
			echo '<div class="text-danger">'.$passwordError.'</div>';
		}

		if (strlen($userLoginError) >= 1) {
			echo '<div class="text-danger">'.$userLoginError.'</div>';
		}

		if (strlen($incorrectPasswordError) >= 1) {
			echo '<div class="text-danger">'.$incorrectPasswordError.'</div>';
		}

		if (strlen($noSuchUser) >= 1) {
			echo '<div class="text-danger">'.$noSuchUser.'</div>';
		}
	}
?>