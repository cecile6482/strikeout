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
            $_SESSION['currUser'] = $row['userID'];
            header("location:playlistsPages/home.php");
        }
        else
        {
            header("location:login.php?loginerror=1");
        }
    }

?>