<?php
    include ("connection.php");
    session_start();

    $taskMessage = $_GET['taskMessage'];

    $nameQuery = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $nameQuery->bind_param("s", $_SESSION['currUser']);
    $nameQuery->execute();
    $nameResult = $nameQuery->get_result();
    $nameRow = $nameResult->fetch_assoc();

    // Insert the list name into the database
    $insertQuery = "INSERT INTO `items` (`itemID`, `listID`, `message`, `dateCreated`, `completed`) VALUES (NULL, {$_SESSION['currList']}, '$taskMessage', NOW(), 0)";
    mysqli_query($conn, $insertQuery);

    echo "<div id='taskList'>";
        $listItemQuery = 
            "SELECT *
            FROM items
            WHERE listID = '{$_SESSION['currList']}'
            ORDER BY completed ASC, dateCreated DESC;";
        $listItemResult = mysqli_query($conn, $listItemQuery);
    
        while ($data = $listItemResult->fetch_assoc()) 
        {
            echo "<div class='horContainer' style = 'height: auto;'>";
                
                        if($data['completed'] == '0')
                        {
                            echo "<div class='itemContainer'>";
                                echo "<div class='checkboxContainer'>";
                                    echo "<img class='checkbox' src='resources/icons/unchecked.png' onclick='markAsComplete({$data['itemID']}, {$_SESSION['currList']});'>";
                                echo "</div>";
                                echo "<p class = 'item'> {$data['message']} </p>";
                            echo "</div>";
                        }
                        else
                        {
                            echo "<div class='itemContainerDone'>";
                                echo "<div class='checkboxContainer'>";
                                    echo "<img class = 'checkbox' src = 'resources/icons/checked.png' onclick='markAsIncomplete({$data['itemID']}, {$_SESSION['currList']});'>";
                                echo "</div>";
                                echo "<p class = 'item'> <s> {$data['message']} </s> </p>";
                            echo "</div>";    
                        }
            echo "</div>";
        }
        // Add new task Option
        echo "<div class='horContainer' style = 'height: auto;'>";
            echo "<div class='newTaskContainer'>";
                echo "<div class='horContainer'>";
                    echo "<p class = 'newTask' onclick='openAddTask()'> new task+ </p>";
                echo "</div>";
            echo "</div>";
        echo "</div>";
    echo "</div>";  

?>
