<?php
	include dirname(__FILE__) . '\..\..\config\varcra.php';
	include dirname(__FILE__).'\testInput.php';

	$agencyEmail = test_input($_POST['agencyEmail']);
	$agencyPassword = test_input($_POST['agencyPassword']);
	$agencyPassword2 = test_input($_POST['agencyPassword2']);

	$emailError = $passwordError = $confirmPasswordError = $passwordMatchError = $alreadyRegisteredError = $registered = "";

	if (empty($agencyEmail)) {
		$emailError = "Agency email cannot be empty!";
	} else if(!filter_var($agencyEmail, FILTER_VALIDATE_EMAIL)) {
		$emailError = "Invalid email format !";
	}  else if (strlen($agencyEmail) > 255) {
		$emailError = "Email cannot contain more than 255 characters.";
	}

	if (empty($agencyPassword)) {
		$passwordError = "Password cannot be empty!";
	} else if (strlen($agencyPassword) > 255) {
		$passwordError = "Email cannot contain more than 255 characters.";
	} else {
		$agencyPassword = hash('sha256', $agencyPassword);
		$agencyPassword = base64_encode($agencyPassword);
	}

	if (empty($agencyPassword2)) {
		$confirmPasswordError = "Confirmed password cannot be empty!";
	} else if (strlen($agencyPassword2) > 255) {
		$confirmPasswordError = "Email cannot contain more than 255 characters.";
	} else {
		$agencyPassword2 = hash('sha256', $agencyPassword2);
		$agencyPassword2 = base64_encode($agencyPassword2);
	}

	if ($agencyPassword != $agencyPassword2) {
		$passwordMatchError = "Confirmed password does not match the original password.";
	}

	// Check if agency is already registered
	try {
		$result = $conn->prepare("SELECT agency_email FROM agencies WHERE agency_email=?");
		$result->bindParam(1, $agencyEmail, PDO::PARAM_STR);
		$result->execute();
		// $result->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		if ($result->rowCount() > 0) {
			$alreadyRegisteredError = "This email has already been used for the registration of an agency.";
		}
	} catch(PDOException $e) {
		$registrationErrorLogsFile = fopen(dirname(__FILE__) . '\..\..\logs\registrationErrors.log', 'w');
		$regCheckErr = 'SQL query check for registered agency failed on: '.date('Y-m-d H:i:s').'. Message: '.$e -> getMessage();
		fwrite($registrationErrorLogsFile, $regCheckErr);
		fclose($registrationErrorLogsFile);
	}

	if ($emailError || $passwordError || $confirmPasswordError || $passwordMatchError || $alreadyRegisteredError) {
		$registered = false;
	} else {
		try {
			$registerAgency = $conn->prepare("INSERT INTO agencies(agency_email, agency_password) VALUES(?, ?)");

			$registerAgency->bindParam(1, $agencyEmail, PDO::PARAM_STR);
			$registerAgency->bindParam(2, $agencyPassword, PDO::PARAM_STR);
			$registerAgency->execute();

			if ($registerAgency->execute()) {
				$registered = true;
			} else {
				$registrationError = "We could not register you. Please try again.";
				$registered = false;
			}
		} catch(PDOException $e) {
			$registered = false;

			$registrationErrorLogsFile = fopen(dirname(__FILE__) . '\..\..\logs\registrationErrors.log', 'w');
			$regCheckErr = 'Agency registration failed on: '.date('Y-m-d H:i:s').'. Message: '.$e -> getMessage();

			fwrite($registrationErrorLogsFile, $regCheckErr);
			fclose($registrationErrorLogsFile);
		}
	}

	$conn = null;
?>