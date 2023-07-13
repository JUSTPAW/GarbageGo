<?php 
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['user_name']) && isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
include('../includes/header.php');
include('../includes/navbar_admin.php');
require '../db_conn.php';
?>

<!-- to not back when logout-->
<script type="text/javascript">
    window.history.forward();
    function noBack() {
        window.history.forward();
    }
</script>

 <!-- Begin Page Content -->
 <div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        <i class="fa fa-road fa-1x text-gray-600 mr-1"></i>
        Garbage Trucks Route
    </h1>
    <!-- <a href="row_report.php" class="btn btn-sm btn-info shadow-sm"><i
            class="fas fa-download fa-sm text-white"></i> Generate Report</a> -->
</div>

<?php include('message.php'); ?>
<?php include('message_danger.php'); ?>


<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet-control-geocoder/1.13.1/Control.Geocoder.min.css" />


<style>
    body {
        margin: 0;
        padding: 0;
    }

    #map {
        width: 100%;
        height: 60vh;
    }
    .fa-icon {
        font-size: 10px;
        color: #026601;
    }
</style>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin="" />
<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        #map2 {
            width: 100%;
            height: 100vh;
        }
</style>


<div class="row">                        
    <div class="col-lg-12">
        <!-- Dropdown Card Example -->
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-info">Garbage Collection Location</h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
            <!-- Card Body -->
            <div class="card-body">
                <div id="map"></div>
                <div id="map2"></div>
            </div>


<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script>
    var map = L.map('map').setView([14.0860746, 100.608406], 6);

    var osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    });
    osm.addTo(map);

    if (!navigator.geolocation) {
        console.log("Your browser doesn't support geolocation feature!");
    } else {
        setInterval(() => {
            navigator.geolocation.getCurrentPosition(getPosition);
        }, 1);
    }

    var marker, circle;

    function getPosition(position) {
        var lat = position.coords.latitude;
        var long = position.coords.longitude;
        var accuracy = position.coords.accuracy;

        if (marker) {
            map.removeLayer(marker);
        }

        if (circle) {
            map.removeLayer(circle);
        }

        marker = L.marker([lat, long], { icon: L.divIcon({ className: 'fa-icon', html: '<i class="fas fa-truck"></i>' }) }).addTo(map);
        circle = L.circle([lat, long], { radius: accuracy, color: '#026601', fillColor: '#026601' }).addTo(map);

        var featureGroup = L.featureGroup([marker, circle]).addTo(map);

        map.fitBounds(featureGroup.getBounds());

        console.log("Your coordinate is: Lat: " + lat + " Long: " + long + " Accuracy: " + accuracy);
    }
</script>

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    <script>
        var map_init = L.map('map2', {
            center: [9.0820, 8.6753],
            zoom: 8
        });
        var osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map_init);
        L.Control.geocoder().addTo(map_init);
        if (!navigator.geolocation) {
            console.log("Your browser doesn't support geolocation feature!")
        } else {
            setInterval(() => {
                navigator.geolocation.getCurrentPosition(getPosition)
            }, 5000);
        };
        var marker, circle, lat, long, accuracy;

        function getPosition(position) {
            // console.log(position)
            lat = position.coords.latitude
            long = position.coords.longitude
            accuracy = position.coords.accuracy

            if (marker) {
                map_init.removeLayer(marker)
            }

            if (circle) {
                map_init.removeLayer(circle)
            }

            marker = L.marker([lat, long])
            circle = L.circle([lat, long], { radius: accuracy })

            var featureGroup = L.featureGroup([marker, circle]).addTo(map_init)

            map_init.fitBounds(featureGroup.getBounds())

            console.log("Your coordinate is: Lat: " + lat + " Long: " + long + " Accuracy: " + accuracy)
        }
    </script>

            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

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

































