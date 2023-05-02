<?php
include_once 'header.php';
?>

<?php
session_regenerate_id(true);
include_once 'includes/dbh.inc.php';

if(isset($_SESSION['login_id']) || isset($_SESSION['id'])){
    header('Location: index.php');
    exit;
}
require 'google-api/vendor/autoload.php';
// Creating new google client instance
$client = new Google_Client();
// Enter your Client ID
$client->setClientId(getMasterClientID());
// Enter your Client Secrect
$client->setClientSecret(getMasterClientSecret());
// Enter the Redirect URL
$client->setRedirectUri('http://localhost/Burza/login.php');
// Adding those scopes which we want to get (email & profile Information)
$client->addScope("email");
$client->addScope("profile");
if(isset($_GET['code'])):
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    if(!isset($token["error"])){
        $client->setAccessToken($token['access_token']);
        // getting profile information
        $google_oauth = new Google_Service_Oauth2($client);
        $google_account_info = $google_oauth->userinfo->get();

        // Storing data into database
        $google_id = mysqli_real_escape_string($conn, $google_account_info->id);
        $firstName = mysqli_real_escape_string($conn, trim($google_account_info->givenName));
        $lastName = mysqli_real_escape_string($conn, trim($google_account_info->familyName));
        $email = mysqli_real_escape_string($conn, $google_account_info->email);
        $profile_pic = mysqli_real_escape_string($conn, $google_account_info->picture);
        // checking user already exists or not
        $get_user = mysqli_query($conn, "SELECT `google_id` FROM `users` WHERE `google_id`='$google_id'");
        if(mysqli_num_rows($get_user) > 0){
            $_SESSION['login_id'] = $google_id;

            $expodedEmail = explode("@", $email);
            $endMail = $expodedEmail[1];

            if($endMail == "zaci.gopat.cz"){
                $expodedFirstEmail = explode(".", $expodedEmail[0]);
                $classEmail = end($expodedFirstEmail);
                $classEmail = strtoupper($classEmail);

            }

            $uidExists = uidExists($conn, $firstName, $lastName, $classEmail, $email);

            $_SESSION["id"] = $uidExists["id"];
            $_SESSION["name"] = $uidExists["name"];
            $_SESSION["surname"] = $uidExists["surname"];
            $_SESSION["class"] = $uidExists["class"];
            $_SESSION["mail"] = $uidExists["email"];

            $result = mysqli_query($conn, "SELECT * FROM profileimg WHERE userid = ".$_SESSION['id'].";");

            while($row = mysqli_fetch_assoc($result)){
                $_SESSION["imgStatus"] = $row['status'];
            }


            header('Location: index.php');
            exit;
        }
        else{

            $expodedEmail = explode("@", $email);
            $endMail = $expodedEmail[1];

            if($endMail == "zaci.gopat.cz"){
                $expodedFirstEmail = explode(".", $expodedEmail[0]);
                $classEmail = end($expodedFirstEmail);
                $classEmail = strtoupper($classEmail);

            }

            // if user not exists we will insert the user
            $insert = mysqli_query($conn, "INSERT INTO `users`(`name`,`surname`,`class`, `email`, `google_id`) VALUES('$firstName','$lastName', '$classEmail', '$email','$google_id');");
            if($insert){
                $_SESSION['login_id'] = $google_id;
                header('Location: index.php');
                exit;
            }
            else{
                echo "Sign up failed!(Something went wrong).";
            }
        }
    }
    else{
        header('Location: login.php');
        exit;
    }

else:
    // Google Login Url = $client->createAuthUrl();
    ?>





<?php endif; ?>

    <div class="background">
        <div class="ball"></div>
        <div class="ball"></div>
    </div>
    <form class="form" action="includes/login.inc.php" method="post">
        <br>
        <br>


        <h3>Přihlásit se</h3>
        <input type="text" name="name" placeholder="Jméno..." >
        <br>
        <link rel="stylesheet" href="style.css"></link>

        <input type="text" name="surname" placeholder="Přijmení..." >
        <br>
        <b>Třída...</b>
        <select name="class">

            <option name="class" value="" selected="selected">Třída...</option>

            <?php
            $classes = getClasses($conn);
            foreach($classes as $class){
                echo "<option name='class' value='".$class['class']."'>".$class['class']."</option>";
            }
            
            ?>
        </select>
        <br>
        <input type="text" name="email" placeholder="Email..." >
        <br>
        <input type="password" name="pwd" placeholder="Heslo..." required>

        <a type="button" class="login-with-google-btn" href="<?php echo $client->createAuthUrl(); ?>">
            Sign in with Google
        </a>

        <button class="alficek" type="submit" name="submit">Přihlásit se</button>
        <?php
        include_once 'errorHandler.php';
        ?>

    </form>



<?php
include_once 'footer.php';
?>


<style media="screen">
      *,
*:before,
*:after{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}
body{
    background-color: #080710;
}
.background{
   
    height: 480px;
    position: absolute;
    transform: translate(-50%,-50%);
    left: 50%;
    top: 50%;
}
.background .ball{
    height: 200px;
    width: 200px;
    position: absolute;
    border-radius: 50%;
}
.ball:first-child{
    background: linear-gradient(
        purple,
        purple
    );
    left: -80px;
    top: -80px;
}
.ball:last-child{
    background: linear-gradient(
        to right,
        brown,
        brown
    );
    right: -10px;
    bottom: -80px;
}
.form{
    height: 600px;
    width: 375px;
    background-color: rgba(255,255,255,0.13);
    position: absolute;
    transform: translate(-50%,-50%);
    top: 50%;
    left: 50%;
    border-radius: 10px;
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255,255,255,0.1);
    box-shadow: 0 0 40px rgba(8,7,16,0.6);
    padding: 50px 35px;
}
.form *{
    font-family: 'Poppins',sans-serif;
    color: #ffffff;
    letter-spacing: 0.5px;
    outline: none;
    border: none;
}
.form h3{
    font-size: 32px;
    font-weight: 600;
    line-height: 42px;
    text-align: center;
}

label{
    display: block;
    margin-top: 30px;
    font-size: 16px;
    font-weight: 500;
}
input{
    display: block;
    height: 50px;
    width: 100%;
    background-color: rgba(255,255,255,0.07);
    border-radius: 3px;
    padding: 0 10px;
    margin-top: 8px;
    font-size: 14px;
    font-weight: 300;
}
::placeholder{
    color: #e5e5e5;
}
button{
    margin-top: 50px;
    width: 100%;
    background-color: #ffffff;
    color: #080710;
    padding: 15px 0;
    font-size: 18px;
    font-weight: 600;
    border-radius: 5px;
    cursor: pointer;
}


</style>