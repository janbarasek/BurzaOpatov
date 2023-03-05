<?php

function getConnection()
{
	static $conn;
	if (!$conn) {
		$serverName = 'localhost';
		$dbUsername = 'root';
		$dbPassword = 'root';
		$dbName = 'burza';
		$dbPort = '3306';
		$conn = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName, $dbPort);
		if (!$conn) {
			die('Connection failed: ' . mysqli_connect_error());
		}
	}

	return $conn;
}

$conn = getConnection();
