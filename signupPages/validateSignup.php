<?php
    include ("../connection.php");

    if(isset($_POST['signup']))
    {
		$username = $_POST['user'];
		$password = $_POST['pass'];
        $confirmPassword = $_POST['confirmPass'];

        $dup = "SELECT username FROM users WHERE username='".$username."'";
        $dupresult = mysqli_query($conn, $dup);
        $duprow = mysqli_fetch_array($dupresult, MYSQLI_ASSOC);
        $dupcount = mysqli_num_rows($dupresult);

        if($username == "" || $password == "" || $confirmPassword == "")
        {
            header("location:signup.php?signuperror=1");
        }
        else if($dupcount > 0)
        {
            header("location:signup.php?signuperror2=1");
        }
        else if($confirmPassword != $password)
        {
            header("location:signup.php?signuperror3=1");
        }
        else
        {
            //Create new user in database
            $_SESSION['currUser'] = $username;
            $sql = "INSERT INTO users (username, password, userID) VALUES ('$username','$password', NULL)";
            $conn->query($sql);

            // Redirect to home.php
            header("location:../login.php?accountCreated=1");

        }

        
    }

?>