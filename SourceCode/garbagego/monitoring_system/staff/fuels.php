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
                <li class="breadcrumb-item"><a href="staff_dashboard.php" class="text-secondary"
                        style="color: #026601; text-decoration: none;">Dashboard</a></li>
                <li class="breadcrumb-item"><span class="text-gray-700">Garbage Trucks</span></li>
                <li class="breadcrumb-item active text-gray-900" aria-current="page">Fuel</li>
            </ol>
        </nav>
        <a href="" class="btn btn-sm btn-info shadow-sm mb-3"><i
                class="fas fa-download fa-sm text-white"></i> Generate Report</a>
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

    <!-- Add Fuel Slip-->
        <div class="modal fade" id="add_slip" tabindex="-1" role="dialog" aria-labelledby="addslipModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-bold text-gray-800" id="addslipModalLabel">Create New Fuel Slip</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="crud_fuelslip.php" method="POST">
                            <div class="form-row">
                                <div class="form-group mt-2 col-md-12">
                                    <select class="form-control" id="fuelType" name="fuelType" required>
                                        <option value=""> </option>
                                        <option value="Diesel">Diesel</option>
                                        <option value="Gasoline">Gasoline</option>
                                    </select>
                                    <label for="fuelType" class="text-gray">Fuel Type</label>
                                </div>
                                <div class="form-group mt-2 col-md-12">
                                    <input type="number" class="form-control" id="fuelAmount" name="fuelAmount" placeholder=" " required>
                                    <label for="fuelAmount" class="text-gray">Amount</label>
                                </div>
                                <div class="form-group mt-2 col-md-12">
                                      <select class="form-control" id="vehicle" name="vehicle" required>
                                        <option value=""> </option>
                                        <option value="GarbageTruck">Garbage Truck</option>
                                        <option value="Patrol Boat">Patrol Boat</option>
                                        <option value="Shredder">Shredder</option>
                                        <option value="Grass Cutter">Grass Cutter</option>
                                      </select>
                                      <label for="vehicle" class="text-gray">Vehicle/ Equipment</label>
                                </div>
                                <div class="form-group mt-2 col-md-12">
                                      <select class="form-control" id="driver_id" name="driver_id" required>
                                        <option value=""> </option>
                                        <?php
                                        // Fetch driver data from the "drivers" table
                                        $query_drivers = "SELECT * FROM drivers";
                                        $query_run_drivers = mysqli_query($conn, $query_drivers);

                                        if (mysqli_num_rows($query_run_drivers) > 0) {
                                            foreach ($query_run_drivers as $driver) {
                                                // Combine first name, middle name, and last name with proper formatting
                                                $fullName = $driver['firstName'] . ' ';
                                                if (!empty($driver['middleName'])) {
                                                    $fullName .= substr($driver['middleName'], 0, 1) . '. ';
                                                }
                                                $fullName .= $driver['lastName'];

                                                // Output the formatted name as the option value
                                                echo '<option value="' . $driver['id'] . '">' . $fullName . '</option>';
                                            }
                                        }
                                        ?>
                                      </select>
                                      <label for="driver_id" class="text-gray">Driver</label>
                                </div>

                                <input type="hidden" class="form-control" id="staff_id" name="staff_id" 
                                value="<?php echo $_SESSION['id']; ?>"placeholder=" ">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="add_slip" class="btn btn-info">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Fuel Slip -->
        <div class="modal fade" id="edit_slip" tabindex="-1" role="dialog" aria-labelledby="editslipkModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-gray-800" id="editslipkModalLabel">Edit Fuel Slip</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="crud_fuelslip.php" method="POST">
                  <div class="form-row">
                    <div class="form-group mt-2 col-md-12">
                        <select class="form-control" id="edit_fuelType" name="edit_fuelType" required>
                            <option value=""> </option>
                            <option value="Diesel">Diesel</option>
                            <option value="Gasoline">Gasoline</option>
                        </select>
                        <label for="edit_fuelType" class="text-gray">Fuel Type</label>
                    </div>
                    <div class="form-group mt-2 col-md-12">
                        <input type="number" class="form-control" id="edit_fuelAmount" name="edit_fuelAmount" placeholder=" " required>
                        <label for="edit_fuelAmount" class="text-gray">Amount</label>
                    </div>
                    <div class="form-group mt-2 col-md-12">
                          <select class="form-control" id="edit_vehicle" name="edit_vehicle" required>
                            <option value=""> </option>
                            <option value="GarbageTruck">Garbage Truck</option>
                            <option value="Patrol Boat">Patrol Boat</option>
                            <option value="Shredder">Shredder</option>
                            <option value="Grass Cutter">Grass Cutter</option>
                          </select>
                          <label for="edit_vehicle" class="text-gray">Vehicle/ Equipment</label>
                    </div>
                    <div class="form-group mt-2 col-md-12">
                          <select class="form-control" id="edit_driver_id" name="edit_driver_id" required>
                            <option value=""> </option>
                            <?php
                            // Fetch driver data from the "drivers" table
                            $query_drivers = "SELECT * FROM drivers";
                            $query_run_drivers = mysqli_query($conn, $query_drivers);

                            if (mysqli_num_rows($query_run_drivers) > 0) {
                                foreach ($query_run_drivers as $driver) {
                                    // Combine first name, middle name, and last name with proper formatting
                                    $fullName = $driver['firstName'] . ' ';
                                    if (!empty($driver['middleName'])) {
                                        $fullName .= substr($driver['middleName'], 0, 1) . '. ';
                                    }
                                    $fullName .= $driver['lastName'];

                                    // Output the formatted name as the option value
                                    echo '<option value="' . $driver['id'] . '">' . $fullName . '</option>';
                                }
                            }
                            ?>
                          </select>
                          <label for="edit_driver_id" class="text-gray">Driver</label>
                    </div>
                    <div class="form-group mt-2 col-md-12">
                          <select class="form-control" id="edit_status" name="edit_status" required>
                            <option value=""> </option>
                            <option value="Issued">Issue</option>
                            <option value="Cancelled">Cancel</option>
                            <option value="Used">Used</option>
                            <option value="Accepted">Accepted</option>
                            <option value="Rejected">Rejected</option>
                          </select>
                          <label for="edit_status" class="text-gray">Status</label>
                    </div>
                  </div>
                  <input type="hidden" class="form-control" id="edit_staff_id" name="edit_staff_id" 
                                value="<?php echo $_SESSION['id']; ?>"placeholder=" ">
                  <input type="hidden" id="edit_slip_id" name="edit_slip_id">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="edit_slip" class="btn btn-info">Update</button>
              </form>
              </div>
            </div>
          </div>
        </div>

        <!-- Delete Fuel Slip -->
        <div class="modal fade" id="delete_slip" tabindex="-1" role="dialog" aria-labelledby="deleteslipModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-bold text-gray-800" id="deleteslipModalLabel">Delete Fuel Slip</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="delete_truck_form" action="crud_truck.php" method="POST">
                        <div class="modal-body">
                            <p>Are you sure you want to delete the slip for <span class="text-info font-weight-bold mx-auto" id="delete_fuelType"></span> with an amount of <span class="text-info font-weight-bold mx-auto" id="delete_fuelAmount"></span> pesos?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" id="confirm_delete_btn" class="btn btn-danger">Delete</button>
                            <input type="hidden" id="delete_slip_id" name="delete_slip_id">
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
                                    <th style="text-align: center;">Vehicle/ Equipment</th>
                                    <th style="text-align: center;">Driver</th>
                                    <th style="text-align: center;">Plate Number</th>
                                    <th style="text-align: center;">Fuel Type</th>
                                    <th style="text-align: center;">Amount</th>
                                    <th style="text-align: center;">Status</th>
                                    <th style="text-align: center;">Date Created</th>
                                    <th class="no-export" width="12%" style="text-align: center;">Actions</th>
                                    <th class="no-export" style="text-align: center;">Fuel Slip</th>
                                  </tr>
                                </thead>
                                <tfoot class='thead-light text-gray-700'>
                                  <tr style="text-align:center">
                                    <th style="text-align: center;">No.</th>
                                    <th style="text-align: center;">Vehicle/ Equipment</th>
                                    <th style="text-align: center;">Driver</th>
                                    <th style="text-align: center;">Plate Number</th>
                                    <th style="text-align: center;">Fuel Type</th>
                                    <th style="text-align: center;">Amount</th>
                                    <th style="text-align: center;">Status</th>
                                    <th style="text-align: center;">Date Created</th>
                                    <th class="no-export" width="12%" style="text-align: center;">Actions</th>
                                    <th class="no-export" style="text-align: center;">Fuel Slip</th>
                                  </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $query = "SELECT fuel_slips.*, drivers.firstName, drivers.middleName, drivers.lastName, garbage_trucks.plateNumber
                                              FROM fuel_slips
                                              LEFT JOIN drivers ON fuel_slips.driver_id = drivers.id
                                              LEFT JOIN garbage_trucks ON fuel_slips.truck_id = garbage_trucks.id
                                              ORDER BY fuel_slips.dateCreated DESC";

                                    $query_run = mysqli_query($conn, $query);

                                    if (mysqli_num_rows($query_run) > 0) {
                                        foreach ($query_run as $row) {
                                            ?>
                                            <tr style="text-align:center">
                                                <td><?php echo $no; ?></td>
                                                <td><?= $row['vehicle'] ?: '-'; ?></td>
                                                <?php
                                                $firstName = $row['firstName'];
                                                $middleName = $row['middleName'];
                                                $lastName = $row['lastName'];

                                                if ($firstName && $middleName) {
                                                    $formattedName = ucwords($firstName) . ' ' . strtoupper(substr($middleName, 0, 1)) . '.' . ' ' . ucwords($lastName);
                                                } elseif ($firstName) {
                                                    $formattedName = ucwords($firstName) . ' ' . ucwords($lastName);
                                                } else {
                                                    $formattedName = '-';
                                                }
                                                ?>
                                                <td><?= $formattedName; ?></td></td>
                                                <td><?= $row['plateNumber'] ?: '-'; ?></td>
                                                <td><?= $row['fuelType'] ?: '-'; ?></td>
                                                <td><?= $row['fuelAmount'] ?: '-'; ?></td>
                                                <td>
                                                    <?php
                                                        $status = $row['status'];
                                                        if (!empty($status)) {
                                                            $badge_color = '';
                                                            switch ($status) {
                                                                case 'Issued':
                                                                    $badge_color = 'primary';
                                                                    break;
                                                                case 'Accepted':
                                                                    $badge_color = 'success';
                                                                    break;
                                                                case 'Cancelled':
                                                                    $badge_color = 'danger';
                                                                    break;
                                                                case 'Rejected':
                                                                    $badge_color = 'warning';
                                                                    break;
                                                                default:
                                                                    $badge_color = 'secondary';
                                                            }
                                                            ?>
                                                            <span class="badge badge-<?php echo $badge_color; ?>">
                                                                <?php echo $status; ?>
                                                            </span>
                                                            <?php
                                                        } else {
                                                            echo '-';
                                                        }
                                                    ?>
                                                </td>
                                                <?php
                                                $dateCreated = $row['dateCreated'];
                                                $formattedDateCreated = !empty(trim($dateCreated)) ? date('m/d/Y h:i A', strtotime($dateCreated)) : '-';
                                                ?>
                                                <td><?= $formattedDateCreated; ?></td>
                                                <td>
                                                <div class="dropdown">
                                                  <button class="btn btn-sm btn-outline-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Actions
                                                  </button> 
                                                  <div class="dropdown-menu text-info pr-0" aria-labelledby="dropdownMenuButton">
                                                    <?php
                                                    $status = $row['status']; // Assuming the $row['status'] contains the status value.
                                                    ?>
                                                    <?php if ($status === 'Issued' || $status === 'Cancelled') { ?>
                                                    <button class="dropdown-item edit-slip-btn" data-toggle="modal"
                                                        data-target="#edit_slip"
                                                        data-id="<?= $row['id']; ?>"
                                                        data-driver-id="<?= $row['driver_id']; ?>"
                                                        data-staff-id="<?= $row['staff_id']; ?>"
                                                        data-truck-id="<?= $row['truck_id']; ?>"
                                                        data-vehicle="<?= $row['vehicle']; ?>"
                                                        data-fuel-type="<?= $row['fuelType']; ?>"
                                                        data-fuel-amount="<?= $row['fuelAmount']; ?>"
                                                        data-status="<?= $row['status']; ?>"
                                                        data-toggle="tooltip"
                                                        title="Edit fuel slip for <?= $row['fuelType']; ?>!"
                                                        data-placement="top">
                                                        <i class="fa fa-edit fw-fa text-primary" aria-hidden="true"></i> Edit
                                                    </button>
                                                    <?php } ?>
                                                    <button class="dropdown-item delete-slip-btn" data-toggle="modal" 
                                                        data-target="#delete_slip" 
                                                        data-id="<?= $row['id']; ?>" 
                                                        data-fuel-type="<?= $row['fuelType']; ?>"
                                                        data-fuel-amount="<?= $row['fuelAmount']; ?>" 
                                                        data-toggle="tooltip" 
                                                        title="Delete fuel slip for <?= $row['fuelType']; ?>!" 
                                                        data-placement="top">
                                                        <i class="fa fa-trash fw-fa text-danger" aria-hidden="true"></i> Delete
                                                    </button>
                                                  </div>
                                                </div>
                                                </td>
                                                <td>
                                                    <div id="qrcode-container" style="display: none;"></div>
                                                        <button onclick="generateQRCode('<?= $row['id']; ?>', '<?= $row['dateCreated']; ?>', '<?= $row['fuelType']; ?>', '<?= $row['fuelAmount']; ?>', '<?= $row['vehicle']; ?>', '<?= $row['plateNumber']; ?>')" class="btn btn-sm btn-outline-info" data-toggle="tooltip" title="Generate QR Code" data-placement="top">
                                                            <i class="fa fa-qrcode" aria-hidden="true"></i> <!-- Font Awesome 4 QR Code icon -->
                                                        </button>

                                                        <button type="button" onclick="printRowInfo(
                                                            <?= $row['id']; ?>,
                                                            '<?= $row['dateCreated']; ?>',
                                                            '<?= $row['fuelType']; ?>',
                                                            '<?= $row['fuelAmount']; ?>',
                                                            '<?= $row['vehicle']; ?>',
                                                            '<?= $row['plateNumber']; ?>'
                                                        )" name="submit" style="width: 35px;" class="btn btn-sm btn-outline-info" data-toggle="tooltip" title="Print fuel slip for <?= $row['fuelType']; ?>!" data-placement="top">
                                                            <i class="fa fa-print fw-fa" aria-hidden="true"></i>
                                                        </button>
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
function initializeDataTable(tableId) {
    $('#' + tableId).DataTable({
        dom: '<"dt-buttons"B>frtip',
        buttons: [
            {
                extend: 'collection',
                className: 'custom-html-collection',
                text: 'Options',
                buttons: [
                    '<h3>Export</h3>',
                    'copy',
                    {
                        extend: 'csv',
                        className: 'no-export',
                        exportOptions: {
                            columns: ':not(.no-export)' // Exclude columns with the class "no-export"
                        }
                    },
                    {
                        extend: 'excel',
                        className: 'no-export',
                        exportOptions: {
                            columns: ':not(.no-export)' // Exclude columns with the class "no-export"
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        className: 'no-export',
                        exportOptions: {
                            columns: ':not(.no-export)' // Exclude columns with the class "no-export"
                        },
                        title: '' // Remove the title
                    },
                    {
                        extend: 'print',
                        className: 'no-export',
                        message: '<img src="../images/icon.png" height="80px" width="100px" style="position: absolute;top:30px;left:200px;"><center><br><br><h5 style="margin-top:-40px;font-style: italic;">Republic of the Philippines</h5><h5>Province of Batangas</h5><h4 style="font-weight: bold;">MUNICIPALITY OF LIAN</h4><br><br><br><h2 style="font-weight: bold;">OFFICE OF THE MUNICIPAL ENVIRONMENT & NATURAL RESOURCES OFFICER</h2></center><br><br><br>',
                        exportOptions: {
                            columns: ':not(.no-export)' // Exclude columns with the class "no-export"
                        },
                        title: '', // Remove the title
                        customize: function (win) {
                            $(win.document.body).find('table')
                                .append('<br><br><br><br><br><h4 class="">Noted by:</h4><br><br><br><br><br><h4 class="">Prepared by:</h4>');
                        }
                    },
                    '<h3 class="not-top-heading">Column Visibility</h3>',
                    'colvis' // Add 'colvis' button for column visibility
                ]
            },
            'pageLength'
        ],
        lengthMenu: [
            [10, 25, 50, -1],
            ['10 rows', '25 rows', '50 rows', 'Show all']
        ],
        stateSave: true // Enable state saving
    });
}

$(document).ready(function () {
    initializeDataTable('issuedGasolineTable');
    initializeDataTable('purchasedGasolineTable');
    initializeDataTable('usedGasolineTable');
});
</script>

<script>
    $(document).ready(function() {
        $('.edit-slip-btn').click(function() {
            var slipId = $(this).data('id');
            var driver_id = $(this).data('driver-id');
            var staff_id = $(this).data('staff-id');
            var truck_id = $(this).data('truck-id');
            var vehicle = $(this).data('vehicle');
            var fuelType = $(this).data('fuel-type');
            var fuelAmount = $(this).data('fuel-amount');
            var status = $(this).data('status');

            $('#edit_slip_id').val(slipId);
            $('#edit_driver_id').val(driver_id);
            $('#edit_staff_id').val(staff_id);
            $('#edit_truck_id').val(truck_id);
            $('#edit_vehicle').val(vehicle);
            $('#edit_fuelType').val(fuelType); // Ensure the IDs match in the HTML and JavaScript code
            $('#edit_fuelAmount').val(fuelAmount); // Ensure the IDs match in the HTML and JavaScript code
            
            // Assuming there's an input field with id "edit_status"
            var statusSelect = $('#edit_status');
            var status = $(this).data('status');

            // Hide all options first
            statusSelect.find('option').hide();

            // Show only "Issued" and "Cancelled" options
            statusSelect.find('option[value="Issued"], option[value="Cancelled"]').show();

            // Set the selected value
            statusSelect.val(status);

            // Enable or disable the status input based on the selected value
            if (status === 'Issued' || status === 'Cancelled') {
                statusSelect.prop('disabled', false);
            } else {
                statusSelect.prop('disabled', true);
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('.delete-slip-btn').click(function() {
            var slipId = $(this).data('id');
            var fuelType = $(this).data('fuel-type');
            var fuelAmount = $(this).data('fuel-amount');

            $('#delete_slip_id').val(slipId);
            $('#delete_fuelType').text(fuelType);
            $('#delete_fuelAmount').text(fuelAmount);
        });

        $('#delete_truck_form').submit(function(e) {
            e.preventDefault();
            var slipId = $('#delete_slip_id').val();
            $.ajax({
                type: "POST",
                url: "crud_fuelslip.php",
                data: {
                    delete_slip_id: slipId
                },
                success: function(response) {
                    console.log("Delete response:", response);

                    // Hide the deleted row from the table
                    $('#row_' + slipId).hide();

                    // Show a success message with SweetAlert2 toast
                    Swal.fire({
                        icon: 'success',
                        title: 'Deleted!',
                        text: 'The fuel slip has been deleted successfully.',
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
<script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
<script>
    function printRowInfo(rowId, dateCreated, fuelType, fuelAmount, vehicle, plateNumber) {
        // Example of creating a printable content with CSS styles
        var printableContent = `
            <style>
                @page {
                    size: A4;
                    margin: 0;
                }
                /* Add a border to the content area */
                body {
                    padding: 5mm;
                }
                /* Content inside the border */
                .content {
                    border: 1px solid black;
                    padding: 4mm;
                }
                /* Header with two logos */
                header {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                }
                /* Customize logo styles */
                .logo {
                    max-height: 50px;
                }
            </style>
            <div class="content">
                <h1>Fuel Slip Information</h1>
                <img src="../images/truck.png" class="card-img-top img-fluid mx-auto d-block image-animated" alt="..." style="max-width: 100%; height: 40px;">
                <img src="../images/truck.png" class="card-img-top img-fluid mx-auto d-block image-animated" alt="..." style="max-width: 100%; height: 40px;">
                <p>Row ID: ${rowId}</p>
                <p>Date Created: ${dateCreated}</p>
                <p>Fuel Type: ${fuelType}</p>
                <p>Fuel Amount: ${fuelAmount}</p>
                <p>Vehicle: ${vehicle}</p>
                <p>Plate Number: ${plateNumber}</p>
                <!-- Add other information here -->
            </div>`;

        // Create a new window for printing
        var printWindow = window.open('', '_blank');
            printWindow.document.open();
            printWindow.document.write(printableContent);
            printWindow.document.close();

            // Delay the print action for 500 milliseconds (adjust as needed)
            setTimeout(function () {
                // Print the content
                printWindow.print();
                // Close the print window after printing (optional)
                printWindow.close();
            }, 500);
    }
</script>

<script>
    function generateQRCode(rowId, dateCreated, fuelType, fuelAmount, vehicle, plateNumber) {
        // Concatenate the values into a single string
        var qrCodeContent = "Date Created: " + dateCreated
            + "\nFuel Type: " + fuelType
            + "\nFuel Amount: " + fuelAmount
            + "\nVehicle: " + vehicle
            + "\nPlate Number: " + plateNumber;

        // Clear the previous QR code, if any
        document.getElementById("qrcode-container").innerHTML = '';

        // Generate the QR code as a data URI
        var qrcode = new QRCode(document.getElementById("qrcode-container"), {
            text: qrCodeContent,
            width: 128,
            height: 128,
            colorDark: "#000000",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.M
        });

        // Wait for the QR code to be fully generated
        setTimeout(function() {
            // Get the data URI of the generated QR code
            var qrCodeDataURI = document.getElementById("qrcode-container").getElementsByTagName("img")[0].src;

            // Show the SweetAlert dialog with the QR code and custom message
            Swal.fire({
                html: '<img src="' + qrCodeDataURI + '" alt="QR Code" style="width: 200px; height: 200px;">',
                title: 'Scan QR Code',
                showCloseButton: true,
                showConfirmButton: false,
                customClass: {
                    popup: 'my-sweetalert',
                }
            });
        }, 100);
    }
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
