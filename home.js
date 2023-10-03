function submitForm(listID) { //OPEN LIST
    document.getElementsByName('listID')[0].value = listID; // Set the listID value
    document.getElementById('openList').submit(); // Trigger the form submission
}

function markAsComplete(itemID, listID) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("taskList").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "markAsComplete.php?itemID=" + itemID + "&listID=" + listID, true);
    xhttp.send();
}

function markAsIncomplete(itemID, listID) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("taskList").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "markAsIncomplete.php?itemID=" + itemID + "&listID=" + listID, true);
    xhttp.send();
}

let currOpenedList
function openList(listID) {
    currOpenedList = listID;
    $('.hello').addClass('slide-out-left');
    $('.listContainer').addClass('slide-out-left');
    $('.settings').addClass('slide-out-left');

    setTimeout(function() {
        $('.hello').removeClass('slide-out-left').hide();
        $('.listContainer').removeClass('slide-out-left').hide();
        $('.settings').removeClass('slide-out-left').hide();

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("openedList").innerHTML = this.responseText;
                
                // Add the slide-in-right class and show the element
                $('#openedList').addClass('slide-in-right').show();
            }
        };
        xhttp.open("GET", "getList.php?listID=" + listID, true);
        xhttp.send();
    }, 1000);
    setTimeout(function() {
        $('#openedList').removeClass('slide-in-right');
    }, 1600);
}

function backToLists(){
    $('#openedList').addClass('slide-out-right');

    setTimeout(function() {
        $('.hello').addClass('slide-in-left').show();
        $('.settings').addClass('slide-in-left').show();
        $('.listContainer').addClass('slide-in-left').show();
        $('#openedList').removeClass('slide-out-right').hide();
    }, 500);
    setTimeout(function() {
        $('.hello').removeClass('slide-in-left');
        $('.listContainer').removeClass('slide-in-left');
    }, 1000);
}

function homeOnload ()
{
    $('.addnewListAll').hide();
    $('.addNewTaskAll').hide();
    $('.editList').hide();
    $('.logout').hide();
    $('.solidCover').show();
    setTimeout(function() {
        $('.solidCover').addClass('fade-out');
    }, 2000);
    setTimeout(function() {
        $('.solidCover').removeClass('fade-out').hide();
    }, 2300);
    
    
}

function openAddList()
{
    $('.addnewListAll').addClass('fade-in').show();
    setTimeout(function() {
        $('.addnewListAll').removeClass('fade-in');
    }, 1000);
}
function closeAddList()
{
    $('.addnewListAll').addClass('fade-out');
    setTimeout(function() {
        $('.addnewListAll').removeClass('fade-out').hide();
    }, 1000);
}

function openAddTask()
{
    $('.addNewTaskAll').addClass('fade-in').show();
    setTimeout(function() {
        $('.addNewTaskAll').removeClass('fade-in');
    }, 1000);
}
function closeAddTask()
{
    $('.addNewTaskAll').addClass('fade-out');
    setTimeout(function() {
        $('.addNewTaskAll').removeClass('fade-out').hide();
    }, 1000);
}

function addNewList()
{
    var listName = $('input[name="listName"]').val(); // Get the entered list name

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var response = JSON.parse(this.responseText); // Parse the JSON response
            if (response.status === "success") {
                document.getElementById("listContainer").innerHTML = this.responseText;
            } else {
                alert("Erreur : " + response.message); // Display the error message
            }
        }
    };
    xhttp.open("POST", "addList.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("listName=" + listName);
    closeAddList();
};


function addNewTask()
{
    var taskMessage = $('input[name="taskMessage"]').val(); // Get the entered list name
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            document.getElementById("taskList").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "addTask.php?taskMessage=" + taskMessage, true);
    xhttp.send();
    closeAddTask();
};

function logout()
{
    window.location.href = 'login.php'
}

//SETTINGS
function openSettings()
{
    $('.logout').addClass('fade-in').show();
    setTimeout(function() {
        $('.logout').removeClass('fade-in');
    }, 1000);
}
function closeSettings()
{
    $('.logout').addClass('fade-in').show();
    setTimeout(function() {
        $('.logout').removeClass('fade-in');
    }, 1000);
}

//EDIT LIST
let currListToEdit;
function openEditList(listID)
{
    currListToEdit = listID;
    $('.editList').addClass('fade-in').show();
    setTimeout(function() {
        $('.editList').removeClass('fade-in');
    }, 1000);
}
function closeEditList()
{
    $('.editList').addClass('fade-out');
    setTimeout(function() {
        $('.editList').removeClass('fade-out').hide();
    }, 1000);
}


function changeListName()
{
    var listID = currListToEdit;
    var newListName = $('input[name="updatedListName"]').val(); // Get the entered list name

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("listContainer").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "changeListName.php?newListName=" + newListName + "&listID=" + listID, true);
    xhttp.send();
    closeEditList();
};

//delete LIST
function deleteList()
{
    var listID = currListToEdit;

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("listContainer").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "deleteList.php?listID=" + listID, true);
    xhttp.send();
    closeEditList();
};

//EDIT TASK
let currTaskToEdit;
function openEditTask(taskID)
{
    currTaskToEdit = taskID;
    $('.editTask').addClass('fade-in').show();
    setTimeout(function() {
        $('.editTask').removeClass('fade-in');
    }, 1000);
}
function closeEditTask()
{
    $('.editTask').addClass('fade-out');
    setTimeout(function() {
        $('.editTask').removeClass('fade-out').hide();
    }, 1000);
}


function changeTaskName()
{
    var taskID = currTaskToEdit;
    var newTask = $('input[name="updatedTaskName"]').val(); // Get the entered Task name

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("openedList").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "changeTask.php?newTask=" + newTask + "&taskID=" + taskID  + "&currList=" + currOpenedList, true);
    xhttp.send();
    closeEditTask();
};

//delete Task
function deleteTask()
{
    var taskID = currTaskToEdit;

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("openedList").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "deleteTask.php?taskID=" + taskID + "&currList=" + currOpenedList, true);
    xhttp.send();
    closeEditTask();
};