<?php
include("connection.php");

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

session_start();

$listName = $_POST['listName'];

$nameQuery = "SELECT id FROM users WHERE username = '{$_SESSION['currUser']}'";
$nameResult = mysqli_query($conn, $nameQuery);
$nameRow = mysqli_fetch_array($nameResult, MYSQLI_ASSOC);

// Initialisation d'une variable pour stocker le HTML
$outputHTML = "";

// Insert the list name into the database
$insertQuery = "INSERT INTO `lists` (`listID`, `user_id`, `listName`, `dateCreated`) VALUES (NULL, '{$nameRow['id']}', '$listName' , NOW())";

$stmt = $conn->prepare("INSERT INTO `lists` (`listID`, `user_id`, `listName`, `dateCreated`) VALUES (NULL, ?, ?, NOW())");
$stmt->bind_param("ss", $nameRow['id'], $listName);

if ($stmt->execute()) {
    $response = ["status" => "success"];
} else {
    echo json_encode(["status" => "error", "message" => $stmt->error]);
    exit();
}

$username = $_SESSION['currUser'];
$sql = "SELECT *
        FROM users
        INNER JOIN lists ON users.user_id = lists.user_id
        WHERE users.username = '$username';";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
    $outputHTML .= "<p style='text-align:center'> No lists yet. </p>";
} else {
    while ($data = $result->fetch_assoc()) {
        $outputHTML .= "<div class='horContainer'>";
        $outputHTML .= "<div class='perListContainer'>";
        $outputHTML .= "<div class='listNameVerContainer'>";
        $outputHTML .= "<p onclick='openList({$data['listID']})' class='listName'> {$data['listName']} </p>";
        $outputHTML .= "<input type='hidden' name='listID' value='{$data['listID']}'>";

        $itemNumQuery = "SELECT COUNT(*) AS itemCount
                        FROM items
                        WHERE listID = '{$data['listID']}';";
        $itemNumResult = mysqli_query($conn, $itemNumQuery);

        if ($itemNumResult) {
            $itemNumData = mysqli_fetch_assoc($itemNumResult);
            $itemCount = $itemNumData['itemCount'];
            $outputHTML .= "<p class='listItemCount'> $itemCount items </p>";
        } else {
            $outputHTML .= "Error fetching item count";
        }

        $outputHTML .= "<img onclick='openEditList({$data['listID']})' class='editListIcon' src='resources/icons/edit.png'>";
        $outputHTML .= "</div>";
        $outputHTML .= "</div>";
        $outputHTML .= "</div>";
    }
}

// Add new list Option
$outputHTML .= "<div class='horContainer'>";
$outputHTML .= "<div class='newTaskContainer'>";
$outputHTML .= "<div class='horContainer'>";
$outputHTML .= "<p onclick='openAddList()' class='newTask'> new list+ </p>";
$outputHTML .= "</div>";
$outputHTML .= "</div>";
$outputHTML .= "</div>";

// Ajout de la clé HTML à la réponse
$response['html'] = $outputHTML;

// Envoyer la réponse
echo json_encode($response);
?>
