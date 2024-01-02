function editStudyHub(ID) {
  var studyHubName = $("#studyhub_name").val();
  var studyHubDescription = $("#studyhub_description").val();
  var studyHub_ID = ID;
  var selectedSetting = $("input[name='setting']:checked").val();

  $.ajax({
    url: "assets/php/process_editStudyHub.php",
    method: "POST",
    data: {
      studyHubName: studyHubName,
      studyHubDescription: studyHubDescription,
      studyHub_ID: studyHub_ID,
      selectedSetting: selectedSetting,
    },
    success: function (response) {
      // Handle the response from the PHP script
      if (response === "success") {
        alert("Information has been updated!");

        var h5Element = document.querySelector(".card-title");
        var pElement = document.querySelector(".card-text");

        // Update the text inside the <h5> element
        h5Element.textContent = studyHubName;
        pElement.textContent = studyHubDescription;
      } else {
        alert(response);
      }
    },
    error: function (xhr, status, error) {
      // Handle the error
      console.log(response);
    },
  });
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
    document.getElementById("addedSkills").value = "";
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
    var studyHub_ID = document.getElementById('dummyID').value;
    var type = "StudyHub";
    $.ajax({
        url: 'assets/php/process_sendInvitation.php',
        method: 'POST',
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
        }
    });
}
