<?php
    include ("connection.php");

    if (isset($_POST['login']))
    {
        
        $username = strtolower($_POST['user']);
        $password = $_POST['pass'];

        $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);

        session_start();

        if($count == 1)
        {
            $_SESSION['currUser'] = $row['username'];
            header("location:home.php");
        }
        else
        {
            header("location:login.php?loginerror=1");
        }
    }

    if(isset($_POST['signup']))
    {
		$username = $_POST['user'];
		$password = $_POST['pass'];

        $dup = "SELECT username FROM users WHERE username='".$username."'";
        $dupresult = mysqli_query($conn, $dup);
        $duprow = mysqli_fetch_array($dupresult, MYSQLI_ASSOC);
        $dupcount = mysqli_num_rows($dupresult);

        if($username == "" || $password == "")
        {
            header("location:login.php?blankCredentials=1");
        }
        else if($dupcount > 0)
        {
            header("location:login.php?signuperror=1");
        }
        else
        {
            //Create new user in database
            $_SESSION['currUser'] = $username;
            $sql = "INSERT INTO users (username, password, userID) VALUES ('$username','$password', NULL)";
            $conn->query($sql);

            // Redirect to home.php
            header("location:home.php");

        }

    }

?>