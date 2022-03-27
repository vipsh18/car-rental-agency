<?php
	include dirname(__FILE__).'/../../config/varcra.php';

	$getAvailableCars = $conn->prepare("SELECT * FROM cars WHERE car_rented=0");
	$getAvailableCars->execute();

	if ($getAvailableCars->rowCount() > 0) {
		while ($availableCars = $getAvailableCars->fetch(PDO::FETCH_ASSOC)) {
			echo '<div class="card">';
				echo '<div><b>Car Number : </b>'.$availableCars['car_number'].'</div>';
				echo '<div><b>Seating Capacity : </b>'.$availableCars['car_capacity'].'</div>';
				echo '<div><b>Car Rent / Day: </b>'.$availableCars['car_rent'].'</div>';
				echo '<div><b>Car Model : </b>'.$availableCars['car_model'].'</div>';

				if (base64_decode($_COOKIE['crauser']) == 'renter') {
					echo '<form method="POST" action="">';
						echo '<div class="renter_functionality">';
							echo '<label for="startDate">Start Date</label><br>';
							echo '<input type="text" id="startDate" value="'.date('d/m/Y').'" disabled>';

							echo '<input type="hidden" name="carId" value="'.$availableCars['car_id'].'">';
							// echo '<input type="hidden" name="renterId" value="">';
							echo '<label for="numDays">Rent out for days </label>';
							echo '<input type="number" id="numDays" value="1" min="1" max="30" name="numDays">';
						echo '</div>';
						echo '<button class="btn btn-success mt-2 rent-car-btn">Rent Car</button>';
					echo '</form>';
				} else {
					echo '<button class="btn btn-success mt-2 rent-car-btn-agency">Rent Car</button>';
				}
			echo '</div>';
		}
	} else {
		echo '<h3>No cars are available currently on rent.</h3>';
	}
?>