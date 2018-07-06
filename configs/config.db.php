<?php
	$user = "root";
	$pass = "";
	$host = "127.0.0.1";
	$db = "maintenance";
	$con__ = mysqli_connect($host, $user, $pass, $db);
	if (!$con__) {
	    echo "Error: Unable to connect to MySQL." . PHP_EOL;
	    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
	    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
	    exit;
	}
	mysqli_set_charset($con__, "utf8")
/*
	echo "Success: A proper connection to MySQL was made! The my_db database is great." . PHP_EOL;
	echo "Host information: " . mysqli_get_host_info($con__) . PHP_EOL;*/

	//mysqli_close($link);
?>