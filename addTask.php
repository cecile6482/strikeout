<?php

include("connection.php"); // Include the database connection
session_start(); // Start the session

// Get task message and current list ID
$taskMessage = $_GET['taskMessage'];
$listIDChosen = $_SESSION['currList'];

// Retrieve user information from the database
$nameQuery = $conn->prepare("SELECT * FROM users WHERE username = ?");
$nameQuery->bind_param("s", $_SESSION['currUser']);
$nameQuery->execute();
$nameResult = $nameQuery->get_result();
$nameRow = $nameResult->fetch_assoc();

// Insert the new task into the database
$insertQuery = "INSERT INTO `items` (`itemID`, `listID`, `message`, `dateCreated`, `completed`) VALUES (NULL, $listIDChosen, '$taskMessage', NOW(), 0)";
mysqli_query($conn, $insertQuery);

// REPRINT LIST
echo "<div id='taskList'>";
    $listItemQuery = "SELECT * FROM items WHERE listID = '$listIDChosen' ORDER BY completed ASC, dateCreated DESC;";
    $listItemResult = mysqli_query($conn, $listItemQuery);

    while ($data = $listItemResult->fetch_assoc()) {
        echo "<div class='horContainer' style='height: auto;'>";
        if ($data['completed'] == '0') {
            echo "<div class='itemContainer'>";
            echo "<div class='checkboxContainer'>";
            echo "<img class='checkbox' src='resources/icons/unchecked.png' onclick='markAsComplete({$data['itemID']}, $listIDChosen);'>";
            echo "</div>";
            echo "<p class='item'> {$data['message']} </p>";
            echo "<div class='checkboxContainer'>";
            echo "<img onclick='openEditTask({$data['itemID']})' class='editTaskIcon' src='resources/icons/edit.png'>";
            echo "</div>";
            echo "</div>";
        } else {
            echo "<div class='itemContainerDone'>";
            echo "<div class='checkboxContainer'>";
            echo "<img class='checkbox' src='resources/icons/checked.png' onclick='markAsIncomplete({$data['itemID']}, $listIDChosen);'>";
            echo "</div>";
            echo "<p class='item'> <s> {$data['message']} </s> </p>";
            echo "<div class='checkboxContainer'>";
            echo "<img onclick='openEditTask({$data['itemID']})' class='editTaskIcon' src='resources/icons/edit.png'>";
            echo "</div>";
            echo "</div>";
        }
        echo "</div>";
    }

    echo "<div class='horContainer' style='height: auto;'>";
        echo "<div class='newTaskContainer'>";
            echo "<div class='horContainer'>";
                echo "<p class='newTask' onclick='openAddTask()'> new task+ </p>";
            echo "</div>";
        echo "</div>";
    echo "</div>";
    
echo "</div>";

// Edit Task Container
echo "<div class='editTask' style='display: none;'>";
    echo "<div class='cover'>";
        echo "<div class='verContainer'>";
            echo "<div class='horContainer'>";
                echo "<div class='addNewMainCon'>";
                    echo "<p class='newListTitle'> edit list </p>";
                    echo '<input type="text" name="updatedTask" placeholder="change task" maxlength="40" required>';
                    echo "<button onclick='changeTaskName()'>change</button>";
                    echo "<img class='exit' onclick='closeEditTask()' src='resources/icons/x.png'>";
                    echo "<img class='deleteIcon' onclick='deleteTask()' src='resources/icons/trash.png'>";
                echo "</div>";
            echo "</div>";
        echo "</div>";
    echo "</div>";
echo "</div>";

?>
