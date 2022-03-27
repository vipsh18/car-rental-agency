<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		if ($carAdded) {
			echo '<div class="mb-3 text-success"><b>Your car has been added. Now, it can be rented out.</b></div>';
		} else {
			if (strlen($numberError) >= 1) {
				echo '<div class="mb-3 text-danger"><b>'.$numberError.'</b></div>';
			}

			if (strlen($modelError) >= 1) {
				echo '<div class="mb-3 text-danger"><b>'.$modelError.'</b></div>';
			}

			if (strlen($rentError) >= 1) {
				echo '<div class="mb-3 text-danger"><b>'.$rentError.'</b></div>';
			}

			if (strlen($capacityError) >= 1) {
				echo '<div class="mb-3 text-danger"><b>'.$capacityError.'</b></div>';
			}

			if (strlen($carAlreadyAdded) >= 1) {
				echo '<div class="mb-3 text-danger"><b>'.$carAlreadyAdded.'</b></div>';
			}

			echo '<div class="mb-3 text-danger"><b>Your car could not be added. Please try again later.</b></div>';
		}
	}
?>