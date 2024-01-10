<!--Start sidebar-wrapper-->
<div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
    <div class="brand-logo">
        <a href="dash.php">
            <img src="../assets/images/collabHub-icon.png" class="logo-icon" alt="logo icon">
            <h5 class="logo-text">CollabHub</h5>
        </a>
    </div>

    <ul class="sidebar-menu do-nicescrol">
        <li class="sidebar-header">MAIN NAVIGATION</li>
        <li>
            <a href="dash.php">
                <i class="zmdi zmdi-view-dashboard"></i> <span>Dashboard</span>
            </a>
        </li>

        <li>
            <a href="myApplication.php">
                <i class="zmdi zmdi-format-list-bulleted"></i> <span>Open Application</span>
            </a>
        </li>

        <li>
            <a href="myStudyHub.php">
                <i class="zmdi zmdi-grid"></i> <span>StudyHub</span>
            </a>
        </li>

        <li>
            <a href="<?php
                // Check if the status is set in the session
                if (isset($_SESSION["mentorshipStatus"])) {
                    // Get the status value
                    $status = $_SESSION["mentorshipStatus"];
                    
                    // Generate the dynamic anchor link
                    $link = "mentorship_" . strtolower($status) . ".php";
                    
                    // Output the link
                    echo $link;
                } else {
                    // Fallback link if the status is not set
                    echo "mentorship.php"; // You can change this to the default link
                }
            ?>">
                <i class="zmdi zmdi-male-female"></i> <span>Mentor Mentee</span>
                <small class="badge float-right badge-light">New</small>
            </a>
        </li>

        <li>
            <a href="peerReview.php">
                <i class="zmdi zmdi-mood-bad"></i> <span>Peer Review</span>
                <small class="badge float-right badge-light">New</small>
            </a>
        </li>
    </ul>
</div>
<!--End sidebar-wrapper-->
