<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['user_name']) && isset($_SESSION['role']) && $_SESSION['role'] == 'driver') {
    include('../includes/header.php');
    include('../includes/navbar_driver.php');
    require '../db_conn.php';

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['locationName']) && isset($_POST['latitude']) && isset($_POST['longitude'])) {
        $locationName = $_POST['locationName'];
        $latitude = $_POST['latitude'];
        $longitude = $_POST['longitude'];
        $driverId = $_SESSION['id'];

        // Insert the data into your database table
        // Get the current date
        $currentDate = date('Y-m-d');

        // Check if an existing row with the same driver_id and date exists
        $existingRowSql = "SELECT * FROM current_location
                           WHERE driver_id = '$driverId' AND DATE(datetime) = '$currentDate'";
        $existingRowResult = mysqli_query($conn, $existingRowSql);
        $existingRow = mysqli_fetch_assoc($existingRowResult);

        if ($existingRow) {
            // An existing row with the same driver_id and date was found, update the values
            $existingLocationId = $existingRow['id'];
            $sql = "UPDATE current_location
                    SET locationName = '$locationName', latitude = '$latitude', longitude = '$longitude', datetime = NOW()
                    WHERE id = '$existingLocationId'";
        } else {
            // No existing row with the same driver_id and date, insert a new row
            $sql = "INSERT INTO current_location (driver_id, locationName, latitude, longitude, datetime)
                    VALUES ('$driverId', '$locationName', '$latitude', '$longitude', NOW())";
        }

        // Execute the query
        if (mysqli_query($conn, $sql)) {
            echo "Location saved successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        exit; // Stop further execution


    }
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
                <!-- <a href="#add_truck" data-toggle="modal" class="btn btn-sm btn-info shadow-sm"><i class="fa fa-plus fa-sm text-white mr-1"></i>Add Garbage Truck</a> -->
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div id="location"></div>
                    <div id="map"></div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Include jQuery -->

    <script>
        var map_init = L.map('map', {
            center: [13.8993, 120.6171], // Set the default location to Lian, Batangas
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
        }
        var marker, circle, lat, long, accuracy;

        function getPosition(position) {
            lat = position.coords.latitude;
            long = position.coords.longitude;
            accuracy = position.coords.accuracy;

            if (marker) {
                map_init.removeLayer(marker);
            }

            if (circle) {
                map_init.removeLayer(circle);
            }

            marker = L.marker([lat, long]);
            circle = L.circle([lat, long], { radius: accuracy });

            var featureGroup = L.featureGroup([marker, circle]).addTo(map_init);

            map_init.fitBounds(featureGroup.getBounds());

            // Reverse geocoding
            fetch(`https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${long}&format=json`)
                .then(response => response.json())
                .then(data => {
                    var locationName = data.display_name;
                    var locationElement = document.getElementById('location');
                    if (locationElement) {
                        locationElement.innerHTML = locationName;

                        // Save data to the database using AJAX
                        saveLocation(locationName, lat, long);
                    }
                    console.log("Your coordinate is: Lat: " + lat + " Long: " + long + " Accuracy: " + accuracy);
                    console.log("Location Name: " + locationName);
                })
                .catch(error => console.log(error));
        }

        function saveLocation(locationName, latitude, longitude) {
            $.ajax({
                type: 'POST',
                url: '<?php echo $_SERVER["PHP_SELF"]; ?>', // The same PHP file
                data: { locationName: locationName, latitude: latitude, longitude: longitude },
                success: function (response) {
                    console.log(response);
                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }
    </script>
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
