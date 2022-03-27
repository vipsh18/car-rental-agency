<?php
	include dirname(__FILE__) . '\..\..\config\varcra.php';
	include dirname(__FILE__).'\testInput.php';

	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		$carNumber = test_input($_POST['carNumber']);
		$carNumber = strtoupper($carNumber);
		$carModel = test_input($_POST['carModel']);
		$carCapacity = test_input($_POST['carCapacity']);
		$carRent = test_input($_POST['carRent']);

		$numberError = $modelError = $capacityError = $rentError = $carAlreadyAdded = $carAdded = "";

		if (empty($carNumber) ) {
			$numberError = "Car Number cannot be empty!";
		} else if (strlen($carNumber) < 8 || strlen($carNumber) > 20) {
			$numberError = "Car Number can contain only 8-20 characters.";
		}

		if (empty($carNumber) ) {
			$modelError = "Car Model cannot be empty!";
		} else if (strlen($carNumber) > 255) {
			$modelError = "Car Model cannot contain more than 255 characters.";
		}

		if (empty($carCapacity) ) {
			$capacityError = "Car Capacity cannot be empty!";
		}

		if (empty($carRent) ) {
			$rentError = "Car Rent cannot be empty!";
		}

		if ((!$numberError) && (!$modelError) && (!$rentError) && (!$capacityError)) {
			$checkAddition = $conn->prepare("SELECT * FROM cars WHERE car_number=?");
			$checkAddition->bindParam(1, $carNumber, PDO::PARAM_STR);
			$checkAddition->execute();

			if ($checkAddition->rowCount() >= 1) {
				$carAlreadyAdded = "A car with this number has already been added.";
			} else {
				$agencyCookie = base64_decode($_COOKIE['craid']);
				$currentAgencyQuery = $conn->prepare("SELECT * FROM agencies WHERE agency_email=?");
				$currentAgencyQuery->bindParam(1, $agencyCookie, PDO::PARAM_STR);
				$currentAgencyQuery->execute();

				$agencyQueryResults = $currentAgencyQuery->fetch(PDO::FETCH_ASSOC);
				$currentAgency = $agencyQueryResults['agency_id'];

				$addCar = $conn->prepare("INSERT INTO cars(car_agency, car_model, car_number, car_capacity, car_rent) VALUES(?, ?, ?, ?, ?)");
				$addCar->bindParam(1, $currentAgency, PDO::PARAM_STR);
				$addCar->bindParam(2, $carModel, PDO::PARAM_STR);
				$addCar->bindParam(3, $carNumber, PDO::PARAM_STR);
				$addCar->bindParam(4, $carCapacity, PDO::PARAM_STR);
				$addCar->bindParam(5, $carRent, PDO::PARAM_STR);

				if ($addCar->execute()) {
					$carAdded = true;
				} else {
					$carAdded = false;
				}
			}
		} else {
			$carAdded = false;
		}
	}
?>