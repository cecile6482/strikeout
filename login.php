<?php
include("connection.php"); //Database connection
include("validateLogin.php"); //Validate Login
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <!-- External Stylesheets -->
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="animations.css">

    <!-- Import jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <!-- External Javascript -->
    <script src="login.js"></script>

    <title>bunnyBop - Log In</title>
</head>
<body onload = 'loginOnload()'>
    <div class = 'verContainer'>
        <div class = 'mainVerContainer'>
            <img class = 'mainLogo' src = 'resources/images/bunnyBopLogo.png'>

            <!-- Login Form -->
            <form id = 'loginForm' name="form" method="post" action="validateLogin.php">
                <div class="verContainer">
                    <input type="text" id="user" name="user" placeholder="enter username" autocomplete="off" maxlength="15"> 
                    <br>
                    <input type="text" id="pass" name="pass" placeholder="enter password" style="-webkit-text-security: square;" autocomplete="off">
                    <br>
                    <button type = 'submit' id="loginButton" name="login"> log in </button>
                </div>
            </form>

            <!-- Create Account Option -->
            <p id = 'createAccountOpion' > Not a user? <span class = 'link' onclick = 'moveToSignUp()'>Create an account.</span> </p> 

            <!-- Success Message: Account Created -->
            <?php 
                    if (isset($_GET['accountCreated']) && $_GET['accountCreated'] == 1) { 
                        echo "<p class = 'success'> Account created. </p>";
                    }
                ?>
            <!-- Error Message: Wrong credientials -->
            <?php 
                    if (isset($_GET['loginerror']) && $_GET['loginerror'] == 1) { 
                        echo "<p class = 'error'> Credentials not correct, try again. </p>";
                    }
                ?>
        </div>
    </div>

    <!-- CD Animations -->
    <img id = 'cd1' src = 'resources/images/cd.png'>
    <img id = 'cd2' src = 'resources/images/cd.png'>
    <img id = 'cd3' src = 'resources/images/cd.png'>

</body>

</html>