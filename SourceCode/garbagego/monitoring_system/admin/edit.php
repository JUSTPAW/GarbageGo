<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['user_name']) && isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
    include('../includes/header.php');
    include('../includes/navbar_admin.php');
    require '../db_conn.php';
    ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-1 mt-1">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent" style="margin-top: 5px; padding-left: 0;">
                    <li class="breadcrumb-item"><a href="admin.php" class="text-info h5" style="text-decoration: none;">Dashboard</a></li>
                    <li class="breadcrumb-item active text-dark h5" aria-current="page">Garbage Trucks</li>
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
                        <form action="crud.php" method="POST">
                            <div class="form-group">
                                <label for="brand" class="small text-info">Brand</label>
                                <input type="text" class="form-control" id="brand" name="brand" placeholder="Enter brand" required>
                            </div>
                            <div class="form-group">
                                <label for="model" class="small text-info">Model</label>
                                <input type="text" class="form-control" id="model" name="model" placeholder="Enter model" required>
                            </div>
                            <div class="form-group">
                                <label for="capacity" class="small text-info">Capacity</label>
                                <input type="number" class="form-control" id="capacity" name="capacity" placeholder="Enter capacity" required>
                            </div>
                            <div class="form-group">
                                <label for="plateNumber" class="small text-info">Plate Number</label>
                                <input type="text" class="form-control" id="plateNumber" name="plateNumber" placeholder="Enter plate number" required>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="add_truck" class="btn btn-info">Save changes</button>
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
                        <form action="crud.php" method="POST">
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
                        <button type="submit" name="edit_truck" class="btn btn-info">Save changes</button>
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
                    <div class="modal-body">
                        <p>Are you sure you want to delete this garbage truck?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" id="confirm_delete_btn" class="btn btn-danger">Delete</button> <!-- Add ID attribute -->
                    </div>
                </div>
            </div>
        </div>



        <!-- DataTables Start-->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-sm-flex align-items-center justify-content-between py-2">
                    <h6 class="m-0 font-weight-bold text-info">List of Garbage Trucks</h6>
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
                            <th style="text-align: center;">Capacity</th>
                            <th style="text-align: center;">Gender</th>
                            <th style="text-align: center;">Plate Number</th>
                            <th class="no-export" width="12%" style="text-align: center;">Options</th>
                          </tr>
                        </thead>
                        <tfoot class='thead-light text-gray-700'>
                          <tr style="text-align:center">
                            <th style="text-align: center;">No.</th>
                            <th style="text-align: center;">Brand</th>
                            <th style="text-align: center;">Capacity</th>
                            <th style="text-align: center;">Gender</th>
                            <th style="text-align: center;">Plate Number</th>
                            <th class="no-export" width="12%" style="text-align: center;">Options</th>
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
                                            <a class="btn btn-sm btn-outline-success edit-truck-btn" href="#edit_truck" data-toggle="modal" data-id="<?= $row['id']; ?>" data-brand="<?= $row['brand']; ?>" data-model="<?= $row['model']; ?>" data-capacity="<?= $row['capacity']; ?>" data-platenumber="<?= $row['plateNumber']; ?>" data-toggle="tooltip" title="Edit <?= $row['brand']; ?>!" data-placement="top">
                                                <i class="fa fa-edit fw-fa" aria-hidden="true"></i>
                                            </a>
                                            ||

                                            <a class="btn btn-sm btn-outline-danger delete-truck-btn" href="#delete_truck" data-toggle="modal" data-id="<?= $row['id']; ?>" data-brand="<?= $row['brand']; ?>" data-toggle="tooltip" title="Delete <?= $row['brand']; ?>!" data-placement="top">
                                                <i class="fa fa-trash fw-fa" aria-hidden="true"></i>
                                            </a>

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

    $(document).ready(function() {
    $('.delete-truck-btn').click(function() {
        var truckId = $(this).data('id');
        var brand = $(this).data('brand');

        $('#delete_truck_id').val(truckId);
        $('#delete_truck_brand').text(brand);
    });

    $('#confirm_delete_btn').click(function() {
        var truckId = $('#delete_truck_id').val();

        $.ajax({
            type: 'POST',
            url: 'crud.php',
            data: { delete_truck_id: truckId },
            success: function(response) {
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
        header("Location: ../index.php");
        exit();
    }
    ?>