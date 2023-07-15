<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['user_name']) && isset($_SESSION['role']) && $_SESSION['role'] == 'staff') {
    // Regenerate the session ID
    session_regenerate_id(true);

    // Include the necessary files and establish database connection
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
                <li class="breadcrumb-item"><a href="driver_dashboard.php" class="text-secondary"
                        style="color: #026601; text-decoration: none;">Dashboard</a></li>
                <li class="breadcrumb-item"><span class="text-gray-700">Garbage Trucks</span></li>
                <li class="breadcrumb-item active text-gray-900" aria-current="page">Fuel</li>
            </ol>
        </nav>
        <a href="" class="btn btn-sm btn-info shadow-sm mb-3"><i
                class="fas fa-download fa-sm text-white"></i> Generate Report</a>
    </div>

    <?php include('message.php'); ?>
    <?php include('message_danger.php'); ?>

    <!-- Add Truck Modal -->
        <div class="modal fade" id="add_slip" tabindex="-1" role="dialog" aria-labelledby="addTruckModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-bold text-gray-800" id="addTruckModalLabel">Create New Fuel Slip</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="crud_truck.php" method="POST">
                            <div class="form-group">
                              <label for="fuelType" class="small text-info">Fuel Type</label>
                              <select class="form-control" id="fuelType" name="fuelType" required>
                                 <option value="">Select fuel type</option>
                                <option value="Diesel">Diesel</option>
                                <option value="Gasoline">Gasoline</option>
                              </select>
                            </div>
                            <div class="form-group">
                                <label for="fuelAmount" class="small text-info">Amount</label>
                                <input type="number" class="form-control" id="fuelAmount" name="fuelAmount" placeholder="Enter Amount" required>
                            </div>
                            <div class="form-group">
                              <label for="fuelType" class="small text-info">Vehicle/ Equipment</label>
                              <select class="form-control" id="fuelType" name="fuelType" required>
                                 <option value="">Select fuel type</option>
                                <option value="GarbageTruck">Garbage Truck</option>
                                <option value="Patrol Boat">Patrol Boat</option>
                                 <option value="Shredder">Shredder</option>
                                  <option value="Grass Cutter">Grass Cutter</option>
                              </select>
                            </div>
                            <div class="form-group">
                                <label for="fuelAmount" class="small text-info">Plate Number</label>
                                <input type="number" class="form-control" id="fuelAmount" name="fuelAmount" placeholder="Enter Amount" required>
                            </div>
                            <div class="form-group">
                                <label for="fuelAmount" class="small text-info">Driver</label>
                                <input type="number" class="form-control" id="fuelAmount" name="fuelAmount" placeholder="Enter Amount" required>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="add_truck" class="btn btn-info">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>



        <!-- Edit Truck Modal -->
        <div class="modal fade" id="edit_truck" tabindex="-1" role="dialog" aria-labelledby="editTruckModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-bold text-gray-800" id="editTruckModalLabel">Edit Garbage Truck</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="crud_truck.php" method="POST">
                            <div class="form-group">
                                <label for="edit_brand" class="small text-info">Brand</label>
                                <input type="text" class="form-control" id="edit_brand" name="edit_brand" placeholder="Enter brand" required>
                            </div>
                            <div class="form-group">
                                <label for="edit_model" class="small text-info">Model</label>
                                <input type="text" class="form-control" id="edit_model" name="edit_model" placeholder="Enter model" required>
                            </div>
                            <div class="form-group">
                                <label for="edit_capacity" class="small text-info">Capacity</label>
                                <input type="number" class="form-control" id="edit_capacity" name="edit_capacity" placeholder="Enter capacity" required>
                            </div>
                            <div class="form-group">
                                <label for="edit_plateNumber" class="small text-info">Plate Number</label>
                                <input type="text" class="form-control" id="edit_plateNumber" name="edit_plateNumber" placeholder="Enter plate number" required>
                            </div>
                            <input type="hidden" id="edit_truck_id" name="edit_truck_id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="edit_truck" class="btn btn-info">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!-- Delete Truck Modal -->
        <div class="modal fade" id="delete_truck" tabindex="-1" role="dialog" aria-labelledby="deleteTruckModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-bold text-gray-800" id="deleteTruckModalLabel">Delete Garbage Truck</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="delete_truck_form" action="crud_truck.php" method="POST">
                        <div class="modal-body">
                            <p>Are you sure you want to delete <span class="text-info font-weight-bold mx-auto" id="delete_truck_brand"></span> garbage truck?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" id="confirm_delete_btn" class="btn btn-danger">Delete</button>
                            <input type="hidden" id="delete_truck_id" name="delete_truck_id">
                        </div>
                    </form>
                </div>
            </div>
        </div>

    <div class="row">
        <div class="col-lg-12">
            
        </div>
        <div class="col-lg-12">

            <style>
                .nav-tabs .nav-link.active,
                .nav-tabs .nav-item.show .nav-link {
                    color: #026601;
                    background-color: #fff;
                    border-color: #dddfeb #dddfeb #fff;
                }

                a {
                    color: #808080;
                    text-decoration: none;
                    background-color: transparent;
                }

                a:hover {
                    color: #026601;
                    text-decoration: underline;
                }
            </style>
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-issued-tab" data-toggle="tab" href="#nav-issued"
                        role="tab" aria-controls="nav-issued" aria-selected="true">Issued</a>
                    <a class="nav-item nav-link" id="nav-purchased-tab" data-toggle="tab" href="#nav-purchased"
                        role="tab" aria-controls="nav-purchased" aria-selected="false">Purchased</a>
                    <a class="nav-item nav-link" id="nav-used-tab" data-toggle="tab" href="#nav-used" role="tab"
                        aria-controls="nav-used" aria-selected="false">Used</a>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <!-- Issued -->
                <div class="tab-pane fade show active" id="nav-issued" role="tabpanel"
                    aria-labelledby="nav-issued-tab">

                    <!-- DataTables Start-->    
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="d-sm-flex align-items-center justify-content-between py-2">
                                <h6 class="m-0 font-weight-bold text-gray-700">Issued Gasoline</h6>
                                <a href="#add_slip" data-toggle="modal"
                                    class="btn btn-sm btn-info shadow-sm"><i
                                        class="fa fa-plus fa-sm text-white mr-1"></i>Create Fuel Slip</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <!-- Issued Gasoline Table -->
                                                    <table id="issuedGasolineTable" class="display nowrap table table-bordered table-hover" style="width:100%;">
                        <thead class='thead-light text-gray-900'>
                          <tr style="text-align:center">
                            <th style="text-align: center;">No.</th>
                            <th style="text-align: center;">Brand</th>
                            <th style="text-align: center;">Model</th>
                            <th style="text-align: center;">Capacity</th>
                            <th style="text-align: center;">Plate Number</th>
                            <th class="no-export" width="12%" style="text-align: center;">Actions</th>
                          </tr>
                        </thead>
                        <tfoot class='thead-light text-gray-700'>
                          <tr style="text-align:center">
                            <th style="text-align: center;">No.</th>
                            <th style="text-align: center;">Brand</th>
                            <th style="text-align: center;">Model</th>
                            <th style="text-align: center;">Capacity</th>
                            <th style="text-align: center;">Plate Number</th>
                            <th class="no-export" width="12%" style="text-align: center;">Actions</th>
                          </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            $no = 1;
                            $query = "SELECT * FROM garbage_trucks";
                            $query_run = mysqli_query($conn, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                foreach ($query_run as $row) {
                                    ?>
                                    <tr style="text-align:center">
                                        <td><?php echo $no; ?></td>
                                        <td><?= $row['brand']; ?></td>
                                        <td><?= $row['model']; ?></td>
                                        <td><?= $row['capacity']; ?></td>
                                        <td><?= $row['plateNumber']; ?></td>
                                        <td>
                                        <div class="dropdown">
                                          <button class="btn btn-sm btn-outline-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Actions
                                          </button>
                                          <div class="dropdown-menu text-info pr-0" aria-labelledby="dropdownMenuButton">
                                            <button class="dropdown-item edit-truck-btn" data-toggle="modal" 
                                            data-target="#edit_truck" 
                                            data-id="<?= $row['id']; ?>" 
                                            data-brand="<?= $row['brand']; ?>" 
                                            data-model="<?= $row['model']; ?>" 
                                            data-capacity="<?= $row['capacity']; ?>" 
                                            data-platenumber="<?= $row['plateNumber']; ?>" 
                                            data-toggle="tooltip" 
                                            title="Edit <?= $row['brand']; ?>!" 
                                            data-placement="top">
                                              <i class="fa fa-edit fw-fa text-primary" aria-hidden="true"></i> Edit
                                            </button>
                                            <button class="dropdown-item delete-truck-btn" data-toggle="modal" 
                                            data-target="#delete_truck" 
                                            data-id="<?= $row['id']; ?>" 
                                            data-brand="<?= $row['brand']; ?>" 
                                            data-toggle="tooltip" 
                                            title="Delete <?= $row['brand']; ?>!" 
                                            data-placement="top">
                                              <i class="fa fa-trash fw-fa text-danger" aria-hidden="true"></i> Delete
                                            </button>
                                          </div>
                                        </div>

                                            <!-- <a class="btn btn-sm btn-outline-success edit-truck-btn" href="#edit_truck" data-toggle="modal" data-id="<?= $row['id']; ?>" data-brand="<?= $row['brand']; ?>" data-model="<?= $row['model']; ?>" data-capacity="<?= $row['capacity']; ?>" data-platenumber="<?= $row['plateNumber']; ?>" data-toggle="tooltip" title="Edit <?= $row['brand']; ?>!" data-placement="top">
                                                <i class="fa fa-edit fw-fa" aria-hidden="true"></i>
                                            </a>

                                            <a class="btn btn-sm btn-outline-danger delete-truck-btn" href="#delete_truck" data-toggle="modal" data-id="<?= $row['id']; ?>" data-brand="<?= $row['brand']; ?>" data-toggle="tooltip" title="Delete <?= $row['brand']; ?>!" data-placement="top">
                                                <i class="fa fa-trash fw-fa" aria-hidden="true"></i>
                                            </a> -->

                                        </td>
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
                    <!-- DataTables End-->

                </div>
                <!-- Issued end -->
                <!-- Purchased -->
                <div class="tab-pane fade" id="nav-purchased" role="tabpanel"
                    aria-labelledby="nav-purchased-tab">
                    <!-- DataTables Start-->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="d-sm-flex align-items-center justify-content-between py-2">
                                <h6 class="m-0 font-weight-bold text-gray-700">List of purchased gasoline</h6>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <!-- Purchased Gasoline Table -->
                                <table id="purchasedGasolineTable" class="display nowrap table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Date</th>
                                            <th>Driver</th>
                                            <th>Vehicle/ Equipment</th>
                                            <th>Plate Number</th>
                                            <th>Fuel Type</th>
                                            <th>Amount</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Populate with data -->
                                        <tr>
                                            <td>1</td>
                                            <td>2023-07-10</td>
                                            <td>John Doe</td>
                                            <td>Garbage truck</td>
                                            <td>LKSV-313</td>
                                            <td>Gasoline</td>
                                            <td>500</td>
                                            <th>Action</th>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td>2023-07-10</td>
                                            <td>John Doe</td>
                                            <td>Garbage truck</td>
                                            <td>LKSV-313</td>
                                            <td>Gasoline</td>
                                            <td>500</td>
                                            <th>Action</th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- DataTables End -->
                </div>
                <!-- Purchased end-->
                <!-- Used -->
                <div class="tab-pane fade" id="nav-used" role="tabpanel" aria-labelledby="nav-used-tab">
                    <!-- DataTables Start-->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="d-sm-flex align-items-center justify-content-between py-2">
                                <h6 class="m-0 font-weight-bold text-gray-700">List of Used Gasoline</h6>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <!-- Used Gasoline Table -->
                            <table id="usedGasolineTable" class="display nowrap table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Date</th>
                                        <th>Vehicle</th>
                                        <th>Driver</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Populate with data -->
                                    <tr>
                                        <td>1</td>
                                        <td>2023-07-10</td>
                                        <td>Vehicle A</td>
                                        <td>Kenneth alvarez</td>
                                        <td><div class="progress">
  <div class="progress-bar bg-info" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
</div>
</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>2023-07-09</td>
                                        <td>Vehicle B</td>
                                        <td>John Paulo Bascuguin</td>
                                        <td><div class="progress">
  <div class="progress-bar bg-danger" role="progressbar" style="width: 15%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
</div>
</td>
                                    </tr>
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                    <!-- DataTables End-->
                </div>
                <!-- Used end -->
            </div>
        </div>
    </div>
</div>
</div>
        
<!-- Include jQuery and DataTables JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>

<script>
$(document).ready(function() {
    // Initialize DataTables with dropdown export options and show rows feature
    $('#issuedGasolineTable').DataTable({
        dom: '<"dt-buttons"B>frtip',
        buttons: [
            {
                extend: 'collection',
                className: 'custom-html-collection',
                text: 'Options',
                buttons: [
                    'copy',
                    'csv',
                    'excel',
                    'pdf',
                    'print'
                ]
            },
            'pageLength'
        ],
        lengthMenu: [
            [ 10, 25, 50, -1 ],
            [ '10 rows', '25 rows', '50 rows', 'Show all' ]
        ],
        stateSave: true // Enable state saving
    });

    $('#purchasedGasolineTable').DataTable({
        dom: '<"dt-buttons"B>frtip',
        buttons: [
            {
                extend: 'collection',
                className: 'custom-html-collection',
                text: 'Options',
                buttons: [
                    'copy',
                    'csv',
                    'excel',
                    'pdf',
                    'print'
                ]
            },
            'pageLength'
        ],
        lengthMenu: [
            [ 10, 25, 50, -1 ],
            [ '10 rows', '25 rows', '50 rows', 'Show all' ]
        ],
        stateSave: true // Enable state saving
    });

    $('#usedGasolineTable').DataTable({
        dom: '<"dt-buttons"B>frtip',
        buttons: [
            {
                extend: 'collection',
                className: 'custom-html-collection',
                text: 'Options',
                buttons: [
                    'copy',
                    'csv',
                    'excel',
                    'pdf',
                    'print'
                ]
            },
            'pageLength'
        ],
        lengthMenu: [
            [ 10, 25, 50, -1 ],
            [ '10 rows', '25 rows', '50 rows', 'Show all' ]
        ],
        stateSave: true // Enable state saving
    });
});
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.edit-truck-btn').click(function() {
            var truckId = $(this).data('id');
            var brand = $(this).data('brand');
            var model = $(this).data('model');
            var capacity = $(this).data('capacity');
            var plateNumber = $(this).data('platenumber');

            $('#edit_truck_id').val(truckId);
            $('#edit_brand').val(brand);
            $('#edit_model').val(model);
            $('#edit_capacity').val(capacity);
            $('#edit_plateNumber').val(plateNumber);
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('.delete-truck-btn').click(function() {
            var truckId = $(this).data('id');
            var brand = $(this).data('brand');
            
            $('#delete_truck_id').val(truckId);
            $('#delete_truck_brand').text(brand);
        });

        $('#delete_truck_form').submit(function(e) {
                    e.preventDefault();
                    var truckId = $('#delete_truck_id').val();
                    $.ajax({
                        type: "POST",
                        url: "crud_truck.php",
                        data: {
                            delete_truck_id: truckId
                        },
                        success: function(response) {
                            // Reload the page to see the message
                            location.reload();
                        }
                    });
                });
            });
</script>

<!-- End of Page Content -->
<?php
include('../includes/scripts.php');
include('../includes/footer.php');
} else {
    header("Location: ../login.php");
    exit();
}
?>
