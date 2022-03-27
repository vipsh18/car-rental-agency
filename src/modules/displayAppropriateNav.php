<?php
	if (isset($_COOKIE['craid'])) {
		echo '<li class="nav-item">
				<a href="./logout.php" class="nav-link nav-collapse-links">Logout</a>
			</li>';
	} else {
		echo '<li class="nav-item">
				<a href="../public/renter-login.php" class="nav-link nav-collapse-links">Renter Login</a>
			</li>
			<li class="nav-item">
				<a href="../public/agency-login.php" class="nav-link nav-collapse-links">Agency Login</a>
			</li>';
	}
?>