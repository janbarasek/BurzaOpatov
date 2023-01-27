<?php

if (isset($_POST['submit'])){
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $class = $_POST['class'];
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];
    $pwdrepeat = $_POST['pwdrepeat'];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if(emptyInputSignup($name, $surname,  $pwd, $pwdrepeat) !== false){
        header("location: ../signup.php?error=emptyinput");
        exit();
    }
    if(invalidUid($name) !== false){
        header("location: ../signup.php?error=invalidname");
        exit();
    }
    if(invalidUid($surname) !== false){
        header("location: ../signup.php?error=invalidsurname");
        exit();
    }
    if(!empty($_POST['class'])){
        if(invalidUid($class) !== false) {
            header("location: ../signup.php?error=invalidclass");
            exit();
        }
    }
    if(!empty($_POST['email'])){
        if(invalidEmail($email) !== false){
            header("location: ../signup.php?error=invalidemail");
            exit();
        }
    }
    if(pwdMatch($pwd, $pwdrepeat) !== false){
        header("location: ../signup.php?error=passwordsdontmatch");
        exit();
    }
    if(uidExists($conn, $name, $email) !== false){
        header("location: ../signup.php?error=usernametaken");
        exit();
    }

    createUser($conn, $name, $surname, $class ,$email, $pwd);



}else{
    header("Location: ../signup.php");
    exit();
}