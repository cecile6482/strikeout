<?php
    include("connection.php"); //Database connection
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
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
<body onload = homeOnload()>
    <!-- Loading Cover -->
    <div class = 'solidCover'>
        <div class = 'verContainer'>
            <div class = 'horContainer'>
                <img class = 'loading' src = 'resources/icons/heartsLoading.gif'>
            </div>
        </div>
    </div>
    <!-- All List Preview Home -->
    <h1 class = 'hello'> HELLO <?php echo strtoupper($_SESSION['currUser']."!"); ?> </h1>
    <img class = 'settings' src = 'resources/icons/settings.png' onclick = 'openSettings()'>
    <div id = 'listContainer' class = 'listContainer'>
        <?php
            $username = $_SESSION['currUser'];
            $sql = "SELECT *
        FROM users
        INNER JOIN lists ON users.userID = lists.userID
        WHERE users.username = '$username';";

            $result = mysqli_query($conn, $sql);
            
            if(mysqli_num_rows($result) == 0) {
                echo "<p style = 'text-align:center'> No lists yet. </p>";
            } else {
                while ($data = $result->fetch_assoc()) {
                    echo "<div class='horContainer'>";
                        echo "<div class='perListContainer'>";
                            echo "<div class='listNameVerContainer'>";
                                // List Title
                                echo "<p onclick='openList({$data['listID']})' class='listName'> {$data['listName']} </p>";
                                echo "<input type='hidden' name='listID' value='{$data['listID']}'>";


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

                                echo "<img onclick = 'openEditList({$data['listID']})' class='editListIcon' src='resources/icons/edit.png'>";
                            echo "</div>";
                        echo "</div>";
                    echo "</div>";
                }
            }
        //Add new list Option
            echo "<div class='horContainer'>";
                echo "<div class='newTaskContainer'>";
                    echo "<div class='horContainer'>";
                        echo "<p onclick = 'openAddList()' class='newTask'> new list+ </p>";
                    echo "</div>";
                echo "</div>";
            echo "</div>";
        ?>

    </div>
        
    <!-- Specific List: Gain info from getList.php -->
    <div id = 'openedList'> </div>

    <!-- Add new List Container -->
            
    <div class = 'addnewListAll'>
        <div class = 'cover'>
            <div class = 'verContainer'>
                <div class = 'horContainer'>
                    <div class = 'addNewMainCon'>
                        <p class = 'newListTitle' > new list </p> 
                        <input type="text" name="listName" placeholder="enter list name" maxlength="20" required>
                        <button onclick = 'addNewList()'>create</button>
                        <img class = 'exit'  onclick = 'closeAddList()' src = 'resources/icons/x.png'>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add new task Container -->
            
    <div class = 'addNewTaskAll'>
        <div class = 'cover'>
            <div class = 'verContainer'>
                <div class = 'horContainer'>
                    <div class = 'addNewMainCon'>
                        <p class = 'newListTitle' > new task </p> 
                        <input type="text" name="taskMessage" placeholder="enter task" maxlength="40" required>
                        <button onclick = 'addNewTask()'>create</button>
                        <img class = 'exit' onclick = 'closeAddTask()'src = 'resources/icons/x.png'>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Log out Container -->
            
    <div class = 'logout'>
        <div class = 'cover'>
            <div class = 'verContainer'>
                <div class = 'horContainer'>
                    <div class = 'addNewMainCon'>
                        <p class = 'newListTitle' > settings </p> 
                        <button onclick = 'logout()'>log out</button>
                        <img class = 'exit' onclick = 'closeSettings()'src = 'resources/icons/x.png'>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit List Container -->
            
    <div class = 'editList'>
        <div class = 'cover'>
            <div class = 'verContainer'>
                <div class = 'horContainer'>
                    <div class = 'addNewMainCon'>
                        <p class = 'newListTitle' > edit list </p> 
                        <input type="text" name="updatedListName" placeholder="change list name" maxlength="20" required>
                        <button onclick = 'changeListName()'>change</button>
                        <img class = 'exit' onclick = 'closeEditList()'src = 'resources/icons/x.png'>
                        <img class = 'deleteIcon' onclick = 'deleteList()'src = 'resources/icons/trash.png'>
                    </div>
                </div>
            </div>
        </div>
    </div>

    

</body>

</html>