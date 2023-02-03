<?php
include_once 'header.php'
?>

<?php
if(!isset($_SESSION['id'])){
    header("Location: index.php");
    exit();
}
?>

    <div class="background">
        <div class="ball"></div>
        <div class="ball"></div>
    </div>

    <div class="mainPartProfile">
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
         <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>

       
        <h3>Profile</h3>
        
        <br>
        <?php
            if(isset($_SESSION['imgStatus'])){
                if($_SESSION['imgStatus'] == 1){
                    $id = $_SESSION['id'];
                    $filename = "uploads/profile".$id."*";
                    $fileinfo = glob($filename);

                    echo "<img class='profilepicture' src=" . $fileinfo[0] ."?'".mt_rand().">";
                }else{
                    echo "<img class='profilepicture' src='Photos/FRAJER.png'></img>";
                }
            }
        ?>
        <br>
        <?php
        if(isset($_SESSION['id'])){

            echo "<form action='includes/uploadRestriction.inc.php' method='post' enctype='multipart/form-data'>
        <input style='color: white;background-color:black;'class='xag' type='file' name='file' required>

        <button class='smallbtn'  type='submit' name='submit'><b class='svoby'>Confirm profile picture change</b></button>
    </form>";

            if (isset($_SESSION['imgStatus'])) {
                if ($_SESSION['imgStatus'] == 1) {
                    echo "<form action='includes/deleteprofile.inc.php' method='post'>
            <button class='smallbtn' type='submit' name='submit'><b class='svoby'>Delete profile picture</b></button>
            </form>";
                }
            }

        }
        ?>
        <br>
<!--          <button class="smallbtn"><a class="profilebtn" href="#"><b class="svoby">Change profile picture</b></a></button>-->
             <hr>
           <b class="reputacehoub">Profile Info</b>
         <br>
        <?php
        if (isset($_SESSION['id'])) {
            echo "<b>Name:</b> <b>" . $_SESSION['name'] . "</b><br>";
            echo "<b>Surname:</b> <b>" . $_SESSION['surname'] . "</b><br>";
            echo "<b>Class:</b> <b>" . $_SESSION['class'] . "</b><br>";
            echo "<b>Email:</b> <b>" . $_SESSION['mail'] . "</b><br>";
        }
        ?>
        <button class="smallbtn"><a class="profilebtn" href="#"><b class="svoby2">Change password</b></a></button>
        <br>
        <button class="smallbtn"><a class="profilebtn" href="includes/logout.inc.php"><b class="svoby3">Logout</b></a></button>
        <br>

          <br>
          <hr>
          <b class="reputacehoub">Market</b>
<button class="smallbtn"><a class="profilebtn" href="#"><b class="svoby">My orders</b></a></button>
<br>
<button class="smallbtn"><a class="profilebtn" href="#"><b class="svoby">My sells</b></a></button>

    </div>

        

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


<style media="screen">
      *,
*:before,
*:after{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}

li {
	font-size: 35px;
}
body{
    background-color: #080710;
}
.background{
   
    height: 520px;
    position: absolute;
    transform: translate(-50%,-50%);
    left: 50%;
    top: 50%;
}
.svoby {
	transition: 0.2s;
}

input {
    margin-top: 1rem;
}

input::file-selector-button {
    font-weight: bold;
    color: white;
    padding: 0.5em;
    border: thin solid grey;
    border-radius: 3px;
    background-color: #FF8000;
    margin-top: 10px;
    transition: 0.2s;
    cursor: pointer;
}
input::file-selector-button:hover {
opacity: 0.7;
	transition: 0.2s;
}

.background .ball{
    height: 200px;
    width: 200px;
    position: absolute;
    border-radius: 50%;
}
.ball:first-child{
    background: linear-gradient(
        orange,
        orange
    );
    left: -80px;
    top: -80px;
}
.ball:last-child{
    background: linear-gradient(
        to right,
        green,
        green
    );
    right: -10px;
    bottom: -80px;
}

.profilepicture {
	width: 50px;
    height: 50px;
	justify-content: center;
	display: flex;
	margin-left: 125px;
	transition: 0.2s;
	cursor: pointer;
}

.profilepicture:hover {
	opacity: 0.5;
	transition: 0.2s;
}
.mainPartProfile{
    height: auto;
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
.mainPartProfile *{
    font-family: 'Poppins',sans-serif;
    color: #ffffff;
    letter-spacing: 0.5px;
    outline: none;
    border: none;
}
.mainPartProfile h3{
    font-size: 32px;
    font-weight: 600;
    line-height: 42px;
    text-align: center;
}


.reputacehoub {
	justify-content: center;
	display: flex;
	font-size: 20px;
}
.svoby {
	justify-content: center;
	display: flex;
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

.smallbtn {
	 margin-top: 12px;
	  margin-bottom: 12px;
    width: 100%;
    background-color: black;
    color: #080710;
    padding: 8px 0;
    font-size: 18px;
    font-weight: 600;
    border-radius: 5px;
    cursor: pointer;
}

hr {
	
background-color: white;
height: 5px;
margin-bottom: 12px;
}
</style>