<?php
    include ("connection.php");
    session_start();

    $listIDChosen = $_GET['listID'];
    $listNameQuery = "SELECT *
                FROM lists
                WHERE listID = '$listIDChosen';";
    $result = mysqli_query($conn, $listNameQuery);
    $curr = mysqli_fetch_assoc($result);

    echo "<img class = 'backButton' src = 'resources/icons/back.png' onclick = 'backToLists()'>";
    if ($curr) {
        echo "<h1 class='listNameTitle'>{$curr['listName']}</h1>";
    } else {
        echo "List not found.";
    }

    $_SESSION['currList'] = $listIDChosen;
    echo "<div id='taskList'>";
        $listItemQuery = 
            "SELECT *
            FROM items
            WHERE listID = '$listIDChosen'
            ORDER BY completed ASC, dateCreated DESC;";
        $listItemResult = mysqli_query($conn, $listItemQuery);
    
        while ($data = $listItemResult->fetch_assoc()) 
        {
            echo "<div class='horContainer' style = 'height: auto;'>";
                
                        if($data['completed'] == '0')
                        {
                            echo "<div class='itemContainer'>";
                                echo "<div class='checkboxContainer'>";
                                    echo "<img class='checkbox' src='resources/icons/unchecked.png' onclick='markAsComplete({$data['itemID']}, {$curr['listID']});'>";
                                echo "</div>";
                                echo "<p class = 'item'> {$data['message']} </p>";
                            echo "</div>";
                        }
                        else
                        {
                            echo "<div class='itemContainerDone'>";
                                echo "<div class='checkboxContainer'>";
                                    echo "<img class = 'checkbox' src = 'resources/icons/checked.png' onclick='markAsIncomplete({$data['itemID']}, {$curr['listID']});'>";
                                echo "</div>";
                                echo "<p class = 'item'> <s> {$data['message']} </s> </p>";
                            echo "</div>";    
                        }
            echo "</div>";
        }
        echo "<div class='horContainer' style = 'height: auto;'>";
            echo "<div class='newTaskContainer'>";
                echo "<div class='horContainer'>";
                    echo "<p class = 'newTask' onclick='openAddTask()'> new task+ </p>";
                echo "</div>";
            echo "</div>";
        echo "</div>";
    echo "</div>";  
?>