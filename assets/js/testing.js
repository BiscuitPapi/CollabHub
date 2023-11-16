// Get the "Add" span element
var addSpan = document.querySelector(".clickable-add");
var addModal = document.getElementById("modal");
var addModalCloseButton = addModal.querySelector(".close");
var addModalContent = addModal.querySelector(".modal-content");

// Function to display the add modal
function showAddModal() {
    addModal.style.display = "block";
}

// Function to close the add modal
function closeAddModal() {
    addModal.style.display = "none";
}

// Close the add modal if the background is clicked
window.addEventListener("click", function(event) {
    if (event.target === addModal) {
        closeAddModal();
    }
});


// Prevent clicks inside the add modal content from closing the modal
addModalContent.addEventListener("click", function(event) {
    event.stopPropagation();
});	

addSpan.addEventListener("click", function () {
    console.log("Add button clicked"); // Add this line
    showAddModal();
});

// Close the add modal when the close button is clicked
addModalCloseButton.addEventListener("click", closeAddModal);


// Create New Club
var addClub = document.querySelector(".clickable-addClub");
var addClubModal = document.getElementById("modal_2");
var addClubModalCloseButton = addClubModal.querySelector(".close");
var addClubModalContent = addClubModal.querySelector(".modal-content");

// Function to display the add club model
function showAddClubModal() {
    addClubModal.style.display = "block";
}

// Function to close the add modal
function closeAddClubModal() {
    addClubModal.style.display = "none";
}

// Close the add modal if the background is clicked
window.addEventListener("click", function(event) {
    if (event.target === addClubModal) {
        closeAddClubModal();
    }
});


// Prevent clicks inside the add modal content from closing the modal
addClubModalContent.addEventListener("click", function(event) {
    event.stopPropagation();
});	

addClub.addEventListener("click", function () {
    console.log("Add button clicked"); // Add this line
    showAddClubModal();
});


// Close the add modal when the close button is clicked
addClubModalCloseButton.addEventListener("click", closeAddClubModal);


function addNewGroup() {
    var addedDepartmentInput = document.getElementById("input-1");
    var addedDepartment = addedDepartmentInput.value;

    var addedCourseInput = document.getElementById("input-2");
    var addedCourse = addedCourseInput.value;

    var addedNameInput = document.getElementById("input-3");
    var addedName = addedNameInput.value;

    var addedDescriptionInput = document.getElementById("input-4");
    var addedDescription = addedDescriptionInput.value;

    var addedSkillsInput = document.getElementById("input-5");
    var addedSkills = addedSkillsInput.value;
    
    var addedNotesInput = document.getElementById("input-6");
    var addedNotes = addedNotesInput.value;

    

    $.ajax({
        url: 'assets/php/process_addGroup.php',
        method: 'POST',
        data: {
            addedDepartment: addedDepartment,
            addedCourse: addedCourse,
            addedName: addedName,
            addedDescription: addedDescription,
            addedSkills: addedSkills,
            addedNotes: addedNotes
        },
        success: function (response) {
            // Split the response using the pipe character
            var responseParts = response.split('|');
            var status = responseParts[0]; // Get the status (success or error)
            var newApplicationID = responseParts[1]; // Get the newApplicationID

            if (status === "success") {
                alert("A new group has been created with ID: " + newApplicationID);
                closeAddModal();

                // Calculate rowCount dynamically based on the last row number
                var rowCount = $('#groupApplicationsTableBody tr').length + 1;

                // Append a new row to the table
                var newRow = '<tr>' +
                    '<th scope="row">' + rowCount + '</th>' + // Use rowCount to maintain the count
                    '<td">' + addedCourse + '</td>' + // Modify as needed
                    '<td style="text-align:center;">' + addedName + '</td>' + // Modify as needed
                    '<td ><a href="group_application_view.php?application_ID=' + newApplicationID + '" class="btn btn-info">View</a></td>' +
                    '</tr>';

                // Hide "No applications found" message if it exists
                var noApplicationsMessage = $('#groupApplicationsTableBody tr td:contains("No applications found.")');
                if (noApplicationsMessage.length > 0) {
                    noApplicationsMessage.parent().remove();
                }

                $('#groupApplicationsTableBody').append(newRow); // Append the new row
            } else {
                alert("Error occurred");
            }
        },
        error: function (xhr, status, error) {
            // Handle the error
            console.log(error);
        }
    });
}