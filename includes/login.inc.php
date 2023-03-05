<?php

require_once 'dbh.inc.php';
require_once 'functions.inc.php';

if (isset($_POST['submit'])) {
	$name = $_POST['name'];
	$surname = $_POST['surname'];
	$class = $_POST['class'];
	$email = $_POST['email'];
	$pwd = $_POST['pwd'];

	if (emptyInput($pwd) !== false) {
		header("location: ../login.php?error=emptyinput");
		exit();
	}
	loginUser(getConnection(), $name, $surname, $class, $email, $pwd);
} else {
	header("Location: ../login.php");
	exit();
}
