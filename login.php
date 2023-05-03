<?php
include_once 'header.php';
?>
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