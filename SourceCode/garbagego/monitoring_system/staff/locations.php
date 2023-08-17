<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['user_name']) && isset($_SESSION['role']) && $_SESSION['role'] == 'staff') {

include('../includes/header.php');
include('../includes/navbar_staff.php');
require '../db_conn.php';
?>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-1 mt-1">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0">
                    <li class="breadcrumb-item"><a href="staff_dashboard.php" class="text-secondary" style="color: #026601; text-decoration: none;">Dashboard</a></li>
                    <li class="breadcrumb-item"><span class="text-gray-700">Waste Collections</span></li>
                    <li class="breadcrumb-item active text-gray-900" aria-current="page">Locations</li>
                </ol>
            </nav>
            <a href="" class="btn btn-sm btn-info shadow-sm mb-3"><i class="fas fa-download fa-sm text-white"></i> Generate Report</a>
        </div>

        <script>
        <?php
        // Check if the session message exists and show it as a SweetAlert
        if (isset($_SESSION['message'])) {
            echo "Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '{$_SESSION['message']}',
                    showConfirmButton: false,
                    timer: 2000,
                    customClass: {
                        popup: 'my-sweetalert',
                    }
                });";
            unset($_SESSION['message']); // Clear the session message after displaying it
        }

        if (isset($_SESSION['message_danger'])) {
            echo "Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: '{$_SESSION['message_danger']}',
                    showConfirmButton: false,
                    timer: 2000,
                    customClass: {
                        popup: 'my-sweetalert',
                    }
                });";
            unset($_SESSION['message_danger']); // Clear the session message after displaying it
        }
        ?>
    </script>

      <!-- Add Location -->
      <div class="card shadow mb-4">
          <!-- Card Header - Accordion -->
          <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
              <h6 class="m-0 font-weight-bold text-info">Add Location</h6>
          </a>
          <!-- Card Content - Collapse -->
          <div class="collapse show" id="collapseCardExample" style="">
              <div class="card-body">
                  <div class="row">
              <div class="col-md-6">
                  <div id="map" style="width: 100%; height: 30vh;"></div>
              </div>
              <div class="col-md-6">
                  <form action="crud_location.php" method="POST">
                      <div class="form-row">
                          <div class="form-group mt-2 col-md-12">
                              <input type="text" class="form-control" id="location" name="location" placeholder=" ">
                              <label for="location" class="text-gray">Location Name</label>
                          </div>
                      </div>
                      <div class="form-row">
                          <div class="form-group mt-2 col-md-12">
                              <input type="text" class="form-control" id="latitude" name="latitude" placeholder=" ">
                              <label for="latitude" class="text-gray">Latitude</label>
                          </div>
                      </div>
                      <div class="form-row">
                          <div class="form-group mt-2 col-md-12">
                              <input type="text" class="form-control" id="longitude" name="longitude" placeholder=" ">
                              <label for="longitude" class="text-gray">Longitude</label>
                          </div>
                      </div>
                      <button type="submit" name="add_location" class="btn btn-info">Save</button>
                  </form>
              </div>
          </div>
              </div>
          </div>
      </div>

        <!-- Edit Location -->
        <div class="modal fade" id="edit_loc" tabindex="-1" role="dialog" aria-labelledby="editLocationModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-gray-800" id="editLocationModalLabel">Edit Location Name</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="crud_location.php" method="POST">
                  <div class="form-row">
                    <div class="form-group mt-2 col-md-12">
                      <input type="text" class="form-control" id="edit_location" name="edit_location" placeholder=" ">
                      <label for="edit_location" class="text-gray">Location Name</label>
                    </div>
                  </div>
                  <input type="hidden" id="edit_location_id" name="edit_location_id">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="edit_loc" class="btn btn-info">Update</button>
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- Delete Location Modal -->
        <div class="modal fade" id="delete_loc" tabindex="-1" role="dialog" aria-labelledby="deleteLocationkModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-bold text-gray-800" id="deleteLocationkModalLabel">Delete location</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="delete_location_form" action="crud_location.php" method="POST">
                        <div class="modal-body">
                            <p>Are you sure you want to delete location <span class="text-info font-weight-bold mx-auto" id="delete_location"></span>?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" id="confirm_delete_btn" class="btn btn-danger">Delete</button>
                            <input type="hidden" id="delete_location_id" name="delete_location_id">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- DataTables Start-->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-sm-flex align-items-center justify-content-between py-2">
                    <h6 class="m-0 font-weight-bold text-info">List of Location(s)</h6>
                   <!--  <a href="#add_location" data-toggle="modal" class="btn btn-sm btn-info shadow-sm"><i class="fa fa-plus fa-sm text-white mr-1"></i>Add location</a> -->
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="display nowrap table table-bordered table-hover" style="width:100%;">
                        <thead class='thead-light text-gray-900'>
                          <tr style="text-align:center">
                            <th style="text-align: center;">No.</th>
                            <th style="text-align: center;">Location</th>
                            <th style="text-align: center;">Latitude</th>
                            <th style="text-align: center;">Longitude</th>
                           <th style="text-align: center;">Map</th>
                            <th class="no-export" width="12%" style="text-align: center;">Actions</th>
                          </tr>
                        </thead>
                        <tfoot class='thead-light text-gray-700'>
                          <tr style="text-align:center">
                            <th style="text-align: center;">No.</th>
                            <th style="text-align: center;">Location</th>
                            <th style="text-align: center;">Latitude</th>
                            <th style="text-align: center;">Longitude</th>
                            <th style="text-align: center;">Map</th>
                            <th class="no-export" width="12%" style="text-align: center;">Actions</th>
                          </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            $no = 1;
                            $query = "SELECT * FROM locations ORDER BY dateCreated DESC";
                            $query_run = mysqli_query($conn, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                foreach ($query_run as $row) {
                                    ?>
                                    <tr style="text-align:center">
                                        <td><?php echo $no; ?></td>
                                        <td><?= $row['location'] ?: '-'; ?></td>
                                        <td><?= $row['latitude'] ?: '-'; ?></td>
                                        <td><?= $row['longitude'] ?: '-'; ?></td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-info show-map-button" data-lat="<?= $row['latitude']; ?>" data-lng="<?= $row['longitude']; ?>" data-toggle="tooltip"
                                            title="Click to show the map>!"
                                            data-placement="top">
                                                <i class="fa fa-location-arrow"></i>
                                            </button>
                                        </td>
                                        <td>
                                        <div class="dropdown">
                                          <button class="btn btn-sm btn-outline-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Actions
                                          </button>
                                          <div class="dropdown-menu text-info pr-0" aria-labelledby="dropdownMenuButton">
                                            <button class="dropdown-item edit-location-btn" data-toggle="modal"
                                            data-target="#edit_loc"
                                            data-id="<?= $row['id']; ?>"
                                            data-location="<?= $row['location']; ?>"
                                            data-toggle="tooltip"
                                            title="Edit <?= $row['location']; ?>!"
                                            data-placement="top">
                                            <i class="fa fa-edit fw-fa text-primary" aria-hidden="true"></i> Edit
                                            </button>

                                            <button class="dropdown-item delete-location-btn" data-toggle="modal" 
                                            data-target="#delete_loc" 
                                            data-id="<?= $row['id']; ?>" 
                                            data-location="<?= $row['location']; ?>" 
                                            data-toggle="tooltip" 
                                            title="Delete <?= $row['location']; ?>!" 
                                            data-placement="top">
                                            <i class="fa fa-trash fw-fa text-danger" aria-hidden="true"></i> Delete
                                            </button>
                                          </div>
                                        </div>
                                    </tr>
                            <?php
                                    $no++;
                                }
                            } else {
                                echo "<h5> No Record Found </h5>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Function to show the map using SweetAlert and Leaflet
    function showMap(lat, lng) {
        const mapContainer = document.createElement('div');
        mapContainer.setAttribute('id', 'map');
        mapContainer.style.height = '300px';
        mapContainer.style.width = '100%';

        Swal.fire({
            title: 'Location Map',
            html: mapContainer,
            showCloseButton: true,
            showCancelButton: false,  // Hide the OK button
            showConfirmButton: false, // Hide the Cancel button
            didOpen: () => {
                const map = L.map(mapContainer).setView([lat, lng], 15);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: 'Map data © <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);

                L.marker([lat, lng]).addTo(map);
            }
        });
    }

    // Add click event listener to the 'Show Map' buttons
    const showMapButtons = document.querySelectorAll('.show-map-button');
    showMapButtons.forEach(button => {
        button.addEventListener('click', () => {
            const lat = parseFloat(button.getAttribute('data-lat'));
            const lng = parseFloat(button.getAttribute('data-lng'));
            showMap(lat, lng);
        });
    });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- edit truck function -->
<script>
  $(document).ready(function() {
    $('.edit-location-btn').click(function() {
      var location_id = $(this).data('id');
      var location = $(this).data('location');

      $('#edit_location_id').val(location_id);
      $('#edit_location').val(location);
    });
  });
</script>
<!-- delete truck function -->
<script>
$(document).ready(function() {
    $('.delete-location-btn').click(function() {
        var locationId = $(this).data('id');
        var location = $(this).data('location');
        
        $('#delete_location_id').val(locationId);
        $('#delete_location').text(location);
    });

    $('#delete_location_form').submit(function(e) {
        e.preventDefault();
        var locationId = $('#delete_location_id').val();
        $.ajax({
            type: "POST",
            url: "crud_location.php", // Adjust this URL to the correct PHP file for truck deletions
            data: {
                delete_location_id: locationId
            },
            success: function(response) {
                console.log("Delete response:", response);

                // Hide the deleted row from the table
                $('#row_' + locationId).hide();

                // Show a success message with SweetAlert2 toast
                Swal.fire({
                    icon: 'success',
                    title: 'Deleted!',
                    text: 'The location has been deleted successfully.',
                    showConfirmButton: false,
                    timer: 2000, // 2 seconds duration for the toast
                    customClass: {
                        popup: 'my-sweetalert',
                    }
                });

                // Refresh the page after a delay (e.g., 2 seconds)
                setTimeout(function() {
                    location.reload();
                }, 2000); // 2000 milliseconds = 2 seconds
            },
            error: function(error) {
                // Handle the error response if needed
                console.log("Delete error:", error);
            }
        });
    });
});
</script>

<!-- Other head elements -->
<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder@1.13.0/dist/Control.Geocoder.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-control-geocoder@1.13.0/dist/Control.Geocoder.js"></script>
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin=""></script>
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
<script>
    // Initialize Leaflet map
    var map_init = L.map('map').setView([14.036118, 120.653454], 15); // Adjust the zoom level here

    // Add a tile layer
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map_init);

    var marker;

    // Initialize the geocoder control
    var geocoder = L.Control.geocoder({
        defaultMarkGeocode: false,
    }).on('markgeocode', function(e) {
        var latlng = e.geocode.center;
        var locationName = e.geocode.name;

        if (marker) {
            map_init.removeLayer(marker);
        }
        marker = L.marker(latlng).addTo(map_init);

        document.getElementById('location').value = locationName;
        document.getElementById('latitude').value = latlng.lat.toFixed(6);
        document.getElementById('longitude').value = latlng.lng.toFixed(6);

        map_init.setView(latlng, 15);
    }).addTo(map_init);

    // Add a click event handler to the map
    map_init.on('click', function(e) {
        var latlng = e.latlng;

        if (marker) {
            map_init.removeLayer(marker);
        }
        marker = L.marker(latlng).addTo(map_init);

        // Initialize the geocoder for reverse geocoding
        var geocoder = L.Control.Geocoder.nominatim();
        geocoder.reverse(latlng, map_init.options.crs.scale(map_init.getZoom()), function(results) {
            var locationName = results[0].name;

            document.getElementById('location').value = locationName;
            document.getElementById('latitude').value = latlng.lat.toFixed(6);
            document.getElementById('longitude').value = latlng.lng.toFixed(6);
        });

        map_init.setView(latlng, 15);
    });
</script>

<?php
include('../includes/footer.php');
include('../includes/scripts.php');
} else {
header("Location: ../login.php");
exit();
}
?>
