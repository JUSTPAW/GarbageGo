<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['user_name']) && isset($_SESSION['role']) && $_SESSION['role'] == 'driver') {
    // Regenerate the session ID
    session_regenerate_id(true);

    // Include the necessary files and establish database connection
    include('../includes/header.php');
    include('../includes/navbar_driver.php');
    require '../db_conn.php';
    ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-1 mt-1">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0">
                    <li class="breadcrumb-item"><a href="admin_dashboard.php" class="text-secondary"
                            style="color: #026601; text-decoration: none;">Dashboard</a></li>
                    <li class="breadcrumb-item active text-gray-900" aria-current="page">Profile</li>
                </ol>
            </nav>
            <a href="" class="btn btn-sm btn-info shadow-sm mb-3"><i class="fas fa-download fa-sm text-white"></i>
                Generate Report</a>
        </div>

        <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin"
                                class="rounded-circle" width="150">
                            <div class="mt-3">
                                <h4>Kenneth B. Alvarez</h4>
                                <p class="text-secondary mb-1">CEO</p>
                                <p class="text-muted font-size-sm">Bay Area, San Francisco, CA</p>
                            </div>
                        </div>
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-md-6 offset-md-3">
                                    <div class="btn-group d-flex justify-content-between">
                                        <!-- Edit Profile Button -->
                                        <button class="btn btn-outline-primary" data-toggle="tooltip" data-placement="top" title="Change Profile Picture">
                                            <i class="fa fa-camera"></i>
                                        </button>

                                        <!-- Change Password Button -->
                                        <button class="btn btn-outline-secondary" data-toggle="tooltip" data-placement="top" title="Change Password">
                                            <i class="fa fa-key"></i>
                                        </button>

                                        <!-- Edit Info Button -->
                                        <button class="btn btn-outline-success" data-toggle="tooltip" data-placement="top" title="Edit Info">
                                            <i class="fa fa-edit"></i>
                                        </button>

                                        <!-- Delete Account Button -->
                                        <button class="btn btn-outline-danger" data-toggle="tooltip" data-placement="top" title="Delete Account">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
    <div class="card mb-3">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-3">
                    <h6 class="mb-0">Full Name</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    Kenneth B. Alvarez
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-3">
                    <h6 class="mb-0">Birthday</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    January 1, 1990
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-3">
                    <h6 class="mb-0">Age</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    33 years
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-3">
                    <h6 class="mb-0">Phone</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    (239) 816-9029
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-3">
                    <h6 class="mb-0">Email</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    fip@jukmuh.al
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-3">
                    <h6 class="mb-0">Address</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                    Bay Area, San Francisco, CA
                </div>
            </div>
        </div>
    </div>
</div>


        </div>

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <!-- End of Page Content -->
    <?php
    include('../includes/scripts.php');
    include('../includes/footer.php');
} else {
    header("Location: ../login.php");
    exit();
}
?>
