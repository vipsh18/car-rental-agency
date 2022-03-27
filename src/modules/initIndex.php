<?php
	session_start();
	$page_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	if(strpos($page_link, "www.") !== false) {
	    header("Location:http://localhost/car-rental-agency");
	}

	if (isset($_SESSION['craid']) && isset($_SESSION['crauser'])) {
		if ($_SESSION['crauser'] == base64_encode('agency')) {
			header("Location:http://localhost/car-rental-agency/public/add-new-car.php");
			exit();
		} else if ($_SESSION['crauser'] == base64_encode('renter')) {
			header("Location:http://localhost/car-rental-agency/public/available-cars.php");
			exit();
		}
	} else if ((isset($_SESSION['craid']) && !isset($_SESSION['crauser'])) || (!isset($_SESSION['craid']) && isset($_SESSION['crauser'])) || (isset($_COOKIE['craid']) && !isset($_COOKIE['crauser'])) || (!isset($_COOKIE['craid']) && isset($_COOKIE['crauser']))) {
		session_unset();
		$_SESSION = array();
		if(isset($_COOKIE[session_name()])) setcookie(session_name(),'',time()-3600);
		if (session_destroy()) {
			setcookie('craid', '', time()-3600, "/");
			setcookie('crauser', '', time()-3600, "/");
		}
	} else {
		if (isset($_COOKIE['craid']) && isset($_COOKIE['crauser'])) {
			$crauser = $_COOKIE['crauser'];
			$_SESSION['craid'] = $_COOKIE['craid'];
			$_SESSION['crauser'] = $crauser;

			if ($crauser == base64_encode('agency')) {
				header("Location:http://localhost/car-rental-agency/public/add-new-car.php");
				exit();
			} else if ($crauser == base64_encode('renter')) {
				header("Location:http://localhost/car-rental-agency/public/available-cars.php");
				exit();
			}
		}
	}
?>