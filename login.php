<?php
include_once 'header.php';
?>

    <p>
        This is the login page.
    </p>

    <h2>Log in</h2>
    <form action="includes/login.inc.php" method="post">
        <input type="text" name="name" placeholder="Name..." >
        <input type="text" name="surname" placeholder="Surname..." >
        <select name="class">
            <option name="class" value="" selected="selected">Class...</option>
            <option name="class" value="U">U</option>
            <option name="class" value="T">T</option>
        </select>
        <input type="text" name="email" placeholder="Email..." >
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