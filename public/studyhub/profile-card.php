<div class="card profile-card-2" style="min-height: 600px;">
    <div class="card-img-block">
        <?php
        if ($banner === null) {
            // Display a placeholder image if $studyhub_banner is null
            echo '
											<div class="card-img-block">
												<img class="img-fluid" src="https://via.placeholder.com/800x500" alt="Card image cap" id ="bannerPicture">
											</div>';
        } else {
            // Display the banner image if $studyhub_banner is not null
            echo '
   									 <img class="img-fluid banner" src="data:image/jpeg;base64,' . $banner . '" alt="Banner Image" id="bannerPicture">';
        }
        ?>

    </div>

    <!--Profile Card-->
    <div class="card-body pt-5">
        <?php

        if ($proPic === null) {
            // Display a placeholder image if $proPic is null
            echo '<img src="https://via.placeholder.com/110x110" alt="profile-image" class="rounded-circle profile" id ="profilePicture">';

        } else {
            // Display the profile image if $proPic is not null
            echo '<img src="data:image/jpeg;base64,' . $proPic . '" alt="profile-image" class="profile" id ="profilePicture">';
        }


        ?>

        <h5 class="card-title">
            <?php echo $_SESSION['studyhub_name']; ?>
        </h5>
        <p class="card-text">
            <?php echo $_SESSION['studyhub_description']; ?>
        </p>
    </div>

    <!--Start of Display Members-->
    <div class="card-body border-top border-light">
        <h5 class="mb-3">StudyHub Members</h5>
        <?php
        $sql2 = "SELECT u.name, u.picture
											FROM studyhubMember AS sm
											JOIN user AS u ON sm.user_ID = u.user_ID
											WHERE sm.studyhub_ID = '$studyhub_ID';";

        // Execute the query
        $result = mysqli_query($connection, $sql2);

        // check if the query returned any rows
        if (mysqli_num_rows($result) > 0) {
            $counter = 0; // Counter to keep track of the number of displayed members
        
            while ($studyhub_member = mysqli_fetch_assoc($result)) {
                $name = $studyhub_member['name'];
                $user_picture = $studyhub_member['picture'] ? base64_encode($studyhub_member['picture']) : null;
                // Display only up to 4 members
                if ($counter < 4) {
                    ?>
                    <div class="media align-items-center">
                        <div class="rounded-circle" style="width: 50px; height: 50px; overflow: hidden;">
                            <?php if ($user_picture === null): ?>
                                <img src="https://via.placeholder.com/110x110" alt="profile-image"
																	class="rounded-circle" style="width: 100%; height: auto;"
																	alt="User Picture">
                            <?php else: ?>
                                <img src="data:image/jpeg;base64,<?php echo $user_picture; ?>" class="rounded-circle"
                                    style="width: 100%; height: auto;" alt="User Picture">
                            <?php endif; ?>
                        
                        </div>

                        <div class="media-body text-left ml-3">
                            <div class="wrapper">
                                <p style="font-size: 20px;">
                                    <?php echo $name; ?>
                                </p> <!-- Adjust the font-size as needed -->
                            </div>
                        </div>
                    </div>
                    <hr>
                    <?php
                    $counter++;
                }
            }

            // If no members were displayed, show a message
            if ($counter === 0) {
                echo "No members found.";
            }
        } else {
            echo "No members found.";
        }
        ?>
    </div>
    <!--End of Display Members-->

</div>