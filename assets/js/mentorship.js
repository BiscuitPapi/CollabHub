function togglePage(pageId) {
  // Hide all pages
  document.getElementById("pendingList").style.display = "none";
  document.getElementById("rejectedList").style.display = "none";

  // Show the selected page
  document.getElementById(pageId).style.display = "block";

  // Update button styles based on active page
  document.getElementById("pendingList-button").className =
    "btn " + (pageId === "pendingList" ? "btn-primary" : "btn-dark");
  document.getElementById("rejectedList-button").className =
    "btn " + (pageId === "rejectedList" ? "btn-primary" : "btn-dark");
}

function approvalMM(mt_ID, answer) {
  var answerText = answer.toLowerCase();
  if (answerText === "rejected") {
    answerText = answerText.slice(0, -2);
  } else {
    answerText = answerText.slice(0, -1);
  }
  if (
    confirm("Are you sure you want to " + answerText + " this application?")
  ) {
    $.ajax({
      url: "assets/php/process_applicationApproval.php",
      method: "POST",
      data: { mt_ID: mt_ID, status: answer },
      success: function (response) {
        // Handle the response from the PHP script
        console.log(response);
        if (answer == "Rejected") alert("Application has been rejected!");
        else alert("Application has been approved!");
      },
      error: function (xhr, status, error) {
        // Handle the error
        console.log(error);
      },
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
    url: "assets/php/cubaan.php",
    method: "POST",
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
    },
  });
}

function deleteBadge(button) {
  const subject = button.getAttribute("data-subject");

  // Remove the entire parent container (the badge and the input field)
  button.parentNode.remove();

  // You can perform additional actions, such as deleting the subject from your data
}

function saveChanges() {
  const badgeInputs = document.querySelectorAll(".badge-input");
  const remainingValues = [];

  badgeInputs.forEach(function (input) {
    remainingValues.push(input.value);
  });

  // Create a string with "###" separator
  const remainingValuesString = remainingValues.join("###");

  // Send the remainingValuesString to your server for storage
  $.ajax({
    url: "assets/php/process_saveSubjectChanges.php",
    method: "POST",
    data: { remainingValues: remainingValuesString },
    success: function (response) {
      // Handle the response from the PHP script
      console.log(response);
    },
    error: function (xhr, status, error) {
      // Handle the error
      console.log(error);
    },
  });

  alert("Changes have been made!");
  // Reload the current page
  location.reload();
}

function resetApplicant(mt_ID) {
  if (confirm("Are you sure you want to reset this application?")) {
    $.ajax({
      url: "assets/php/process_applicationReset.php",
      method: "POST",
      data: { mt_ID: mt_ID },
      success: function (response) {
        // Handle the response from the PHP script
        console.log(response);
        alert("Application has been reset!");
        location.reload();
      },
      error: function (xhr, status, error) {
        // Handle the error
        console.log(error);
      },
    });
  }
}

let addedSkillsArray = [];
function addSkills() {
  var skillValue = document.getElementById("myInput").value;
  if (skillValue.trim() !== "") {
    // Create a new badge element
    var newBadge = document.createElement("a");
    newBadge.textContent = skillValue;
    newBadge.classList.add("badge", "badge-dark", "badge-pill", "mr-2");
    newBadge.style.color = "white";

    // Find the container to append the new badge
    var badgeContainer = document.getElementById("badgeContainer");

    // Append the new badge to the container
    badgeContainer.appendChild(newBadge);
    // Push the skill into the array
    addedSkillsArray.push(skillValue);

    // Clear the input field after adding
    document.getElementById("myInput").value = "";
  }
}


function showModal() {
  var modal = document.getElementById("myCustomModal");
  modal.style.display = "block";

  // Set a timeout to hide the modal after 5 seconds
  setTimeout(function () {
    modal.style.display = "none";
  }, 5000); // 5000 milliseconds = 5 seconds
}

function getFinalArray() {
  console.log(addedSkillsArray);
  showModal();

  // Delay for 5 seconds
  setTimeout(function () {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "assets/php/algorithmicMatching.php");
    xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    xhr.send(JSON.stringify({ skillsArray: addedSkillsArray }));

    xhr.onload = function () {
      if (xhr.status === 200) {
        console.log("Array sent successfully!");

        try {
          var response = JSON.parse(xhr.responseText);
          console.log("Parsed JSON response: ", response);

          // Call a function to display the results on the page
          displayResults(response);

          var noSubjectsFound = document.getElementById("suggestionContent");
          noSubjectsFound.style.display = "block";
        } catch (error) {
          console.error("Error parsing JSON:", error);
          console.log("Response content:", xhr.responseText);
          // Handle the error or incorrect response here
        }
      } else {
        console.error("Error sending array");
        // Handle the error or incorrect response here
      }
    };
  }, 5000); // 5000 milliseconds = 5 seconds
}

function displayResults(data) {
  var contentContainer = document.getElementById("userDetails"); // Assuming 'userDetails' is the ID of the container div
  contentContainer.innerHTML = "";
  if (data && data.length > 0) {
    data.forEach(function (user) {
      var skillsList = user.matched_skills.join(", "); // Joined matched skills into a string
      var matchPercentage = user.match_percentage.toFixed(2); // Limiting to two decimal places

      var userContent = `
                                                          <hr>
              
  
                                                          <div class="row">
                                                              <div class ="row align-items-start">							
                                                                  <div class="col-lg-2">
                                                                      ${
                                                                        user.imageData !==
                                                                          null &&
                                                                        user.imageData !==
                                                                          ""
                                                                          ? `<img src="data:image/jpeg;base64, ${user.imageData}" width="110" height="110">`
                                                                          : `<img src="https://via.placeholder.com/110x110">`
                                                                      }
                              
                                                                  </div>
                                                              </div>
                                                              <div class="col-lg-4 align-items-center">
                                                                  <h6>Name</h6>
                                                                  <p>${
                                                                    user.name
                                                                  }</p>
                                                                  <hr>
                                                                  <h6>Email</h6>
                                                                  <p>${
                                                                    user.email
                                                                  }</p>
                                                              </div>
  
                                                              <div class="col-lg-4 align-items-center">
                                                                  <h6>Skills Matched</h6>
                                                                  <p>${skillsList}</p>
                                                                  <hr>
                                                                  <h6>Accuracy Percentage</h6>
                                                                  <p>${matchPercentage}%</p>
                                                              </div>
  
                                                              <div class="col-lg-2 d-flex align-items-center justify-content-center">
                                                                  <button class="btn btn-success" onclick="sendInvitation('${
                                                                    user.user_ID
                                                                  }')">
                                                                      Invite
                                                                  </button>
  
                                                              </div>
                                                          </div>
                                                      `;
      contentContainer.insertAdjacentHTML("beforeend", userContent);
    });
  } else {
    var noResultsContent = `
                                                          <p>No matching users found.</p>
                                                      `;
    contentContainer.innerHTML = noResultsContent;
  }
}
function sendInvitation(user_ID) {
  var studyHub_ID = "";
  var type = "Mentorship";
  $.ajax({
    url: "assets/php/process_sendInvitation.php",
    method: "POST",
    data: {
      user_ID: user_ID,
      studyHub_ID: studyHub_ID,
      type: type
    },
    success: function (response) {
      // Handle the response from the PHP script
      if (response === "success") {
        alert("Invitation has been sent!");
      } else {
        alert("Failed to send the invitation");
      }
    },
    error: function (xhr, status, error) {
      // Handle the error
      console.log(error);
    },
  });
}
