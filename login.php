<?php
include("connection.php"); //Database connection
include("validate.php"); //Validate Login
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

    <!-- External Javascript -->
    <script src="login.js"></script>

    <!-- Import jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <title>strikeout - Log In</title>
</head>
<body onload = 'loginOnload()'>
    <div class = 'horContainer'>
        <div class = 'verContainer'>
            <!-- Main Circle -->
            <div class = 'gridContainer'>
                <img id = 'menuCircle' src = "resources/images/menuCircle.png">
                <!-- Login Container -->
                <div class = 'loginContainer'>
                    <div class = 'verContainer'>
                        <!-- Title -->
                        <h1 class = 'strikeoutTitle'> strikeout </h1>
                        <!-- Login Form -->
                        <form id = 'loginForm' name="form" method="post" action="validate.php">
                            <div class="verContainer">
                                <input type="text" id="user" name="user" placeholder="enter username" autocomplete="off" maxlength="15"> 
                                <br>
                                <input type="text" id="pass" name="pass" placeholder="enter password" style="-webkit-text-security: square;" autocomplete="off">
                                <br>
                                <button type = 'submit' id="loginButton" name="login"> log in </button>
                            </div>
                            <br>
                        </form>
                        <!-- Create Account Option -->
                        <p id = 'createAccountOption' > Not a user? <span class = 'link' onclick = 'switchToSignup()'>Create an account.</span> </p> 
                        
                        <!-- Signup Form -->
                        <form id = 'signupForm' name="form" method="post" action="validate.php">
                            <div class="verContainer">
                                <input type="text" id="user" name="user" placeholder="create a username" autocomplete="off" maxlength="15"> 
                                <br>
                                <input type="text" id="pass" name="pass" placeholder="create a password" style="-webkit-text-security: square;" autocomplete="off">
                                <br>
                                <button type = 'submit' id="signupButton" name="signup"> sign up </button>
                            </div>
                            <br>
                        </form>
                        <!-- Create Account Option -->
                        <p id = 'loginOption' > Already a user? <span class = 'link' onclick = 'switchToLogin()'>Log in.</span> </p> 
                    </div>
                </div>
            </div>
        </div>
    </div>

    <img id = 'star1' src = 'resources/images/star.png'>
    <img id = 'star2' src = 'resources/images/star.png'>
    <img id = 'star3' src = 'resources/images/star.png'>
    
    

</body>

</html>