<!-- admin-header.php -->

<nav class="navbar navbar-expand-lg navbar-light" style="background-color:#1DD1A1;">
    <div class="container pl-0 ml-3">
        <!-- Brand -->
        <a class="navbar-brand" href="#" style="max-width: 200px;"><img src="System Logo Patient.png" width="120px" height="44px;"></a>

        <!-- Toggler/collapsible Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Navigation Links -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item" style="color: white;">
                    <a class="nav-link"  href="patientdashboard.php">Home</a>
                </li>
                <li class="nav-item" style="color: white;">
                    <a class="nav-link" href="patientvaccination.php">Vaccination</a>
                </li>
                <li class="nav-item" style="color: white;">
                    <a class="nav-link" href="patient-appointments.php" style="white-space:nowrap;">Schedule Dates</a>
                </li>
            </ul>
        </div>

        <!-- Profile Dropdown -->
        <div class="ml-auto">
            <div class="profile-container" style="background-color:#1BB58D;"id="profileDropdown">
                <img src="../img/img-navbar/navbar-profile.png" class="profile-icon" alt="Description of the image">
                <div class="profile-text-container" >
                    <span class="profile-text">   <?php echo $firstName . ' ' . $lastName; ?></span>
                    <span class="profile-role" style="color: white;">Patient</span>
                </div>
                <div class="dropdown-menu dropdown-content "id="dropdownContent" style="top: -70px;">
                    <a class="dropdown-item" href="patient-profile.php">Profile</a>
                    <a class="dropdown-item" href="patient-settings.php">Settings</a>
                    <a href="patient-backend/patient-logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>
</nav>

<style>
    @media (max-width: 991px) {
        .navbar-collapse {
            background-color: rgba(255, 255, 255, 0.9) !important;
            z-index: 1000;
        }
    }
</style>
