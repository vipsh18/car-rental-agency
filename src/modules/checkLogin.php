<?php
	if (!isset($_COOKIE['craid']) || !isset($_COOKIE['crauser'])) {
		header("Location:http://localhost/car-rental-agency/");
		exit();
	}
?>