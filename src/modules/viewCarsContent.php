<?php
	include '../src/modules/checkLogin.php';
	include dirname(__FILE__).'\..\..\config\varcra.php';

	$currentUserEmail = base64_decode($_COOKIE['craid']);
	$currentUserType = base64_decode($_COOKIE['crauser']);

	if ($currentUserType == "agency") {
		$getAgencyId = $conn->prepare("SELECT agency_id FROM agencies WHERE agency_email=?");
		$getAgencyId->bindParam(1, $currentUserEmail, PDO::PARAM_STR);
		$getAgencyId->execute();

		$agencyIdRow = $getAgencyId->fetch(PDO::FETCH_ASSOC);
		$agencyId = $agencyIdRow['agency_id'];

		$getUserCars = $conn->prepare("SELECT * FROM cars WHERE car_agency = ?");
		$getUserCars->bindParam(1, $agencyId, PDO::PARAM_STR);
		$getUserCars->execute();

		if ($getUserCars->rowCount() <= 0) {
			echo '<h2>You do not have any cars to rent out currently.</h2>';
		} else {
			echo '<h2>Your cars :</h2>';
			while ($userCarsRow = $getUserCars->fetch(PDO::FETCH_ASSOC)) {
				echo '<div class="card">';
					echo '<div><b>Car Number : </b>'.$userCarsRow['car_number'].'</div>';
					echo '<div><b>Seating Capacity : </b>'.$userCarsRow['car_capacity'].'</div>';
					echo '<div><b>Car Rent / Day: </b>'.$userCarsRow['car_rent'].'</div>';
					echo '<div><b>Car Model : </b>'.$userCarsRow['car_model'].'</div>';

					$isCarRented = $userCarsRow['car_rented'];

					if (!$isCarRented) {
						echo '<div><b>Car Rented Out Currently : </b>';
						echo $isCarRented == 0 ? 'No' : 'Yes';
						echo '</div>';
					} else {
						$renterId = $userCarsRow['car_renter'];

						$getRenterEmail = $conn->prepare("SELECT cust_email FROM customers WHERE cust_id=?");
						$getRenterEmail->bindParam(1, $renterId, PDO::PARAM_STR);
						$getRenterEmail->execute();

						if ($getRenterEmail->rowCount() == 1) {
							echo '<div><b>Car Rented out by: </b>';
							$renterEmailRow = $getRenterEmail->fetch(PDO::FETCH_ASSOC);
							echo $renterEmailRow['cust_email'];
							echo '</div>';

							echo '<div><b>Car Rented out until: </b>';
							$rentStartDate = $userCarsRow['rent_start'];
							$numDays = $userCarsRow['rent_days'];
							$rentEndDate = date('Y-m-d', strtotime($rentStartDate.' + '.$numDays.' days'));
							echo $rentEndDate;
							echo '</div>';
						} else {
							echo 'There seems to be some error. Please try again.';
						}
					}
					echo '</div>';
				echo '</div>';
			}
		}
	}
?>