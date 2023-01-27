<?php
$serverName = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'BurzaOpatov';
$dbPort = '3306';

$conn = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName, $dbPort);

if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}