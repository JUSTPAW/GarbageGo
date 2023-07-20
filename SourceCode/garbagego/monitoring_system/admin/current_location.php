<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['user_name']) && isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
    include('../includes/header.php');
    include('../includes/navbar_admin.php');
    require '../db_conn.php';

    // Retrieve the latest location data for driver ID 3
    $sql = "SELECT locationName, latitude, longitude FROM current_location WHERE driver_id = 3 ORDER BY datetime DESC LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $locationName = $row['locationName'];
    $latitude = $row['latitude'];
    $longitude = $row['longitude'];
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-1 mt-1">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent p-0">
                <li class="breadcrumb-item"><a href="driver_dashboard.php" class="text-secondary" style="color: #026601; text-decoration: none;">Dashboard</a></li>
                <li class="breadcrumb-item"><span class="text-gray-700">Tracking</span></li>
                <li class="breadcrumb-item active text-gray-900" aria-current="page">Current Location</li>
            </ol>
        </nav>
        <a href="" class="btn btn-sm btn-info shadow-sm mb-3"><i class="fas fa-download fa-sm text-white"></i> Generate Report</a>
    </div>

    <?php include('message.php'); ?>
    <?php include('message_danger.php'); ?>

    <div id="map-container">
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
              integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
              crossorigin="" />
        <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
        <style>
            body {
                margin: 0;
                padding: 0;
            }

            #map {
                width: 100%;
                height: 70vh;
            }
        </style>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-sm-flex align-items-center justify-content-between py-2">
                    <h6 class="m-0 font-weight-bold text-info">Current Location</h6>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div id="location"><?php echo $locationName; ?></div>
                        <div id="map"></div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
                integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
                crossorigin=""></script>
        <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script>
            function refreshPage() {
                location.reload();
            }

            var map_init = L.map('map', {
                center: [<?php echo $latitude; ?>, <?php echo $longitude; ?>],
                zoom: 18 // Adjust the zoom level as desired
            });
            var osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map_init);
            L.Control.geocoder().addTo(map_init);

            var marker = L.marker([<?php echo $latitude; ?>, <?php echo $longitude; ?>]).addTo(map_init);
            marker.bindPopup('<?php echo $locationName; ?>').openPopup();

            // Refresh the page every 10 seconds
            setTimeout(refreshPage, 10000);
        </script>
    </div>
</div>
<!-- End of Page Content -->

<?php
    include('../includes/scripts.php');
    include('../includes/footer.php');
} else {
    header("Location: ../login.php");
    exit();
}
?>
