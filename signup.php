
<?php
    include_once 'header.php';
?>
     <div class="background">
        <div class="ball"></div>
        <div class="ball"></div>
    </div>
    <link rel="stylesheet" href="style.css"></link>
    <form  class="container form" action="includes/signup.inc.php" method="post">
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        
        
    	<h3>Registrovat</h3>
        <input class="A" type="text" name="name" placeholder="Jméno..." required><br>

        <input class="A" type="text" name="surname" placeholder="Přijmení..." required><br>
        <br>
        <b>Class...</b>
        <select name="class">
            <option class="black" name="class" value="" selected="selected">Třída...</option>
            <?php
            $classes = getClasses($conn);
            foreach($classes as $class){
                echo "<option name='class' value='".$class['class']."'>".$class['class']."</option>";
            }
            
            ?>
        </select>
        <br>
        <br>
        <input class="A" type="email" name="email" placeholder="Email...">
        <br>
        <input class="B" type="password" name="pwd" placeholder="Heslo..." required><br>
        <input class="C" type="password" name="pwdrepeat" placeholder="Opakovat heslo..." required><br>
          <?php include_once 'errorHandler.php';?>
        <button class="D" type="submit" name="submit">Registrovat se</button>

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
   
    height: 520px;
    position: absolute;
    transform: translate(-50%,-50%);
    left: 50%;
    top: 50%;
}

@media (max-width: 900px) {
    .form  {
        width: 100%x;
    }

    }
.background .ball{
    height: 200px;
    width: 200px;
    position: absolute;
    border-radius: 50%;
}
.ball:first-child{
    background: linear-gradient(
        red,
        red
    );
    left:-10px;
    top: -80px;
}
.ball:last-child{
    background: linear-gradient(
        to right,
        blue,
        blue
    );
    right: -10px;
    bottom: -80px;
}
h3 {
    font-family: Poppins, sans-serif;
    font-weight: 600;
    font-size: 40px;
    margin-top: -5%;
    justify-content: center;
    display: flex;  
}
.form{
    height: 800px;
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