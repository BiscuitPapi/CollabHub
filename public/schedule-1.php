<script>
    // Retrieve the activeTab parameter from the URL
    const urlParams = new URLSearchParams(window.location.search);
    const activeTab = urlParams.get('activeTab');

    // Make the corresponding tab active
    if (activeTab) {
        $('#' + activeTab).show(); // Show the tab content
        $('#' + activeTab + '-tab').addClass('active'); // Add the 'active' class to the tab's link

        // Hide the "about" tab
        if (activeTab !== 'about') {
            $('#about').hide();
            $('#about-tab').removeClass('active'); // Remove the 'active' class from the about tab's link
        }
    }

    // Get the "Add Course" button by its id
    var addCourseButton = document.getElementById('addCourseButton');

    // Get the modal and the close button
    var modal = document.getElementById('modal');
    var closeButton = modal.getElementsByClassName('close')[0];

    // Open the modal
    function openModal() {
        modal.style.display = 'block';
    }

    // Close the modal
    function closeModal() {
        modal.style.display = 'none';
    }

    addCourseButton.addEventListener('click', openModal);

    closeButton.addEventListener('click', closeModal);

    // Close the modal if the user clicks outside of it
    window.addEventListener('click', function (event) {
        if (event.target == modal) {
            closeModal();
        }
    });

    function editCourseModal(button) {
        // Extract data from data attributes
        var scheduleId = button.getAttribute("data-schedule-id");
        var courseName = button.getAttribute("data-course-name");
        var day = button.getAttribute("data-day");
        var startTime = button.getAttribute("data-start-time");
        var endTime = button.getAttribute("data-end-time");
        document.getElementById("scheduleIdInput").value = scheduleId;
        // Populate the modal's input fields with the extracted data
        document.getElementById("input-5").value = courseName;
        document.getElementById("input-6").value = day;
        document.getElementById("input-7").value = startTime;
        document.getElementById("input-8").value = endTime;

        // Show the modal
        var modal = document.getElementById("modal_2");
        modal.style.display = "block";
        var closeButton = modal.getElementsByClassName('close')[0];
        closeButton.addEventListener('click', function () {
            modal.style.display = "none";
        });
    }

    function saveEditedCourse() {
        // Get the edited data from the modal form
        var editedCourseName = document.getElementById("input-5").value;
        var editedDay = document.getElementById("input-6").value;
        var editedStartTime = document.getElementById("input-7").value;
        var editedEndTime = document.getElementById("input-8").value;
        var scheduleID = document.getElementById("scheduleIdInput").value;

        // Create an object with the edited data
        var editedData = {
            editedCourseName: editedCourseName,
            editedDay: editedDay,
            editedStartTime: editedStartTime,
            editedEndTime: editedEndTime,
            scheduleID: scheduleID
        };

        // Send the edited data to the server using an AJAX request
        $.ajax({
            url: '../assets/php/profile/process_editCourseSchedule.php',
            method: 'POST',
            data: editedData,
            success: function (response) {
                // Handle the response from the server
                alert(response);
                window.location.href = 'editProfile.php?activeTab=schedule';
            },
            error: function (xhr, status, error) {
                // Handle any errors that may occur during the AJAX request
                console.log(error);
                alert("Error occurred while editing the course");
            }
        });
    }

    function addCourse() {
        event.preventDefault(); // Prevents the default form submission behavior

        var courseName = document.getElementById("input-1").value;
        var day = document.getElementById("input-2").value;
        var startTime = document.getElementById("input-3").value;
        var endTime = document.getElementById("input-4").value;


        $.ajax({
            url: '../assets/php/profile/process_addCourseSchedule.php',
            method: 'POST',
            data: { courseName: courseName, day: day, startTime: startTime, endTime: endTime },
            success: function (response) {
                alert(response);
                window.location.href = 'editProfile.php?activeTab=schedule';
            },
            error: function (xhr, status, error) {
                // Handle the error
                console.log(error);
            }
        });

    }

</script>