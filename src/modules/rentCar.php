<?php
	include dirname(__FILE__).'\..\..\config\varcra.php';
	include dirname(__FILE__).'\testInput.php';

	$userType = base64_decode($_COOKIE['crauser']);
	$userEmail = base64_decode($_COOKIE['craid']);

	$daysError = $rentError = $rentedOut = "";

	if ($userType == "renter") {
		$numDays = test_input($_POST['numDays']);
		$carId = test_input($_POST['carId']);

		if (empty($numDays) || $numDays < 1 || $numDays > 30) {
			$rentedOut= false;
			$daysError = "Number of days need to be between 1-30.";
		} else {
			$getRenterId = $conn->prepare("SELECT cust_id FROM customers WHERE cust_email = ?");
			$getRenterId->bindParam(1, $userEmail, PDO::PARAM_STR);
			$getRenterId->execute();

			$renterIdRow = $getRenterId->fetch(PDO::FETCH_ASSOC);
			$renterId = $renterIdRow['cust_id'];

			if (!$daysError) {
				$setRenter = $conn->prepare("UPDATE cars SET car_renter=?, car_rented=1, rent_start=now(), rent_days=? WHERE car_id=?");
				$setRenter->bindParam(1, $renterId, PDO::PARAM_INT);
				$setRenter->bindParam(2, $numDays, PDO::PARAM_INT);
				$setRenter->bindParam(3, $carId, PDO::PARAM_INT);

				if ($setRenter->execute()) {
					$rentedOut = true;
				} else {
					$rentedOut = false;
					$rentError = "There was some error while renting the car. Please try again.";
				}
			}
		}
	}

	$conn = null;
?>