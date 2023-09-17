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


function openList(event) {
    $('.hello').addClass('slide-out-left');
    $('.listContainer').addClass('slide-out-left');

     // Wait for animation to complete (adjust time as needed)
     setTimeout(function() {
        var formData = $('#openList').serialize(); // Serialize the form data
        $('.hello').hide();
        $('.listContainer').hide();
        $.ajax({
            type: 'POST',
            url: 'home.php',
            data: formData,
            success: function(response) {
                console.log(response) 
                $('.openedList').html(response);
            }
        });
    }, 1000); // Adjust the time (in milliseconds) as needed

    event.preventDefault(); // Prevent default button click behavior
}


