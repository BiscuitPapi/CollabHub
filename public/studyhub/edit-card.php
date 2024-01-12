<div class="card" style="min-height: 600px;">
    <div class="card-body">
        <ul class="nav nav-tabs nav-tabs-primary top-icon nav-justified">
            <li class="nav-item">
                <a href="javascript:void();" data-target="#studysession" data-toggle="pill" class="nav-link active"><i
                        class="icon-user"></i> <span class="hidden-xs">Study Session</span></a>
            </li>
            <li class="nav-item" <?php echo $style; ?>>
                <a href="javascript:void();" data-target="#edit" data-toggle="pill" class="nav-link"><i
                        class="icon-note"></i> <span class="hidden-xs">Edit</span></a>
            </li>
            <li class="nav-item" <?php echo $style; ?>>
                <a href="javascript:void();" data-target="#sug" data-toggle="pill" class="nav-link"><i
                        class="icon-note"></i> <span class="hidden-xs">Invite</span></a>
            </li>
        </ul>


        <div class="tab-content p-3">
            <!--Start of First Tab-->
            <div class="tab-pane active" id="studysession">

                <!--Today Study Session-->
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="mt-2 mb-3"><span class=""></span> Today</h5>
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <tbody>
                                    <?php
                                    include("../assets/php/connection.php");

                                    //$query = "SELECT * FROM `study_session` WHERE studyhub_ID = '$studyhub_ID';";
                                    $query = "SELECT s.*, sm.studysession_id AS member_studysession_id
																FROM `study_session` s
																LEFT JOIN `studysession_member` sm ON s.studysession_id = sm.studysession_id AND sm.user_ID = '$user_ID'
																WHERE s.studyhub_ID = '$studyhub_ID';";


                                    $result = mysqli_query($connection, $query);

                                    $count = 1; // Initialize count variable
                                    $hasRows = false; // Initialize $hasRows to false
                                    


                                    // Check if there are no studysessions or no rows found
                                    if (mysqli_num_rows($result) == 0) {
                                        //echo '<tr><td colspan="4">No study session found.</td></tr>';
                                    
                                    } else {
                                        while ($row = mysqli_fetch_assoc($result)) {

                                            // Convert the retrieved date to a timestamp
                                            $sessionDate = strtotime($row['studysession_date']);

                                            if (date("Y-m-d", $sessionDate) == date("Y-m-d")) {

                                                // id in study_session
                                                $studysession_id = $row['studysession_id'];

                                                // id in studysession_member
                                                $member_studysession_id = $row['member_studysession_id'];

                                                // Check if the 'studysession_id' is not null, indicating that the user has joined the session
                                                $userHasJoined = !is_null($row['member_studysession_id']);

                                                // Determine the button label based on the user's status
                                                $buttonLabel = $userHasJoined ? 'View' : 'Join';

                                                echo '
																				<tr>
																					<th scope="row">' . $count . '</th>
																					<td>' . $row['studysession_name'] . '</td>
																					<td>' . $row['studysession_date'] . '</td>
																					<td><a href="' . ($userHasJoined ? 'view-session.php' : 'assets/php/process_joinStudySession.php') . '?studysession_id=' . $studysession_id . '" class="btn ' . ($userHasJoined ? 'btn-info' : 'btn-success') . '">' . $buttonLabel . '</a></td>
																				</tr>
																			';
                                                $hasRows = true;


                                                $count++; // Increment count for each row
                                            }


                                        }
                                    }

                                    // Check if no rows are echoed
                                    if (!$hasRows) {
                                        echo '<tr><td colspan="4">No session for today.</td></tr>';
                                    }

                                    // Close the database connection
                                    mysqli_close($connection);
                                    ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
                <!--End of Today Session-->
                <br>
                <!--Start of Next Session-->
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="mt-2 mb-3"><span class="fa fa-clock-o ion-clock float-right"></span> Up coming
                        </h5>
                        <div class="table-responsive">
                            <table class="table table-hover table-striped">
                                <tbody>
                                    <?php
                                    include("../assets/php/connection.php");


                                    $query = "SELECT s.*, sm.studysession_id AS member_studysession_id
																FROM `study_session` s
																LEFT JOIN `studysession_member` sm ON s.studysession_id = sm.studysession_id AND sm.user_ID = '$user_ID'
																WHERE s.studyhub_ID = '$studyhub_ID';";

                                    $result = mysqli_query($connection, $query);

                                    $count = 1; // Initialize count variable
                                    
                                    // Check if there are no mentees or no rows found
                                    if (mysqli_num_rows($result) == 0) {
                                        echo '<tr><td colspan="4">No study session found.</td></tr>';
                                    } else {
                                        while ($row = mysqli_fetch_assoc($result)) {

                                            // Convert the retrieved date to a timestamp
                                            $sessionDate = strtotime($row['studysession_date']);

                                            if (date("Y-m-d", $sessionDate) > date("Y-m-d") && date("Y-m-d", $sessionDate) != date("Y-m-d")) {

                                                // id in study_session
                                                $studysession_id = $row['studysession_id'];

                                                // id in studysession_member
                                                $member_studysession_id = $row['member_studysession_id'];

                                                // Check if the 'studysession_id' is not null, indicating that the user has joined the session
                                                $userHasJoined = !is_null($row['member_studysession_id']);

                                                // Determine the button label based on the user's status
                                                $buttonLabel = $userHasJoined ? 'View' : 'Join';

                                                echo '
																				<tr>
																					<th scope="row">' . $count . '</th>
																					<td>' . $row['studysession_name'] . '</td>
																					<td>' . $row['studysession_date'] . '</td>
																					<td>  <a href="' . ($userHasJoined ? 'view-session.php' : 'assets/php/process_joinStudySession.php') . '?studysession_id=' . $studysession_id . '" class="btn ' . ($userHasJoined ? 'btn-info' : 'btn-success') . '">' . $buttonLabel . '</a>
																					</td>
																				</tr>
																			';
                                                $count++; // Increment count for each row
                                            }

                                        }
                                    }

                                    // Close the database connection
                                    mysqli_close($connection);
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!--End of Next Session-->
                <p></p>
                <!--Start of Create study session button-->

                <!-- <div class=row>
                    <div class="col-md-12">

                        <center><a class="btn btn-primary"
                                href="create-studysession.php?studyhub_ID=<?php echo $studyhub_ID; ?>">Create
                                Session</a></center>
                    </div>
                </div> -->

                <?php

                include("../assets/php/connection.php");

                $query = "SELECT * FROM studyhubMember WHERE studyhub_ID = $studyhub_ID AND user_ID = $user_ID";
                $result = mysqli_query($connection, $query);

                // Check if a matching record is found
                if ($result && mysqli_num_rows($result) > 0) {
                    // User is a member, display the "Create Session" button
                    echo '<div class="row">
                            <div class="col-md-12">
                                <center><a class="btn btn-primary" href="create-studysession.php?studyhub_ID=' . $studyhub_ID . '">Create Session</a></center>
                            </div>
                        </div>';
                }

                // Close the database connection if open
                mysqli_close($connection);
                ?>

            </div>
            <!--End of First Tab-->

            <!--Start of First Tab-->
            <div class="tab-pane" id="edit">
                <form>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label form-control-label">Study Hub
                            Name</label>
                        <div class="col-lg-9">
                            <input class="form-control" type="text" id="studyhub_name" name="studyhub_name"
                                value="<?php echo $_SESSION['studyhub_name']; ?>" <?php if ($_SESSION['user_ID'] != $user_ID)
                                       echo 'readonly'; ?>>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label form-control-label">Description</label>
                        <div class="col-lg-9">
                            <input class="form-control" type="text" id="studyhub_description"
                                name="studyhub_description" value="<?php echo $_SESSION['studyhub_description']; ?>"
                                <?php if ($_SESSION['user_ID'] != $user_ID)
                                    echo 'readonly'; ?>>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label form-control-label">Settings</label>
                        <br>
                        <div class="col-lg-9">
                            <input type="radio" id="openStudyHub" name="setting" value="Open StudyHub" <?php echo (strcasecmp($_SESSION['setting'], 'Open StudyHub') === 0) ? 'checked' : ''; ?>>
                            <label for="openStudyHub">Open StudyHub</label>

                            <input type="radio" id="closeStudyHub" name="setting" value="Close StudyHub" <?php echo (strcasecmp($_SESSION['setting'], 'Close StudyHub') === 0) ? 'checked' : ''; ?>>
                            <label for="closeStudyHub">Close StudyHub</label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label form-control-label">Change
                            profile</label>
                        <div class="col-lg-9">
                            <form id="profilePictureForm" enctype="multipart/form-data"
                                action="assets/php/process_editProfilePicture.php" method="post">
                                <input type="file" name="profile_picture" id="profile_picture" style="display: none">
                                <button type="button" id="chooseProfileFileButton" class="btn btn-primary">Choose
                                    Profile Picture</button>
                                <input type="button" id="cropAndUploadProfile" class="btn btn-success"
                                    value="Crop and Upload" style="display: none">
                            </form>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label form-control-label">Change
                            background</label>
                        <div class="col-lg-9">
                            <form id="bannerForm" enctype="multipart/form-data"
                                action="assets/php/process_editBanner.php" method="post">
                                <input type="file" name="banner_picture" id="banner_picture" style="display: none">
                                <button type="button" id="chooseBannerFileButton" class="btn btn-primary">Choose
                                    Banner</button>
                                <input type="button" id="cropAndUploadBanner" class="btn btn-success"
                                    value="Crop and Upload" style="display: none">
                            </form>
                        </div>
                    </div>
                </form>

                <!-- Edit button - only available for application creator-->
                <?php
                if ($_SESSION['user_ID'] == $user_ID) {
                    echo '<div style="display: flex; justify-content: center">';
                    echo '<button class="btn btn-secondary" onclick="editStudyHub(' . $studyhub_ID . ')"><i class="fa fa-icon-class"></i> Save Changes</button>';
                    echo '<a href="assets/php/delete_studyhub.php?studyhub_ID=' . $studyhub_ID . '" class="btn btn-danger" style="margin-left: 10px">Delete</a>';
                    echo '</div>';
                }
                ?>

            </div>



            <?php include_once('studyhub/suggest-card.php'); ?>
            <!--End of First Tab-->
        </div>

    </div>
</div>
<div class="crop-container">

    <!-- Crop Modal for Profile Picture -->
    <div class="modal fade" id="profileCropModal" tabindex="-1" role="dialog" aria-labelledby="profileCropModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content"
                style="background: linear-gradient(45deg, #29323c, #485563); margin: 10% auto; padding: 20px; width: 500px; max-height: 70vh; overflow-y: auto; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2); position: relative; color: #000;">
                <div class="modal-header">
                    <h5 class="modal-title" id="profileCropModalLabel">Crop Profile Picture</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center d-flex justify-content-center align-items-center">
                    <canvas id="profileCroppedCanvas" width="110" height="110"></canvas>
                    <div class="cropper-container cropper-bg" touch-action="none" style="width:300px; height:100px;">
                    
                    </div>

                </div>

                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="confirmProfileCrop">Confirm
                        Crop</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Crop Modal for Banner -->
    <div class="modal fade" id="bannerCropModal" tabindex="-1" role="dialog" aria-labelledby="bannerCropModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content"
                style="background: linear-gradient(45deg, #29323c, #485563); margin: 10% auto; padding: 20px; width: 500px; max-height: 70vh; overflow-y: auto; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2); position: relative; color: #000;">
                <div class="modal-header">
                    <h5 class="modal-title" id="bannerCropModalLabel">Crop Banner</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center d-flex justify-content-center align-items-center">
                    <canvas id="bannerCroppedCanvas" width="800" height="500"></canvas>
                </div>

                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="confirmBannerCrop">Confirm
                        Crop</button>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    var profileCropper;
    var bannerCropper;

    $('#chooseProfileFileButton').click(function () {
        $('#profile_picture').click();
    });

    $('#chooseBannerFileButton').click(function () {
        $('#banner_picture').click();
    });

    $('#profile_picture').change(function () {
        var input = this;
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                if (profileCropper) {
                    profileCropper.replace(e.target.result);
                } else {
                    profileCropper = new Cropper(document.getElementById('profileCroppedCanvas'), {
                        aspectRatio: 1,
                        viewMode: 2,
                    });

                    profileCropper.replace(e.target.result);
                }
                $('#profileCropModal').modal('show');
            };
            reader.readAsDataURL(input.files[0]);
        }
    });

    $('#banner_picture').change(function () {
        var input = this;
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                if (bannerCropper) {
                    bannerCropper.replace(e.target.result);
                } else {
                    bannerCropper = new Cropper(document.getElementById('bannerCroppedCanvas'), {
                        aspectRatio: 16 / 9, // Set your desired aspect ratio for the banner image
                        viewMode: 2,
                    });

                    bannerCropper.replace(e.target.result);
                }
                $('#bannerCropModal').modal('show');
            };
            reader.readAsDataURL(input.files[0]);
        }
    });

    $('#confirmProfileCrop').click(function () {
        if (profileCropper) {
            var canvas = profileCropper.getCroppedCanvas({ width: 110, height: 110 });
            var studyHub_ID = <?php echo $studyhub_ID; ?>;
            if (canvas) {
                canvas.toBlob(function (blob) {
                    var formData = new FormData();
                    formData.append('profile_picture', blob);
                    formData.append('studyHub_ID', studyHub_ID);
                    $.ajax({
                        url: '../assets/php/studyhub/process_editSB-Profile.php',
                        method: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (response) {
                            if (response.imageData) {
                                alert("Your profile picture is updated!");
                                var newImageData = response.imageData;

                                // Find the <img> element with the id 'profilePicture'
                                var imgElement = document.getElementById('profilePicture');

                                // Update the 'src' attribute of the <img> element with the new image data
                                imgElement.src = "data:image/jpeg;base64," + newImageData;

                                $('#profileCropModal').modal('hide');
                            } else {
                                // Handle the case where imageData is empty or null (e.g., show an error message)
                                alert("Image data is empty or null. Failed to update image.");
                            }
                        }
                    });
                });
            }
        }
    });

    $('#confirmBannerCrop').click(function () {
        if (bannerCropper) {
            var studyHub_ID = <?php echo $studyhub_ID; ?>;
            var canvas = bannerCropper.getCroppedCanvas({ width: 800, height: 500 }); // Set your desired dimensions for the banner image
            if (canvas) {
                canvas.toBlob(function (blob) {
                    var formData = new FormData();
                    formData.append('banner_picture', blob);
                    formData.append('studyHub_ID', studyHub_ID); // Fetch and append studyHub_ID
                    $.ajax({
                        url: '../assets/php/studyhub/process_editSB-Banner.php',
                        method: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (response) {
                            if (response.imageData) {
                                alert("Your banner picture is updated!");
                                var newImageData = response.imageData;

                                // Find the <img> element with the id 'bannerPicture'
                                var imgElement = document.getElementById('bannerPicture');

                                // Update the 'src' attribute of the <img> element with the new image data
                                imgElement.src = "data:image/jpeg;base64," + newImageData;

                                $('#bannerCropModal').modal('hide');
                            } else {
                                // Handle the case where imageData is empty or null (e.g., show an error message)
                                alert("Image data is empty or null. Failed to update image.");
                            }
                        },
                        error: function (xhr, status, error) {
                            console.log(error);
                        }
                    });

                });
            }
        }
    });



    $('#profileCropModal, #bannerCropModal').on('hidden.bs.modal', function () {
        $('#profile_picture, #banner_picture').val('');
        if (profileCropper) {
            profileCropper.destroy();
        }
        if (bannerCropper) {
            bannerCropper.destroy();
        }
    });
</script>