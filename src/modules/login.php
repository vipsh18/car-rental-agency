<?php
	include dirname(__FILE__) . '\..\..\config\varcra.php';
	include dirname(__FILE__).'\testInput.php';

	function checkEmail($userEmail) {
		if (empty($userEmail)) {
			$emailError = "Email cannot be empty!";
		} else if(!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
			$emailError = "Invalid email format !";
		}  else if (strlen($userEmail) > 255) {
			$emailError = "Email cannot contain more than 255 characters.";
		}
		return $userEmail;
	}

	function checkPassword($userPassword) {
		if (empty($userPassword)) {
			$passwordError = "Password cannot be empty!";
		} else if (strlen($userPassword) > 255) {
			$passwordError = "Email cannot contain more than 255 characters.";
		} else {
			$userPassword = hash('sha256', $userPassword);
			$userPassword = base64_encode($userPassword);
		}

		return $userPassword;
	}

	$userEmail = test_input($_POST['userEmail']);
	$userPassword = test_input($_POST['userPassword']);
	$loginType = test_input($_POST['loginType']);

	$emailError = $passwordError = $userLoginError = $noSuchUser = $incorrectPasswordError = "";

	$userEmail = checkEmail($userEmail);
	$userPassword = checkPassword($userPassword);

	if ((!$emailError) && (!$passwordError)) {
		try {
			if ($loginType == "renter") {
				$checkRenter = $conn->prepare("SELECT * FROM customers WHERE cust_email=?");
				$checkRenter->bindParam(1, $userEmail, PDO::PARAM_STR);
				$checkRenter->execute();

				if ($checkRenter->rowCount() <= 0) {
					$noSuchUser = "No renter is registered with us with that email.";
				} else {
					$loginRenter = $conn->prepare("SELECT * FROM customers WHERE cust_email=? AND cust_password=?");
					$loginRenter->bindParam(1, $userEmail, PDO::PARAM_STR);
					$loginRenter->bindParam(2, $userPassword, PDO::PARAM_STR);
					$loginRenter->execute();

					if ($loginRenter->rowCount() <= 0) {
						$incorrectPasswordError = "Incorrect password for the provided renter email.";
					} else {
						loginUser($userEmail, $loginType);
					}
				}
			} else if ($loginType == "agency") {
				$checkAgency = $conn->prepare("SELECT agency_email FROM agencies WHERE agency_email=?");
				$checkAgency->bindParam(1, $userEmail, PDO::PARAM_STR);
				$checkAgency->execute();

				if ($checkAgency->rowCount() <= 0) {
					$noSuchUser = "No agency is registered with us with that email.";
				} else {
					$loginAgency = $conn->prepare("SELECT * FROM agencies WHERE agency_email=? AND agency_password=?");
					$loginAgency->bindParam(1, $userEmail, PDO::PARAM_STR);
					$loginAgency->bindParam(2, $userPassword, PDO::PARAM_STR);
					$loginAgency->execute();

					if ($loginAgency->rowCount() <= 0) {
						$incorrectPasswordError = "Incorrect password for the provided agency email.";
					} else {
						loginUser($userEmail, $loginType);
					}
				}
			}
		} catch (PDOException $e) {
			$logsFile = fopen(dirname(__FILE__) . '\..\..\logs\loginErrors.log', 'w');
			$writeErr = $_POST['loginType'].' login failed on: '.date('Y-m-d H:i:s').'. Message: '.$e -> getMessage();
			fwrite($logsFile, $writeErr);
			fclose($logsFile);
		}
	}

	function loginUser($userEmail, $loginType) {
		$cookieEmail = base64_encode($userEmail);
		$cookieUser = base64_encode($loginType);

		$_SESSION['craid'] = $cookieEmail;
		$_SESSION['crauser'] = $cookieUser;

		setcookie('craid', $cookieEmail, time()+(60*60*24*30), "/");
		setcookie('crauser', $cookieUser, time()+(60*60*24*30), "/");

		$conn = null;
		if ($loginType == "agency") {
			header("Location:http://localhost/car-rental-agency/public/add-new-car.php");
		} else if ($loginType == "renter") {
			header("Location:http://localhost/car-rental-agency/public/available-cars.php");
		}
		exit();
	}
?>