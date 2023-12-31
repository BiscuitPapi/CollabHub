function toggle(tabId) {
    var tabs = ["about", "badge", "experience", "pictureBanner", "schedule"];

    tabs.forEach(function (tab) {
        var currentTab = document.getElementById(tab);
        currentTab.style.display = tab === tabId ? "block" : "none";
    });
}



function updateProfile() {
    var newMatricNumValue = document.getElementById("matricNum").value;
    var newMobileValue = document.getElementById("mobile").value;
    var newPositionValue = document.getElementById("position").value;
    var newAboutValue = document.getElementById("newAbout").value;
    var newYearValue = document.getElementById("year").value;
    var newDepartmentValue = document.getElementById("department").value;

    // Create an object with the data to be sent
    var data = {
        matricNum: newMatricNumValue,
        mobile: newMobileValue,
        position: newPositionValue,
        about: newAboutValue,
        year: newYearValue,
        department: newDepartmentValue

    };

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "assets/php/process_editProfile.php", true);
    xhr.setRequestHeader("Content-Type", "application/json"); // Set the content type to JSON

    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                console.log(xhr.responseText);
                alert("Changes saved successfully!");
            } else {
                console.error("Error updating profile information: " + xhr.statusText);
                alert("Error updating profile information. Please try again.");
            }
        }
    };

    // Convert the data object to a JSON string
    var jsonData = JSON.stringify(data);

    // Send the JSON data in the request
    xhr.send(jsonData);
}


function addNewBadge() {
					
    var addedNameInput = document.getElementById("myInput");
    var addedName = addedNameInput.value;
      
    // Check if the input name is empty
    if (addedName.trim() === "") {
        alert("Please enter a name for the badge.");
        return; // Stop further execution
    }
      
    var addedTypeInput = document.getElementById("addedType");
    var addedType = addedTypeInput.value;
    

    $.ajax({
        url: 'assets/php/process_addBadge.php',
        method: 'POST',
        data: { addedName: addedName, addedType: addedType },
        success: function(response) {
        // Handle the response from the PHP script
            console.log(response);
        },
        error: function(xhr, status, error) {
            // Handle the error
            console.log(error);
        }
    });
    
    alert("A new badge has been added!");
    // Reload the current page
    location.reload();
}

function deleteBadge(badgeID) {
    $.ajax({
        url: 'assets/php/process_deleteBadge.php',
        method: 'POST',
        data: { badgeID: badgeID },
        success: function(response) {
            // Handle the response from the PHP script
            console.log(response);
        },
        error: function(xhr, status, error) {
            // Handle the error
            console.log(error);
        }
    });		
    alert("The badge has been deleted!");
}

function saveChanges() {
    var badges = document.getElementsByClassName("badge-input");
                                              
    for (var i = 0; i < badges.length; i++) {
        var badge_ID = badges[i].id.split("_")[1];
        var badgeName = badges[i].value;										
        updateBadgeName(badge_ID, badgeName);
    }
                                              
    alert("Changes saved successfully!");
}

function updateBadgeName(badge_ID, badgeName) {
    $.ajax({
        url: 'assets/php/process_updateBadge.php',
        method: 'POST',
        data: { badge_ID: badge_ID, badgeName: badgeName },
        success: function(response) {
        // Handle the response from the PHP script
            console.log(response);
        },
        error: function(xhr, status, error) {
            // Handle the error
            console.log(error);
        }
    });
}

function validateDates() {
    var startDate = new Date(document.getElementById("input_4").value);
    var endDate = new Date(document.getElementById("input_5").value);

    if (startDate > endDate) {
        alert("Start date cannot be greater than end date.");
        return false; // Prevent form submission
    }

    return true; // Allow form submission
}
