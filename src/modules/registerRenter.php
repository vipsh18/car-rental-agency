<?php
	include dirname(__FILE__) . '\..\..\config\varcra.php';
	include dirname(__FILE__).'\testInput.php';

	$renterEmail = test_input($_POST['renterEmail']);
	$renterPassword = test_input($_POST['renterPassword']);
	$renterPassword2 = test_input($_POST['renterPassword2']);

	$emailError = $passwordError = $confirmPasswordError = $passwordMatchError = $alreadyRegisteredError = $registered = $renterRegistrationError = "";

	if (empty($renterEmail) ) {
		$emailError = "Renter email cannot be empty!";
	} else if(!filter_var($renterEmail, FILTER_VALIDATE_EMAIL)) {
		$emailError = "Invalid email format !";
	} else if (strlen($renterEmail) > 255) {
		$emailError = "Email cannot contain more than 255 characters.";
	}

	if (empty($renterPassword)) {
		$passwordError = "Password cannot be empty!";
	} else if (strlen($renterPassword) > 255) {
		$passwordError = "Email cannot contain more than 255 characters.";
	} else {
		$renterPassword = hash('sha256', $renterPassword);
		$renterPassword = base64_encode($renterPassword);
	}

	if (empty($renterPassword2)) {
		$confirmPasswordError = "Confirmed password cannot be empty!";
	} else if (strlen($renterPassword2) > 255) {
		$confirmPasswordError = "Email cannot contain more than 255 characters.";
	} else {
		$renterPassword2 = hash('sha256', $renterPassword2);
		$renterPassword2 = base64_encode($renterPassword2);
	}

	if ($renterPassword != $renterPassword2) {
		$passwordMatchError = "Confirmed password does not match the original password.";
	}

	// Check if renter is already registered
	try {
		$result = $conn->prepare("SELECT cust_email FROM customers WHERE cust_email=?");
		$result->bindParam(1, $renterEmail, PDO::PARAM_STR);
		$result->execute();
		// $result->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		if ($result->rowCount() > 0) {
			$alreadyRegisteredError = "This email has already been used for the registration of a renter.";
		}
		$result = null;
	} catch(PDOException $e) {
		$registrationErrorLogsFile = fopen(dirname(__FILE__) . '\..\..\logs\registrationErrors.log', 'w');
		$regCheckErr = 'SQL query check for registered renter failed on: '.date('Y-m-d H:i:s').'. Message: '.$e -> getMessage();
		fwrite($registrationErrorLogsFile, $regCheckErr);
		fclose($registrationErrorLogsFile);
	}

	if ($emailError || $passwordError || $confirmPasswordError || $passwordMatchError || $alreadyRegisteredError) {
		$registered = false;
	} else {
		try {
			$registerRenter = $conn->prepare("INSERT INTO customers(cust_email, cust_password) VALUES(?, ?)");

			$registerRenter->bindParam(1, $renterEmail, PDO::PARAM_STR);
			$registerRenter->bindParam(2, $renterPassword, PDO::PARAM_STR);
			if ($registerRenter->execute()) {
				$registered = true;
			} else {
				$registrationError = "We could not register you. Please try again.";
				$registered = false;
			}

		} catch(PDOException $e) {
			$registered = false;

			$registrationErrorLogsFile = fopen(dirname(__FILE__) . '\..\..\logs\registrationErrors.log', 'w');
			$regCheckErr = 'Renter registration failed on: '.date('Y-m-d H:i:s').'. Message: '.$e -> getMessage();

			fwrite($registrationErrorLogsFile, $regCheckErr);
			fclose($registrationErrorLogsFile);
		}
	}

	$conn = null;
?>