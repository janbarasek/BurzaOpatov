<?php
include_once 'header.php'
?>
<h1>Profile page</h1>

<?php
if (isset($_SESSION['id'])) {
    echo "<p> Hello " . $_SESSION['id'] . "!</p>";
}
?>

<?php
include_once 'footer.php'
?>
<?php
include_once 'header.php';
?>

    <p>
        This is the login page.
    </p>

    <div class="background">
        <div class="ball"></div>
        <div class="ball"></div>
    </div>
    <form action="includes/login.inc.php" method="post">
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        

       
        <b><h3 class="baf">Profile</h3></b>
        
        <br>
        <img class="profilepicture" src="FRAJER.png"></img>
        <br>
          <button class="smallbtn"><a class="profilebtn" href="#"><b class="svoby">Change profile picture</b></a></button>
             <hr>
           <b class="reputacehoub">Profile Info</b>
         <br>
          <b>Name:</b>
           <br>
          <b>Surname:</b>
          <br>
          <b>Class:</b>
           <br>
          <b>Password:</b>
          <button class="smallbtn"><a class="profilebtn" href="#"><b class="svoby2">Change password</b></a></button>
          <br>
          <b>Email:</b>
           <br>
           
          <br>
          <hr>
          <b class="reputacehoub">Market</b>
<button class="smallbtn"><a class="profilebtn" href="#"><b class="svoby">My orders</b></a></button>
<br>
<button class="smallbtn"><a class="profilebtn" href="#"><b class="svoby">My sells</b></a></button>
        

        

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
    width: 430px;
    height: 520px;
    position: absolute;
    transform: translate(-50%,-50%);
    left: 50%;
    top: 50%;
}
.svoby {
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
	justify-content: center;
	display: flex;
	margin-left: 150px;
	transition: 0.2s;
	cursor: pointer;
}

.profilepicture:hover {
	opacity: 0.5;
	transition: 0.2s;
}
form{
    height: 800px;
    width: 400px;
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
form *{
    font-family: 'Poppins',sans-serif;
    color: #ffffff;
    letter-spacing: 0.5px;
    outline: none;
    border: none;
}
form h3{
    font-size: 32px;
    font-weight: 500;
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