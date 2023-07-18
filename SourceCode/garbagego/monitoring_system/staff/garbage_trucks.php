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
                    <li class="breadcrumb-item"><span class="text-gray-700">Waste Collection</span></li>
                    <li class="breadcrumb-item active text-gray-900" aria-current="page">Garbage Trucks</li>
                </ol>
            </nav>
            <a href="" class="btn btn-sm btn-info shadow-sm mb-3"><i class="fas fa-download fa-sm text-white"></i> Generate Report</a>
        </div>

        <?php include('message.php'); ?>
        <?php include('message_danger.php'); ?>

        <!-- Add Truck Modal -->
        <div class="modal fade" id="add_truck" tabindex="-1" role="dialog" aria-labelledby="addTruckModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-bold text-gray-800" id="addTruckModalLabel">Add New Garbage Truck</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="crud_truck.php" method="POST">
                            <div class="form-row">
                                <div class="form-group mt-2 col-md-12">
                                    <input type="text" class="form-control" id="brand" name="brand" placeholder=" " required>
                                    <label for="brand" class="text-gray">Brand</label>
                                </div>
                                <div class="form-group mt-2 col-md-12">
                                    <input type="text" class="form-control" id="model" name="model" placeholder=" " required>
                                    <label for="model" class="text-gray">Model</label>
                                </div>
                                <div class="form-group mt-2 col-md-12">
                                    <input type="number" class="form-control" id="capacity" name="capacity" placeholder=" " required>
                                    <label for="capacity" class="text-gray">Capacity</label>
                                </div>
                                <div class="form-group mt-2 col-md-12">
                                    <input type="text" class="form-control" id="plateNumber" name="plateNumber" placeholder=" " required>
                                     <label for="plateNumber" class="text-gray">Plate Number</label>
                                </div>
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
                            <div class="form-row">
                                <div class="form-group mt-2 col-md-12">
                                    <input type="text" class="form-control" id="edit_brand" name="edit_brand" placeholder=" " required>
                                    <label for="edit_brand" class="text-gray">Brand</label>
                                </div>
                                <div class="form-group mt-2 col-md-12">
                                    <input type="text" class="form-control" id="edit_model" name="edit_model" placeholder=" " required>
                                    <label for="edit_model" class="text-gray">Model</label>
                                </div>
                                <div class="form-group mt-2 col-md-12">
                                    <input type="number" class="form-control" id="edit_capacity" name="edit_capacity" placeholder=" " required>
                                    <label for="edit_capacity" class="text-gray">Capacity</label>
                                </div>
                                <div class="form-group mt-2 col-md-12">
                                    <input type="text" class="form-control" id="edit_plateNumber" name="edit_plateNumber" placeholder=" " required>
                                    <label for="edit_plateNumber" class="text-gray">Plate Number</label>
                                </div>
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

        <!-- DataTables Start-->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-sm-flex align-items-center justify-content-between py-2">
                    <h6 class="m-0 font-weight-bold text-info">List of Garbage Truck(s)</h6>
                    <a href="#add_truck" data-toggle="modal" class="btn btn-sm btn-info shadow-sm"><i class="fa fa-plus fa-sm text-white mr-1"></i>Add Garbage Truck</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="display nowrap table table-bordered table-hover" style="width:100%;">
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
    </div>
</div>
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