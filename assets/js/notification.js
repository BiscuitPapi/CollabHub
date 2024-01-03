// Function to create notification items with studyHub_ID data and associated details
function addNotificationWithStudyHubDetails(studyHubDetails) {
  const notificationList = document.getElementById("notificationList");

  const li = document.createElement("li");
  li.className = "dropdown-item";

  const row = document.createElement("div");
  row.className = "row";

  const col2 = document.createElement("div");
  col2.className = "col-2 d-flex align-items-center";

  const profileImg = document.createElement("span");
  profileImg.className = "user-profile";

  // Creating an anchor tag around the circular image
  const imgLink = document.createElement("a");
  imgLink.href = `SB_profile.php?studyhub_ID=${studyHubDetails.studyhub_ID}`; // Set the URL with studyhub_ID parameter

  const img = document.createElement("img");
  img.className = "img-circle"; // Apply a class for a circular shape (You may need to define this class in your CSS)
  img.style.width = "50px";
  img.style.height = "50px";
  if (studyHubDetails.profile_pic !== null) {
    img.src = `data:image/jpeg;base64, ${studyHubDetails.profile_pic}`;
  } else {
    img.src = "https://via.placeholder.com/110x110";
  }
  img.alt = "profile-image";

  imgLink.appendChild(img); // Add the image to the anchor tag
  col2.appendChild(imgLink); // Add the anchor tag to the column

  const col3 = document.createElement("div");
  col3.className = "col-3";
    col3.innerHTML = `You have been invited to StudyHub ${studyHubDetails.studyhub_name}<br>"
    <a href="javascript:void(0)" class="btn btn-success" onclick="approval(${studyHubDetails.studyhub_ID}, 'Accepted', '${studyHubDetails.invite_ID}')">Accept</a>
    <a href="javascript:void(0)" class="btn btn-danger" onclick="approval(${studyHubDetails.studyhub_ID}, 'Rejected', '${studyHubDetails.invite_ID}')">Reject</a>`;

    row.appendChild(col2);
    row.appendChild(col3);
    li.appendChild(row);

    notificationList.appendChild(li);
  
}

function displayNotifications(invite_ID) {
  fetch("assets/php/process_getInvitation.php")
    .then((response) => response.json()) // Assuming the PHP script returns JSON data
    .then((dataToUse) => {
      if (invite_ID) {
        const index = dataToUse.findIndex(
          (detail) => detail.invite_ID === invite_ID
        );
        if (index > -1) {
          dataToUse.splice(index, 1);
        }
      }

      const notificationList = document.getElementById("notificationList");
      notificationList.innerHTML = ""; // Clear previous content

      if (dataToUse.length === 0) {
        const existingSpan = document.getElementById("notificationCounter");
        if (existingSpan) {
          existingSpan.remove(); // Remove the existing span if it exists
        }

        const noInvitationMessage = document.createElement("li");
        noInvitationMessage.textContent = "No new invitations yet";
        noInvitationMessage.style.padding = "10px";
        notificationList.appendChild(noInvitationMessage);
      } else {
        const notificationCount = dataToUse.length;

        let newSpan = document.getElementById("notificationCounter");
        if (!newSpan) {
          newSpan = document.createElement("span");
          newSpan.className =
            "position-absolute top-0 end-0 badge rounded-circle bg-danger";
          newSpan.style.fontSize = "10px";
          newSpan.id = "notificationCounter";
        }

        newSpan.textContent = notificationCount;

        const bellIcon = document.querySelector(".fa-bell-o");
        bellIcon.appendChild(newSpan);

        dataToUse.forEach((studyHubDetail) => {
          addNotificationWithStudyHubDetails(studyHubDetail);
        });
      }
    })
    .catch((error) => console.error("Error:", error));
}

function approval(studyHub_ID, answer, invite_ID) {
  var answerText = answer.toLowerCase();
  if (answerText === "accept") {
    answerText = answerText.slice(0, -2);
  } else {
    answerText = answerText.slice(0, -2);
  }
  if (
    confirm("Are you sure you want to " + answerText + " this application?")
  ) {
    $.ajax({
      url: "assets/php/process_invitationResponse.php",
      method: "POST",
      data: { studyHub_ID: studyHub_ID, status: answer },
      success: function (response) {
        // Handle the response from the PHP script
        console.log(response);
        if (answer == "Rejected") alert("Invitation has been rejected!");
        else alert("Invitation has been accepted!");

        // Display updated notifications
        displayNotifications(invite_ID);
      },
      error: function (xhr, status, error) {
        // Handle the error
        console.log(error);
      },
    });
  }
}
