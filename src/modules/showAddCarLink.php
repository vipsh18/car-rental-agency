<?php
	if (isset($_COOKIE['crauser']) && base64_decode($_COOKIE['crauser']) == "agency") {
		echo '
			<li class="nav-item">
				<a href="./add-new-car.php" class="nav-link nav-collapse-links">Add New Car</a>
			</li>
			';
	}
?>