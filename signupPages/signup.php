<?php
include("../connection.php"); //Database connection
include("../validateLogin.php"); //Validate Login

?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <!-- External Stylesheets -->
    <link rel="stylesheet" href="../main.css">
    <link rel="stylesheet" href="../login.css">
    <link rel="stylesheet" href="signup.css">
    <link rel="stylesheet" href="../animations.css">

    <!-- Import jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <!-- External Javascript -->
    <script src="../login.js"></script>

    <title>bunnyBop - Sign Up</title>
</head>
<body onload = 'signupOnload()'>
    <div class = 'verContainer'>
        <div class = 'mainVerContainerSignUp'>
            <img class = 'mainLogo' src = '../resources/images/bunnyBopLogo.png'>

            <!-- Login Form -->
            <form id = 'signUpForm' name="signUpForm" method="post" action="validateSignup.php">
                <div class="verContainer">
                    <input type="text" id="user" name="user" placeholder="create a username" autocomplete="off" maxlength="15"> 
                    <br>
                    <input type="text" id="pass" name="pass" placeholder="create a password" style="-webkit-text-security: square;" autocomplete="off">
                    <br>
                    <input type="text" id="passConfirm" name="confirmPass" placeholder="confirm password" style="-webkit-text-security: square;" autocomplete="off">
                    <br>
                    <button type = 'submit' id="signUpButton" name="signup"> sign up </button>
                </div>
            </form>

            <!-- Create Account Option -->
            <p id = 'loginOption'> Already a user? <span class = 'link' onclick = 'moveToLogin()'>Log in.</span> </p> 

            <!-- Error Message: Blank credientials -->
            <?php 
                if (isset($_GET['signuperror']) && $_GET['signuperror'] == 1) { 
                    echo "<p class = 'error'> credentials cannot be blank. </p>";
                }
            ?>
            <!-- Error Message: Duplicate username -->
            <?php 
                if (isset($_GET['signuperror2']) && $_GET['signuperror2'] == 1) { 
                    echo "<p class = 'error'> username already taken, try again. </p>";
                }
            ?>
            <!-- Error Message: Passwords do not match -->
            <?php 
                if (isset($_GET['signuperror3']) && $_GET['signuperror3'] == 1) { 
                    echo "<p class = 'error'> passwords do not match, try again. </p>";
                }
            ?>
        </div>
    </div>
    
    <!-- CD Animations -->
    <img id = 'cd1' src = '../resources/images/cd.png'>
    <img id = 'cd2' src = '../resources/images/cd.png'>
    <img id = 'cd3' src = '../resources/images/cd.png'>
    
</body>

</html>