<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['user_name']) && isset($_SESSION['role']) && $_SESSION['role'] == 'staff') {

include('../includes/header.php');
include('../includes/navbar_staff.php');
require '../db_conn.php';

// Check if the user is logged in as staff
if ($_SESSION['role'] !== 'staff') {
    // Redirect to the login page with an error message
    header("Location: ../login.php?error=Invalid access!");
    exit();
}

// Display the SweetAlert2 success message if available
if (isset($_GET['success'])) {
    $successMessage = $_GET['success'];
    echo '<script>
        window.onload = function() {
            Swal.fire({
                icon: "success",
                title: "Successful Login",
                text: "' . $successMessage . '",
                confirmButtonColor: "#3085d6",
                confirmButtonText: "OK"
            });
        };
    </script>';
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row mb-4">
        <div class="col-xl-12 col-md-12">
            <div class="card shadow py-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <img id="slideshow" class="card-img-top img-fluid mx-auto d-none d-md-block" alt="..." style="max-width: 50%; height: 100px;">
                            <script>
                                var images = ["../images/image1.jpg", "../images/image2.jpg"];
                                var currentIndex = 0;
                                var slideshowElement = document.getElementById("slideshow");

                                function startSlideshow() {
                                    changeImage(); // Change the image immediately
                                    setInterval(changeImage, 5000); // Change image every 3 seconds
                                }

                                function changeImage() {
                                    slideshowElement.src = images[currentIndex];
                                    currentIndex = (currentIndex + 1) % images.length;
                                }

                                startSlideshow(); // Start the slideshow
                            </script>
                        </div>
                        <div class="col-xl-9 col-md-6">
                            <h6 class="h6 text-gray-800 mb-1">
                                <script>
                                    var date = new Date();
                                    var hour = date.getHours();
                                    var greeting;

                                    if (hour < 12) {
                                        greeting = "Good Morning";
                                    } else if (hour < 18) {
                                        greeting = "Good Afternoon";
                                    } else {
                                        greeting = "Good Evening";
                                    }

                                    document.write(greeting);
                                </script>
                            </h6>
                            <h6 class="h4 text-info font-weight-bold mb-3">
                                John Paulo Bascuguin,
                            </h6>
                            <h6 class="small text-gray-800">
                                At MENRO LIAN, we preserve beauty and create a greener future. Join us in environmental conservation. Together, towards a harmonious world.
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="h5 mb-0 text-gray-800">
            <i class="fa fa-tachometer-alt fa-1x text-gray-600 mr-1"></i>
            Dashboard
        </h1>
        <div>
            <input type="date" class="form-control">
        </div>
    </div>

        <div class="row">
            <div class="col-md-9">

                <!-- Content Row -->
                <div class="row">
                    <!-- Total Drivers -->
                    <div class="col-xl-4 col-md-4 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                            Total Drivers</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">10</div>
                                    </div>
                                    <div class="col-auto">
                                        <img src="../images/drivers.png" class="card-img-top img-fluid mx-auto d-block image-animated" alt="..." style="max-width: 100%; height: 40px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Crew Members -->
                    <div class="col-xl-4 col-md-4 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                            Total Crew Members</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">25</div>
                                    </div>
                                    <div class="col-auto">
                                        <img src="../images/collector.png" class="card-img-top img-fluid mx-auto d-block image-animated" alt="..." style="max-width: 100%; height: 40px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Garbage Trucks -->
                    <div class="col-xl-4 col-md-4 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                            Total Garbage Trucks
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">10</div>
                                    </div>
                                    <div class="col-auto">
                                        <img src="../images/truck.png" class="card-img-top img-fluid mx-auto d-block image-animated" alt="..." style="max-width: 100%; height: 40px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>


                <!-- Content Row -->
                <div class="row">
                    <!-- Gas Consumption -->
                    <div class="col-xl-4 col-md-4 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                            Gas Consumption</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">50 liters</div>
                                    </div>
                                    <div class="col-auto">
                                        <img src="../images/gas.png" class="card-img-top img-fluid mx-auto d-block image-animated" alt="..." style="max-width: 100%; height: 40px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Waste Collected -->
                    <div class="col-xl-4 col-md-4 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                            Waste Collected</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">10,000 kilos</div>
                                    </div>
                                    <div class="col-auto">
                                        <img src="../images/waste.png" class="card-img-top img-fluid mx-auto d-block image-animated" alt="..." style="max-width: 100%; height: 40px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total of Trips -->
                    <div class="col-xl-4 col-md-4 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                            Total of Trips
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">10 trips</div>
                                    </div>
                                    <div class="col-auto">
                                        <img src="../images/map.png" class="card-img-top img-fluid mx-auto d-block image-animated" alt="..." style="max-width: 100%; height: 40px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <div class="col-md-3">
                <div class="card shadow">
                    <div class="card-header small text-center text-info py-2">
                        Waste Collection Schedule
                    </div>
                    <div class="card-body small py-3">
                        <p class="card-text">Monday: 9 AM - 11 AM</p>
                        <p class="card-text">Tuesday: 2 PM - 4 PM</p>
                        <p class="card-text">Wednesday: No collection</p>
                        <p class="card-text">Thursday: 9 AM - 12 PM</p>
                        <p class="card-text">Friday: 1 PM - 3 PM</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<?php
// Include the necessary files and establish database connection
include('../includes/footer.php');
include('../includes/scripts.php');
} else {
header("Location: ../login.php");
exit();
}
?>
