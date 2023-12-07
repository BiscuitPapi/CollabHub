function updateProfile() {
    var newMatricNumValue = document.getElementById("matricNum").value;
    var newMobileValue = document.getElementById("mobile").value;
    var newPositionValue = document.getElementById("position").value;
    var newAboutValue = document.getElementById("newAbout").value;


    // alert(newMatricNumValue);
    // Create an object with the data to be sent
    var data = {
        matricNum: newMatricNumValue,
        mobile: newMobileValue,
        position: newPositionValue,
        about: newAboutValue
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
					
    var addedNameInput = document.getElementById("addedName");
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