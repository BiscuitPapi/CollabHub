<!-- Start topbar header -->
<header class="topbar-nav">
    <nav class="navbar navbar-expand fixed-top">
        <ul class="navbar-nav mr-auto align-items-center">
            <li class="nav-item">
                <a class="nav-link toggle-menu" href="javascript:void();">
                    <i class="icon-menu menu-icon"></i>
                </a>
            </li>

            <!-- <li class="nav-item">
                <form class="search-bar">
                    <input type="text" class="form-control" placeholder="Enter keywords">
                    <a href="javascript:void();"><i class="icon-magnifier"></i></a>
                </form>
            </li> -->
        </ul>

        <ul class="navbar-nav align-items-center right-nav-link">
            <li class="nav-item dropdown-lg">
                <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown"
                    href="javascript:void();">
                    <i class="fa fa-envelope-open-o"></i></a>
            </li>
            <li class="nav-item language">
                <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown"
                    href="javascript:void();">
                    <i class="fa fa-bell-o position-relative" style="font-size: 24px;">
                        <!-- No span for notification count here -->
                    </i>
                </a>

                <ul id="notificationList" class="dropdown-menu dropdown-menu-right">
                    <!-- Notification items go here -->
                </ul>
            </li>
            
            <li class="nav-item">
                <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#">
                    <span class="user-profile">
                        <?php if ($_SESSION['picture'] === null): ?>
                            <div>
                                <img src="https://via.placeholder.com/110x110" alt="profile-image" class="img-circle" id = "smallProfilePicture_1">
                            </div>
                        <?php else: ?>
                            <div>
                                <img src="data:image/jpeg;base64,<?php echo $_SESSION['picture']; ?>" alt="Profile Image"
                                    class="img-circle" id = "smallProfilePicture_1">
                            </div>
                        <?php endif; ?>
                    </span>
                </a>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li class="dropdown-item user-details">
                        <a href="myProfile.php">
                            <div class="media">
                                <div class="avatar">
                                    <?php if ($_SESSION['picture'] === null): ?>
                                        <div>
                                            <img src="https://via.placeholder.com/110x110" alt="profile-image"
                                                class="align-self-start mr-3" id = "smallProfilePicture_2">
                                        </div>
                                    <?php else: ?>
                                        <div>
                                            <img src="data:image/jpeg;base64,<?php echo $_SESSION['picture']; ?>"
                                                alt="Profile Image" class="align-self-start mr-3" id = "smallProfilePicture_2">
                                        </div>
                                    <?php endif; ?>

                                </div>
                                <div class="media-body">
                                    <h6 class="mt-2 user-title">
                                        <?php echo $_SESSION["name"]; ?>
                                    </h6>
                                    <p class="user-subtitle">
                                        <?php echo $_SESSION["email"]; ?>
                                    </p>
                                </div>
                            </div>
                        </a>
                    </li>

                    <li class="dropdown-divider"></li>
                    <li class="dropdown-item"><i class="icon-envelope mr-2"></i> Inbox</li>
                    <li class="dropdown-divider"></li>
                    <li class="dropdown-item"><a href="myProfile.php"><i class="icon-wallet mr-2"></i> Account</li>
                    <li class="dropdown-divider"></li>
                    <li class="dropdown-item"><a href="editProfile.php"><i class="icon-settings mr-2"></i> Setting</a>
                    </li>

                    <li class="dropdown-divider"></li>
                    <a href="assets/php/logout.php">
                        <li class="dropdown-item">
                            <i class="icon-power mr-2"></i> Logout
                        </li>
                    </a>
                </ul>
            </li>
        </ul>
    </nav>
</header>
<!-- End topbar header -->