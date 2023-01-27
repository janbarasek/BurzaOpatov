<?php
include_once 'header.php';
?>

    <p>
        This is the login page.
    </p>

    <h2>Log in</h2>
    <form action="includes/login.inc.php" method="post">
        <input type="text" name="uid" placeholder="Surname/Email..." required>
        <input type="password" name="pwd" placeholder="Password..." required>
        <button type="submit" name="submit">Log in</button>
    </form>

<?php
    if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptyinput") {
            echo "<p>Fill in all fields!</p>";
        }
        else if ($_GET["error"] == "wronglogin") {
            echo "<p>Incorrect login credentials</p>";
        }
    }
?>

<?php
include_once 'footer.php';
?>