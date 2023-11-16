function addNewBadge() {
					
    var addedNameInput = document.getElementById("addedName");
    var addedName = addedNameInput.value;
              
    // Check if the input name is empty
    if (addedName.trim() === "") {
        alert("Please enter a name for the badge.");
        return; // Stop further execution					
    }
              
            
    var addedType = "Soft Skills";
            
        
    $.ajax({
        url: '../php/cubaan.php',
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
                    