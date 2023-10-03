<?php
    $servername = "localhost";
    $dbusername = "root";
    $dbpassword = "root";
    $dbname = "strikeout";
    $port = 8889;

    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname, $port);

    if ($conn->connect_error) {
        die("Connection failed" . $conn->connect_error);
    }
?>
