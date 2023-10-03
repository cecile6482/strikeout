<?php
include ("connection.php");

if (isset($_POST['login']))
{
    $username = strtolower($_POST['user']);
    $password = $_POST['pass'];

    // Utilisation de requêtes préparées
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $count = $result->num_rows;

    session_start();

    if ($count == 1)
    {
        $_SESSION['currUser'] = $row['username'];
        $_SESSION['userID'] = $row['userID'];  // Stocker le userID dans la session
        header("location:home.php");
    }
    else
    {
        header("location:login.php?loginerror=1");
    }
}

if (isset($_POST['signup']))
{
    $username = $_POST['user'];
    $password = $_POST['pass'];

    // Vérifier les doublons
    $dupstmt = $conn->prepare("SELECT username FROM users WHERE username = ?");
    $dupstmt->bind_param("s", $username);
    $dupstmt->execute();
    $dupresult = $dupstmt->get_result();
    $dupcount = $dupresult->num_rows;

    if ($username == "" || $password == "")
    {
        header("location:login.php?blankCredentials=1");
    }
    else if ($dupcount > 0)
    {
        header("location:login.php?signuperror=1");
    }
    else
    {
        session_start();
        $_SESSION['currUser'] = $username;

        // Créer un nouvel utilisateur dans la base de données
        $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $password);

        if ($stmt->execute())
        {
            $_SESSION['userID'] = $conn->insert_id;  // Récupérer le userID généré automatiquement
            header("location:home.php");
        }
        else
        {
            // Gestion des erreurs d'insertion
            header("location:login.php?signuperror=1");
        }
    }
}
?>
