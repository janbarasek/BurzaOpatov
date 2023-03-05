<?php

//no category stuff
function checkArrayEquality(array $array1, array $array2, string $key1, string $key2): array
{
	//returns an array of products that are in both arrays
	$result = [];
	foreach ($array1 as $product1) {
		foreach ($array2 as $product2) {
			if ($product1[$key1] === $product2[$key2]) {
				$result[] = $product1;
			}
		}
	}

	return $result;
}

function minmax(int $value, int $min, int $max): bool
{
	return !($value < $min || $value > $max);
}

//User stuff
function constructEmail(string $name, string $surname, string $class): string
{
	$changeTable = [
		'ä' => 'a',
		'Ä' => 'A',
		'á' => 'a',
		'Á' => 'A',
		'à' => 'a',
		'À' => 'A',
		'ã' => 'a',
		'Ã' => 'A',
		'â' => 'a',
		'Â' => 'A',
		'č' => 'c',
		'Č' => 'C',
		'ć' => 'c',
		'Ć' => 'C',
		'ď' => 'd',
		'Ď' => 'D',
		'ě' => 'e',
		'Ě' => 'E',
		'é' => 'e',
		'É' => 'E',
		'ë' => 'e',
		'Ë' => 'E',
		'è' => 'e',
		'È' => 'E',
		'ê' => 'e',
		'Ê' => 'E',
		'í' => 'i',
		'Í' => 'I',
		'ï' => 'i',
		'Ï' => 'I',
		'ì' => 'i',
		'Ì' => 'I',
		'î' => 'i',
		'Î' => 'I',
		'ľ' => 'l',
		'Ľ' => 'L',
		'ĺ' => 'l',
		'Ĺ' => 'L',
		'ń' => 'n',
		'Ń' => 'N',
		'ň' => 'n',
		'Ň' => 'N',
		'ñ' => 'n',
		'Ñ' => 'N',
		'ó' => 'o',
		'Ó' => 'O',
		'ö' => 'o',
		'Ö' => 'O',
		'ô' => 'o',
		'Ô' => 'O',
		'ò' => 'o',
		'Ò' => 'O',
		'õ' => 'o',
		'Õ' => 'O',
		'ő' => 'o',
		'Ő' => 'O',
		'ř' => 'r',
		'Ř' => 'R',
		'ŕ' => 'r',
		'Ŕ' => 'R',
		'š' => 's',
		'Š' => 'S',
		'ś' => 's',
		'Ś' => 'S',
		'ť' => 't',
		'Ť' => 'T',
		'ú' => 'u',
		'Ú' => 'U',
		'ů' => 'u',
		'Ů' => 'U',
		'ü' => 'u',
		'Ü' => 'U',
		'ù' => 'u',
		'Ù' => 'U',
		'ũ' => 'u',
		'Ũ' => 'U',
		'û' => 'u',
		'Û' => 'U',
		'ý' => 'y',
		'Ý' => 'Y',
		'ž' => 'z',
		'Ž' => 'Z',
		'ź' => 'z',
		'Ź' => 'Z',
	];

	$name = strtolower($name);
	$surname = strtolower($surname);

	$name = str_replace(' ', '', $name);
	$surname = str_replace(' ', '', $surname);

	$name = strtr($name, $changeTable);
	$surname = strtr($surname, $changeTable);

	return sprintf('%s%s.%s@zaci.gopat.cz',
		substr($name, 0, 3),
		substr($surname, 0, 3),
		$class
	);
}

function emptyInput(?string $value): bool
{
	return empty($value);
}

function invalidUid(string $uid): bool
{
	return !preg_match('/^[\w\sěščřžýáíé]*$/u', $uid);
}

function invalidEmail(string $email): bool
{
	return !filter_var($email, FILTER_VALIDATE_EMAIL);
}

function pwdMatch(string $pwd, string $pwdrepeat): bool
{
	return $pwd !== $pwdrepeat;
}

//Returns the row if email exists in database
//Returns false if email does not exist in database
function uidExists($conn, $name, $surname, $class, $email)
{
	if (empty($email)) {
		$email = constructEmail($name, $surname, $class);
	}
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, 'SELECT * FROM users WHERE email = ?;')) {
		header("location: ../signup.php?error=stmtfailed");
		exit();
	}
	mysqli_stmt_bind_param($stmt, "s", $email); // s = string
	mysqli_stmt_execute($stmt);

	$resultData = mysqli_stmt_get_result($stmt);

	if ($row = mysqli_fetch_assoc($resultData)) {
		return $row;
	}

	return false;
}

function createUser($conn, $name, $surname, $class, $email, $pwd)
{
	$sql = "INSERT INTO users (name, surname, class, email, password) VALUES (?,?,?,?,?);";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../signup.php?error=stmtfailed");
		exit();
	}

	$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

	if (empty($email)) {
		$email = constructEmail($name, $surname, $class);
	}

	mysqli_stmt_bind_param($stmt, "sssss", $name, $surname, $class, $email, $hashedPwd); // s = string
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);

	$sql = "SELECT * FROM users WHERE email = ? AND password=?;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../signup.php?error=stmtfailed");
		exit();
	}
	mysqli_stmt_bind_param($stmt, "ss", $email, $hashedPwd); // s = string
	mysqli_stmt_execute($stmt);

	$resultData = mysqli_stmt_get_result($stmt);

	if (mysqli_num_rows($resultData) > 0) {
		while ($row = mysqli_fetch_assoc($resultData)) {
			$userid = $row['id'];
			$sql = "INSERT INTO profileImg (userid,status) VALUES ('$userid',0)";
			mysqli_query($conn, $sql);
			header("Location: upload.php?signup=success");
		}
	} else {
		echo "Location: ../signup.php?error=wronglogin";
	}

	mysqli_stmt_close($stmt);

	loginUser($conn, $name, $surname, $class, $email, $pwd);
	exit();
}

//function emptyInputLogin($email, $pwd){
//    $result;
//    if(empty($email) || empty($pwd)){
//        $result = true;
//    }else{
//        $result = false;
//    }
//    return $result;
//}

function loginUser($conn, $name, $surname, $class, $email, $pwd)
{
	$uidExists = uidExists($conn, $name, $surname, $class, $email);

	if ($uidExists === false) {
		header("location: ../login.php?error=wronglogin");
		exit();
	}

	$pwdHashed = $uidExists["password"];

	$checkPwd = password_verify($pwd, $pwdHashed);

	if ($checkPwd === false) {
		header("location: ../login.php?error=wrongPassword");
		exit();
	}

	session_start();
	$_SESSION["id"] = $uidExists["id"];
	$_SESSION["name"] = $uidExists["name"];
	$_SESSION["surname"] = $uidExists["surname"];
	$_SESSION["class"] = $uidExists["class"];
	$_SESSION["mail"] = $uidExists["email"];

	$sql = "SELECT * FROM profileimg WHERE userid = " . $_SESSION['id'] . ";";
	$result = mysqli_query($conn, $sql);

	while ($row = mysqli_fetch_assoc($result)) {
		$_SESSION["imgStatus"] = $row['status'];
	}

	header("location: ../index.php?error=none");
	exit();
}

function getUserByID($conn, $id)
{
	$sql = "SELECT * FROM users WHERE id = ?;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../signup.php?error=stmtfailed");
		exit();
	}
	mysqli_stmt_bind_param($stmt, "s", $id); // s = string
	mysqli_stmt_execute($stmt);

	$resultData = mysqli_stmt_get_result($stmt);

	if ($row = mysqli_fetch_assoc($resultData)) {
		return $row;
	}

	mysqli_stmt_close($stmt);
}

function getClassByUserID($conn, $id)
{
	$sql = "SELECT class.classYear, class.class FROM class 
         JOIN users ON users.class = class.class
         WHERE users.id = ?;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../signup.php?error=stmtfailed");
		exit();
	}
	mysqli_stmt_bind_param($stmt, "s", $id); // s = string
	mysqli_stmt_execute($stmt);

	$resultData = mysqli_stmt_get_result($stmt);

	if ($row = mysqli_fetch_assoc($resultData)) {
		return $row;
	}

	mysqli_stmt_close($stmt);
}


//PRODUCTS

//gets productslist from database

function getProductsList($conn)
{
	return mysqli_fetch_all(mysqli_query($conn, 'SELECT * FROM productslist;'), MYSQLI_ASSOC);
}

//gets product from database

function getProductsBySearch($conn, $search)
{
	$sql = "SELECT *, p.id FROM products p
        JOIN users u  ON p.userid = u.id JOIN productslist pl ON p.productslistid = pl.productslistid JOIN subject s ON pl.subjectid = s.subjectid
        WHERE u.name LIKE ? OR u.surname LIKE ? OR u.class LIKE ? OR pl.itemName LIKE ? OR pl.year LIKE ? OR pl.publishYear LIKE ? OR s.subjectName LIKE ?;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../index.php?error=stmtfailed");
		exit();
	}
	$search = "%" . $search . "%";
	mysqli_stmt_bind_param(
		$stmt, "sssssss", $search, $search, $search, $search, $search, $search, $search
	);// s = string
	mysqli_stmt_execute($stmt);
	mysqli_stmt_store_result($stmt);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	$products = mysqli_fetch_all($result, MYSQLI_ASSOC);
	mysqli_stmt_close($stmt);

	/*$sql = "SELECT * FROM products p
		 WHERE pl.name LIKE ? OR pl.year LIKE ? OR pl.publishYear LIKE ? OR s.name LIKE ?;";
	$stmt = mysqli_stmt_init($conn);
	if(!mysqli_stmt_prepare($stmt, $sql)){
		header("location: ../index.php?error=stmtfailed");
		exit();
	}
	$search = "%".$search."%";
	mysqli_stmt_bind_param($stmt, "ssss", $search, $search, $search, $search);// s = string
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	$products2 = mysqli_fetch_all($result, MYSQLI_ASSOC);
	mysqli_stmt_close($stmt);

	$products = array_merge($products, $products2);*/

	return $products;
}

// JOIN productslist pl ON p.productslistid = pl.id
//$sql = "SELECT * FROM products p JOIN productslist pl ON p.productslistid = pl.id JOIN subject s ON pl.subjectid = s.id
//WHERE pl.name LIKE ? OR pl.year LIKE ? OR s.name LIKE ?;";
function getProductsByPrice($conn, $fromPrice, $toPrice)
{
	$sql = "SELECT *, p.id FROM products p
        JOIN users u  ON p.userid = u.id JOIN productslist pl ON p.productslistid = pl.productslistid JOIN subject s ON pl.subjectid = s.subjectid
        WHERE price >= " . $fromPrice . " AND price <= " . $toPrice . ";";
	$result = mysqli_query($conn, $sql);
	$products = mysqli_fetch_all($result, MYSQLI_ASSOC);

	return $products;
}

function getProductsByRank($conn, $rankid)
{
	$sql = "SELECT *, p.id FROM products p
        JOIN users u  ON p.userid = u.id JOIN productslist pl ON p.productslistid = pl.productslistid JOIN subject s ON pl.subjectid = s.subjectid
        WHERE p.rankid = '" . $rankid . "';";
	$result = mysqli_query($conn, $sql);
	$products = mysqli_fetch_all($result, MYSQLI_ASSOC);

	return $products;
}

function getProductsByYear($conn, $year)
{
	$sql = "SELECT *, p.id FROM products p
        JOIN users u  ON p.userid = u.id JOIN productslist pl ON p.productslistid = pl.productslistid JOIN subject s ON pl.subjectid = s.subjectid
        WHERE pl.year = '" . $year . "';";
	$result = mysqli_query($conn, $sql);
	$products = mysqli_fetch_all($result, MYSQLI_ASSOC);

	return $products;
}

function getProductsByID($conn, $id)
{
	$sql = "SELECT *, p.id FROM products p
        JOIN users u  ON p.userid = u.id JOIN productslist pl ON p.productslistid = pl.productslistid JOIN subject s ON pl.subjectid = s.subjectid
        WHERE p.id = '" . $id . "';";
	$result = mysqli_query($conn, $sql);
	$products = mysqli_fetch_all($result, MYSQLI_ASSOC);

	return $products;
}

function getproductsListByYear($conn, $year)
{
	$sql = "SELECT productslistid FROM productslist pl
        WHERE pl.year = '" . $year . "';";
	$result = mysqli_query($conn, $sql);
	$products = mysqli_fetch_all($result, MYSQLI_ASSOC);

	return $products;
}

function getProductsBySubjectID($conn, $subjectid)
{
	$sql = "SELECT *, p.id FROM products p
        JOIN users u  ON p.userid = u.id JOIN productslist pl ON p.productslistid = pl.productslistid JOIN subject s ON pl.subjectid = s.subjectid
        WHERE pl.subjectid = '" . $subjectid . "';";
	$result = mysqli_query($conn, $sql);
	$products = mysqli_fetch_all($result, MYSQLI_ASSOC);

	return $products;
}

function getProductsListBySubjectID($conn, $subjectid)
{
	$sql = "SELECT productslistid FROM productslist pl
        WHERE pl.subjectid = '" . $subjectid . "';";
	$result = mysqli_query($conn, $sql);
	$products = mysqli_fetch_all($result, MYSQLI_ASSOC);

	return $products;
}

function getProductsListByID($conn, $id)
{
	$sql = "SELECT * FROM productslist pl
        WHERE pl.productslistid = '" . $id . "';";
	$result = mysqli_query($conn, $sql);
	$products = mysqli_fetch_all($result, MYSQLI_ASSOC);

	return $products;
}

function getProductsListYearSubjectid($conn, $year, $subjectid)
{
	$products = [];
	if ($year != 0) {
		$products = getProductsListByYear($conn, $year);
	}
	if ($subjectid != 0) {
		$products2 = getProductsListBySubjectID($conn, $subjectid);
		$products = checkArrayEquality($products, $products2, "productslistid", "productslistid");
	}

	return $products;
}


function getRanks($conn)
{
	$sql = "SELECT * FROM rank;";
	$result = mysqli_query($conn, $sql);
	$ranks = mysqli_fetch_all($result, MYSQLI_ASSOC);

	return $ranks;
}

function getRankByID($conn, $rankid)
{
	$sql = "SELECT * FROM rank WHERE id = '" . $rankid . "';";
	$result = mysqli_query($conn, $sql);
	$rank = mysqli_fetch_assoc($result);

	return $rank;
}

function getSubjects($conn)
{
	$sql = "SELECT * FROM subject;";
	$result = mysqli_query($conn, $sql);
	$ranks = mysqli_fetch_all($result, MYSQLI_ASSOC);

	return $ranks;
}

function emptyInputSell($userid, $productslistid, $rankid, $price)
{
	return empty($userid) || empty($productslistid) || empty($rankid) || empty($price);
}

function createItem($conn, $userid, $productslistid, $rankid, $price)
{
	$sql = "INSERT INTO products (userid, productslistid, rankid, price)
        VALUES (?, ?, ?, ?);";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("location: ../sell.php?error=stmtfailed");
		exit();
	}
	mysqli_stmt_bind_param($stmt, "ssss", $userid, $productslistid, $rankid, $price); // s = string
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	header("location: ../sell.php?error=none");
	exit();
}

