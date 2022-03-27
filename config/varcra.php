<?php
$config = parse_ini_file("varcra.ini");

$db_server = $config['db_server'];
$db_user = $config['db_user'];
$db_pass = $config['db_pass'];
$db_name = $config['db_name'];

try {
	$conn = new PDO("mysql:host=$db_server;dbname=$db_name", $db_user, $db_pass);
	//set PDO error mode to exception
	$conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
	$connectionErrorLogsFile = fopen('../logs/connectionErr.log', 'w');
	$connErr = 'Connection failed on: '.date('Y-m-d H:i:s').'. Message: '.$e -> getMessage().'<br>';

	fwrite($connectionErrorLogsFile, $connErr);
	fclose($connectionErrorLogsFile);
}