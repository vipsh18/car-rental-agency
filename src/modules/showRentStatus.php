<?php
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		if ($rentedOut) {
			echo '<div class="text-center"><b>You have rented out the car.</b></div>';
		} else {
			if (strlen($daysError) > 1) {
				echo $daysError;
			}

			if (strlen($rentError) > 1) {
				echo $rentError;
			}
		}
	}
?>