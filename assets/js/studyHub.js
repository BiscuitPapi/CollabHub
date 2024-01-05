function joinSB(studyhub_ID) {
  if (confirm("Are you sure you want to join this StudyHub?")) {
    $.ajax({
      url: 'assets/php/process_joinStudyHub.php',
      method: 'POST',
      data: { studyhub_ID: studyhub_ID },
      success: function (response) {
        // Handle the response from the PHP script
        console.log(response);
        if (response === "success") {
          alert("You have successfully joined the StudyHub!");
        }
        // Reload the page
        location.reload();
      },
      error: function (xhr, status, error) {
        // Handle the error
        console.log(error);
      }
    });

  }
}

function togglePage(pageId) {
  // Hide all pages
  document.getElementById('list_1').style.display = 'none';
  document.getElementById('list_2').style.display = 'none';

  // Show the selected page
  document.getElementById(pageId).style.display = 'block';

  // Update button styles based on active page
  document.getElementById('list_1Button').className = 'btn ' + (pageId === 'list_1' ? 'btn-primary' : 'btn-dark');
  document.getElementById('list_2Button').className = 'btn ' + (pageId === 'list_2' ? 'btn-primary' : 'btn-dark');
}


$(document).ready(function () {
  function loadTables(page) {
    // Fetch data for the first table
    $.ajax({
      url: 'assets/php/process_fetchSB.php?page=' + page,
      type: 'GET',
      dataType: 'json',
      success: function (data) {
        console.log(data);
        var tableBody = $('#yourTableBody'); // Update with your actual table body ID
        tableBody.empty(); // Clear existing rows

        for (var i = 0; i < data.length; i++) {
          var row = data[i];
          var isMember = row['is_member'];

          // Hide the Apply button if the user is already a member
          var applyButtonHtml = isMember ? '' : '<a onclick="joinSB(' + row['studyhub_ID'] + ')" class="btn btn-success">Join</a>';
          var tempP = row['tempPicture'];
          console.log(tempP);
          if (tempP != null) {
            var html = '<tr>' +
              '<th scope="row">' + (i + 1) + '</th>' +
              '<td><img src="data:image/jpeg;base64,' + tempP + '" alt="profile-image" class="align-self-start mr-3 rounded-circle" id="smallProfilePicture_2" style="width: 50px; height: 50px;"></td>' +
              '<td>' + row['studyhub_name'] + '</td>' +
              '<td style="text-align: center;">' + row['creator_name'] + '</td>' +
              '<td style="text-align: center;">' +
              row['member_count'] + // Display the member count
              '</td>' +
              '<td style="text-align: center;">' +
              '<a href="viewStudyHub.php?studyhub_ID=' + row['studyhub_ID'] + '" class="btn btn-success">View</a> ' +
              applyButtonHtml +
              '</td>' +
              '</tr>';
            tableBody.append(html);
          }
          else{
            var html = '<tr>' +
            '<th scope="row">' + (i + 1) + '</th>' +
            '<td><img src="https://via.placeholder.com/110x110" alt="profile-image" class="align-self-start mr-3 rounded-circle" id="smallProfilePicture_2" style="width: 50px; height: 50px;"></td>' +
            '<td>' + row['studyhub_name'] + '</td>' +
            '<td style="text-align: center;">' + row['creator_name'] + '</td>' +
            '<td style="text-align: center;">' +
            row['member_count'] + // Display the member count
            '</td>' +
            '<td style="text-align: center;">' +
            '<a href="viewStudyHub.php?studyhub_ID=' + row['studyhub_ID'] + '" class="btn btn-success">View</a> ' +
            applyButtonHtml +
            '</td>' +
            '</tr>';
          tableBody.append(html);

          }

        

      
        }
      }
    });



    // Fetch data for the second table
    $.ajax({
      url: 'assets/php/process_fetchOA.php?page=' + page,
      type: 'GET',
      dataType: 'json',
      success: function (data) {
        console.log(data); // Display the fetched data in the console

        var tableBody2 = $('#yourTableBody2'); // Update with your actual second table body ID
        tableBody2.empty(); // Clear existing rows

        for (var i = 0; i < data.length; i++) {
          var row = data[i];
          var html = '<tr>' +
            '<th scope="row">' + (i + 1) + '</th>' +
            '<td>' + row['club_name'] + '</td>' +
            '<td>' + row['position_available'] + '</td>' +
            '<td>' +
            '<a href="club_application_view.php?application_ID=' + row['club_id'] + '" class="btn btn-success">View</a>' +
            '</td>' +
            // Add other table columns as needed
            '</tr>';

          tableBody2.append(html);
        }
      },
      error: function (xhr, status, error) {
        console.error(xhr.responseText); // Log any error response to the console
      }
    });




  }

  // Initial table load
  $(document).ready(function () {
    loadTables(1);

    // Handle pagination clicks
    $(document).on('click', '.pagination a', function (e) {
      e.preventDefault();
      var page = $(this).text();
      loadTables(page);
    });
  });


});

