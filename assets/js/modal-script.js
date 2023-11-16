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
window.addEventListener("click", function(event) {
    if (event.target === addModal) {
        closeAddModal();
    }
});

// Prevent clicks inside the add modal content from closing the modal
addModalContent.addEventListener("click", function(event) {
    event.stopPropagation();
});

// Open the delete modal when the "Delete" span is clicked
deleteSpan.addEventListener("click", showDeleteModal);

// Close the delete modal when the close button is clicked
deleteModalCloseButton.addEventListener("click", closeDeleteModal);

// Close the delete modal if the background is clicked
window.addEventListener("click", function(event) {
    if (event.target === deleteModal) {
        closeDeleteModal();
    }
});

// Prevent clicks inside the delete modal content from closing the modal
deleteModalContent.addEventListener("click", function(event) {
    event.stopPropagation();
});



function addNewSubject() {
					
    var addedSubjectInput = document.getElementById("addedSubject");
    var addedSubject = addedSubjectInput.value;
    
    // Check if the input name is empty
    if (addedSubject.trim() === "") {
        alert("Please enter a name for the badge.");
        return; // Stop further execution
    }
 
}			
