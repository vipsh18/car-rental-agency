<?php
	session_start();
	include dirname(__FILE__) . '\..\..\config\varcra.php';

	if (!isset($_COOKIE['craid']) || !isset($_COOKIE['crauser'])) {
		header("Location:http://localhost/car-rental-agency/");
		exit();
	} else {
		$crauser = $_COOKIE['crauser'];
		if ($crauser == base64_encode("agency")) {
			$agencyEmailIdEncoded = $_COOKIE['craid'];
			$_SESSION['craid'] = $agencyEmailIdEncoded;
			$_SESSION['crauser'] = $crauser;

			$agencyEmail = base64_decode($agencyEmailIdEncoded);

			$getAgencyDetails = $conn->prepare("SELECT * FROM agencies WHERE agency_email=?");
			$getAgencyDetails->bindParam(1, $agencyEmail, PDO::PARAM_STR);
			$getAgencyDetails->execute();

		} else {
			header("Location:http://localhost/car-rental-agency/");
			exit();
		}
	}
?>