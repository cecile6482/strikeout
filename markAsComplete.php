<?php
    include ("connection.php");

    $itemID = $_GET['itemID'];
    $listID = $_GET['listID'];

    // Update task status in the database...
    $updateQuery = "UPDATE items SET completed = 1 WHERE itemID = '$itemID'";
    mysqli_query($conn, $updateQuery);


    // Fetch updated data
    $listItemQuery = 
        "SELECT *
        FROM items
        WHERE listID = '$listID'
        ORDER BY completed ASC, dateCreated DESC;";
    $listItemResult = mysqli_query($conn, $listItemQuery);

    while ($data = $listItemResult->fetch_assoc()) 
    {
        echo "<div class='horContainer' style = 'height: auto;'>";
            
                    if($data['completed'] == '0')
                    {
                        echo "<div class='itemContainer'>";
                            echo "<div class='checkboxContainer'>";
                                echo "<img class='checkbox' src='resources/icons/unchecked.png' onclick='markAsComplete({$data['itemID']}, $listID);'>";
                            echo "</div>";
                            echo "<p class = 'item'> {$data['message']} </p>";
                        echo "</div>";
                    }
                    else
                    {
                        echo "<div class='itemContainerDone'>";
                            echo "<div class='checkboxContainer'>";
                                echo "<img class = 'checkbox' src = 'resources/icons/checked.png' onclick='markAsIncomplete({$data['itemID']}, $listID);'>";
                            echo "</div>";
                            echo "<p class = 'item'> <s> {$data['message']} </s> </p>";
                        echo "</div>";    
                    }
        echo "</div>";
    }
?>