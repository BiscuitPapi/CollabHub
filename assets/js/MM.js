function togglePage(pageId) {
    // Hide all pages
    document.getElementById('pendingList').style.display = 'none';
    document.getElementById('rejectedList').style.display = 'none';
  
    // Show the selected page
    document.getElementById(pageId).style.display = 'block';
  
    // Update button styles based on active page
    document.getElementById('pendingList-button').className = 'btn ' + (pageId === 'pendingList' ? 'btn-primary' : 'btn-dark');
    document.getElementById('rejectedList-button').className = 'btn ' + (pageId === 'rejectedList' ? 'btn-primary' : 'btn-dark');
}

function approvalMM(mt_ID, answer) {
    var answerText = answer.toLowerCase();
    if (answerText === "rejected") {
        answerText = answerText.slice(0, -2);
    } else {
        answerText = answerText.slice(0, -1);
    }
    if (confirm("Are you sure you want to " + answerText + " this application?")) {
        $.ajax({
            url: 'assets/php/process_applicationApproval.php',
            method: 'POST',
            data: { mt_ID: mt_ID, status: answer },
            success: function (response) {
                // Handle the response from the PHP script
                console.log(response);
                if (answer == "Rejected")
                    alert("Application has been rejected!");
                else
                    alert("Application has been approved!");
            },
            error: function (xhr, status, error) {
                // Handle the error
                console.log(error);
            }
        });
    }
}

// Get the "Add" span element
var addSpan = document.querySelector(".clickable-add");

// Get the "Delete" span element
var deleteSpan = document.querySelector(".clickable-delete");

// Get the add modal, close button, and modal content
var addModal = document.getElementById("modal");
var addModalCloseButton = addModal.querySelector(".close");
var addModalContent = addModal.querySelector(".modal-content");

// Get the delete modal, close button, and modal content
var deleteModal = document.getElementById("delete-modal");
var deleteModalCloseButton = deleteModal.querySelector(".close");
var deleteModalContent = deleteModal.querySelector(".modal-content");

// Function to display the add modal
function showAddModal() {
    addModal.style.display = "block";
}

// Function to close the add modal
function closeAddModal() {
    addModal.style.display = "none";
}

// Function to display the delete modal
function showDeleteModal() {
    deleteModal.style.display = "block";
}

// Function to close the delete modal
function closeDeleteModal() {
    deleteModal.style.display = "none";
}

// Open the add modal when the "Add" span is clicked
addSpan.addEventListener("click", showAddModal);

// Close the add modal when the close button is clicked
addModalCloseButton.addEventListener("click", closeAddModal);

// Close the add modal if the background is clicked
window.addEventListener("click", function (event) {
    if (event.target === addModal) {
        closeAddModal();
    }
});

// Prevent clicks inside the add modal content from closing the modal
addModalContent.addEventListener("click", function (event) {
    event.stopPropagation();
});

// Open the delete modal when the "Delete" span is clicked
deleteSpan.addEventListener("click", showDeleteModal);

// Close the delete modal when the close button is clicked
deleteModalCloseButton.addEventListener("click", closeDeleteModal);

// Close the delete modal if the background is clicked
window.addEventListener("click", function (event) {
    if (event.target === deleteModal) {
        closeDeleteModal();
    }
});

// Prevent clicks inside the delete modal content from closing the modal
deleteModalContent.addEventListener("click", function (event) {
    event.stopPropagation();
});

function addNewBadge() {
    var addedNameInput = document.getElementById("addedSubject");
    var addedName = addedNameInput.value;

    // Check if the input name is empty
    if (addedName.trim() === "") {
        alert("Please enter a name for the badge.");
        return; // Stop further execution
    }

    $.ajax({
        url: 'assets/php/cubaan.php',
        method: 'POST',
        data: { addedName: addedName },
        success: function (response) {
            // Handle the response from the PHP script
            console.log(response);

            // If the response indicates success, hide the "no-subjects-found" sentence
            if (response === "success") {
                var noSubjectsFound = document.getElementById("no-subjects-found");
                if (noSubjectsFound) {
                    noSubjectsFound.style.display = "none";
                }

                // Create a new badge element
                var newBadge = document.createElement("a");
                newBadge.className = "badge badge-dark badge-pill mr-2";
                newBadge.innerText = addedName; // Set the badge text to the added name

                // Append the new badge to the "badge-container" div
                var badgeContainer = document.getElementById("badge-container");
                badgeContainer.appendChild(newBadge);

                // Count the number of badges currently in the container
                var badgeCount = badgeContainer.querySelectorAll(".badge").length;

                // If the badge count is a multiple of 4, open a new row
                if (badgeCount % 4 === 0) {
                    // Create a new div to open a new row
                    var newBadgeRow = document.createElement("div");
                    newBadgeRow.className = "badge-wrapper d-flex flex-wrap";
                    badgeContainer.appendChild(newBadgeRow);
                }

                alert("A new subject has been added!");
                closeAddModal();
            }
        },
        error: function (xhr, status, error) {
            // Handle the error
            console.log(error);
        }
    });
}

function deleteBadge(button) {

    const subject = button.getAttribute('data-subject');

    // Remove the entire parent container (the badge and the input field)
    button.parentNode.remove();

    // You can perform additional actions, such as deleting the subject from your data


}

function saveChanges() {
    const badgeInputs = document.querySelectorAll('.badge-input');
    const remainingValues = [];

    badgeInputs.forEach(function (input) {
        remainingValues.push(input.value);
    });

    // Create a string with "###" separator
    const remainingValuesString = remainingValues.join("###");

    // Send the remainingValuesString to your server for storage
    $.ajax({
        url: 'assets/php/process_saveSubjectChanges.php',
        method: 'POST',
        data: { remainingValues: remainingValuesString },
        success: function (response) {
            // Handle the response from the PHP script
            console.log(response);
        },
        error: function (xhr, status, error) {
            // Handle the error
            console.log(error);
        }
    });

    alert("Changes have been made!");
    // Reload the current page
    location.reload();
}


function resetApplicant(mt_ID) {
    if (confirm("Are you sure you want to reset this application?")) {
        $.ajax({
            url: 'assets/php/process_applicationReset.php',
            method: 'POST',
            data: {mt_ID: mt_ID},
            success: function (response) {
                // Handle the response from the PHP script
                console.log(response);
                alert("Application has been reset!");
                location.reload();
               
            },
            error: function (xhr, status, error) {
                // Handle the error
                console.log(error);
            }
        });
    }
}
