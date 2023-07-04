<?php
session_start();
// Check if the necessary session variables are set and the user role is 'admin'
if (isset($_SESSION['id']) && isset($_SESSION['user_name']) && isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {

  // Regenerate the session ID
  session_regenerate_id();

  // Include the necessary files and establish database connection
  include('../includes/header.php');
  include('../includes/navbar_admin.php');
  require '../db_conn.php';
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

<!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
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

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Waste Collection</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">10, 000 kilos</div>
                        </div>
                        <div class="col-auto">
                            <img src="../images/waste.png" class="card-img-top img-fluid mx-auto d-block image-animated" alt="..." style="max-width: 100%; height: 40px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Number of Trips
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

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Collection Time</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">09:37:50</div>
                        </div>
                        <div class="col-auto">
                            <img src="../images/time.png" class="card-img-top img-fluid mx-auto d-block image-animated" alt="..." style="max-width: 100%; height: 40px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- 
<div class="row">
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Dropdown Header:</div>
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="myAreaChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Revenue Sources</h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                        aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Dropdown Header:</div>
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="chart-pie pt-4 pb-2">
                    <canvas id="myPieChart"></canvas>
                </div>
                <div class="mt-4 text-center small">
                    <span class="mr-2">
                        <i class="fas fa-circle text-primary"></i> Direct
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-success"></i> Social
                    </span>
                    <span class="mr-2">
                        <i class="fas fa-circle text-info"></i> Referral
                    </span>
                </div>
            </div>
        </div>
    </div>
</div> -->


<style>
@keyframes press {
  0% { transform: translate(0, 0) scale(1); }
  25% { transform: translate(-4px, 0) scale(0.70); }
  50% { transform: translate(4px, 0) scale(1.05); }
  75% { transform: translate(-2px, </div>0) scale(0.97); }
  100% { transform: translate(0, 0) scale(1); }
}

.image-animated {
  animation: press 0.4s;
  animation-iteration-count: 1;
}
</style>

<!--     </div>
    /.container-fluid -->

</div>
<!-- End of Main Content -->

<?php 
} else {
    header("Location: ../login.php");
    exit();
}
?>
<?php
include('../includes/scripts.php');
include('../includes/footer.php');
?>