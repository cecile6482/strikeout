<?php
    include("connection.php"); //Database connection
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <!-- External Stylesheets -->
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="animations.css">

    <!-- External Javascript -->
    <script src="home.js"></script>

    <!-- Import jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <title>strikeout - Home</title>
</head>
<body>
    <!-- All List Preview Home -->
    <h1 class = 'hello'> HELLO <?php echo strtoupper($_SESSION['currUser']."!"); ?> </h1>
    <div class = 'listContainer'>
        <?php
            $username = $_SESSION['currUser'];
            $sql = "SELECT *
                    FROM users
                    INNER JOIN lists ON users.userID = lists.userID
                    WHERE users.username = '$username';";
            $result = mysqli_query($conn, $sql);

            while ($data = $result->fetch_assoc()) {
                echo "<div class='horContainer'>";
                    echo "<div class='perListContainer'>";
                        echo "<div class='listNameVerContainer'>";
                            // List Title
                            echo "<form id='openList' method='post' action='home.php'>";
                                echo "<button onclick='return openList(event)' class='listName' type='button' name='clickList' value='{$data['listID']}'> {$data['listName']} </button>                                ";
                                echo "<input type='hidden' name='listID' value='{$data['listID']}'>";
                            echo "</form>";




                            $itemNumQuery = "SELECT COUNT(*) AS itemCount
                                            FROM items
                                            WHERE listID = '{$data['listID']}';";
                            $itemNumResult = mysqli_query($conn, $itemNumQuery);

                            if ($itemNumResult) {
                                $itemNumData = mysqli_fetch_assoc($itemNumResult);
                                $itemCount = $itemNumData['itemCount'];
                                echo "<p class='listItemCount'> $itemCount items </p>";
                            } else {
                                echo "Error fetching item count";
                            }

                            echo "<img class='more' src='resources/icons/more.png'>";
                        echo "</div>";
                    echo "</div>";
                echo "</div>";
            }
        ?>

    </div>
        
    <!-- Specific List -->
    <div class = 'openedList'>
        <?php
            if (isset($_POST['clickList'])) {
                $listIDChosen = $_POST['listID'];
                $listNameQuery = "SELECT *
                            FROM lists
                            WHERE listID = '$listIDChosen';";
                $result = mysqli_query($conn, $listNameQuery);
                $curr = mysqli_fetch_assoc($result);
            
                if ($curr) {
                    echo "<h1 class='listNameTitle'>{$curr['listName']}</h1>";
                } else {
                    echo "List not found.";
                }

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
                                echo "<p class = 'newTask'> new task+ </p>";
                            echo "</div>";
                        echo "</div>";
                    echo "</div>";
                echo "</div>";    
            }
        ?>
    </div>


    

</body>

</html>