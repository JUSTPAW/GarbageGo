<?php 
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['user_name']) && isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
include('../includes/header.php');
include('../includes/navbar.php');
require '../db_conn.php';
?>
 
<!-- to not back when logout-->
<!-- <script type="text/javascript">
    window.history.forward();
    function noBack() {
        window.history.forward();
    }
</script> -->

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
                            var images = ["images/image1.jpg", "images/image2.jpg"];
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
                            <img src="images/gas.png" class="card-img-top img-fluid mx-auto d-block image-animated" alt="..." style="max-width: 100%; height: 40px;">
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
                            <img src="images/waste.png" class="card-img-top img-fluid mx-auto d-block image-animated" alt="..." style="max-width: 100%; height: 40px;">
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
                            <img src="images/map.png" class="card-img-top img-fluid mx-auto d-block image-animated" alt="..." style="max-width: 100%; height: 40px;">
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
                            <img src="images/time.png" class="card-img-top img-fluid mx-auto d-block image-animated" alt="..." style="max-width: 100%; height: 40px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<style>
@keyframes press {
  0% { transform: translate(0, 0) scale(1); }
  25% { transform: translate(-4px, 0) scale(0.70); }
  50% { transform: translate(4px, 0) scale(1.05); }
  75% { transform: translate(-2px, 0) scale(0.97); }
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