<?php
    include_once 'header.php';
?>

    <p>
        This is the signup page.
    </p>

    <h2>Sign up</h2>
    <form action="includes/signup.inc.php" method="post">
        <input type="text" name="name" placeholder="Name..." required>
        <input type="text" name="surname" placeholder="Surname..." required>
        <select name="class">
            <option name="class" value="" selected="selected">Class...</option>
            <option name="class" value="U">U</option>
            <option name="class" value="T">T</option>
        </select>
        <input type="email" name="email" placeholder="Email...">
        <input type="password" name="pwd" placeholder="Password..." required>
        <input type="password" name="pwdrepeat" placeholder="Repeat password..." required>
        <button type="submit" name="submit">Sign up</button>
    </form>

<?php
    if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptyinput") {
            echo "<p>Fill in all fields!</p>";
        }
        else if ($_GET["error"] == "invalidname") {
            echo "<p>Choose a proper name!</p>";
        }
        else if ($_GET["error"] == "invalidsurname") {
            echo "<p>Choose a proper surname!</p>";
        }
        else if ($_GET["error"] == "invalidemail") {
            echo "<p>Choose a proper email!</p>";
        }
        else if ($_GET["error"] == "passwordsdontmatch") {
            echo "<p>Passwords don't match!</p>";
        }
        else if ($_GET["error"] == "stmtfailed") {
            echo "<p>Something went wrong, try again!</p>";
        }
        else if ($_GET["error"] == "usernametaken") {
            echo "<p>Username is already taken!</p>";
        }
        else if ($_GET["error"] == "none") {
            echo "<p class='success'>You have signed up!</p>";
        }
    }
?>

<?php
    include_once 'footer.php';
?>