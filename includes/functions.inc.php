<?php
//function emptyInputSignup($name, $surname, $pwd, $pwdrepeat){
//    $result;
//    if(empty($name) || empty($surname) || empty($pwd) || empty($pwdrepeat)){
//        $result = true;
//    }else{
//        $result = false;
//    }
//    return $result;
//}

function constructEmail($name, $surname, $class){
    $email = substr($name, 0, 3) . substr($surname, 0, 3) . "." . $class ."@zaci.gopat.cz";
    return $email;
}

function emptyInput($value){
    $result;
    if(empty($value)){
        $result = true;
    }else{
        $result = false;
    }
    return $result;
}

function invalidUid($uid){
    $result;
    if(!preg_match("/^[a-zA-Z0-9]*$/", $uid)){
        $result = true;
    }else{
        $result = false;
    }
    return $result;
}

function invalidEmail($email){
    $result;
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $result = true;
    }else{
        $result = false;
    }
    return $result;
}

function pwdMatch($pwd, $pwdrepeat){
    $result;
    if($pwd !== $pwdrepeat){
        $result = true;
    }else{
        $result = false;
    }
    return $result;
}

function uidExists($conn, $name, $surname, $class, $email){
    $sql = "SELECT * FROM users WHERE email = ?;";
    if(empty($email)){
        $email = constructEmail($name, $surname, $class);
    }
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s",  $email); // s = string
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    }else{
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function createUser($conn, $name, $surname, $class, $email, $pwd){
    $sql = "INSERT INTO users (name, surname, class, email, password) VALUES (?,?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

    if(empty($email))
        $email = constructEmail($name, $surname, $class);

    mysqli_stmt_bind_param($stmt, "sssss", $name, $surname, $class, $email, $hashedPwd); // s = string
    mysqli_stmt_execute($stmt);

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

function loginUser($conn, $name, $surname, $class, $email, $pwd){
    $uidExists = uidExists($conn, $name, $surname, $class, $email);

    if($uidExists === false){
        header("location: ../login.php?error=wronglogin");
        exit();
    }

    $pwdHashed = $uidExists["password"];

    $checkPwd = password_verify($pwd, $pwdHashed);

    if($checkPwd === false) {
        header("location: ../login.php?error=wrongPassword");
        exit();
    }else if($checkPwd === true){
        session_start();
        $_SESSION["id"] = $uidExists["id"];
        $_SESSION["name"] = $uidExists["name"];
        $_SESSION["surname"] = $uidExists["surname"];
        $_SESSION["class"] = $uidExists["class"];
        $_SESSION["mail"] = $uidExists["email"];
        header("location: ../index.php?error=none");
        exit();
    }
}