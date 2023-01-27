<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login system</title>
</head>
<body>
    <ul>
        <li><a href="index.php">Home</a></li>
        <?php
            if (isset($_SESSION["id"])){
                echo "<li><a href='profile.php'>Profile page</a></li>";
                echo "<li><a href='includes/logout.inc.php'>Log Out</a></li>";
            }
            else{
                echo "<li><a href='signup.php'>Sign Up</a></li>";
                echo "<li><a href='login.php'>Log In</a></li>";
            }
        ?>
    </ul>