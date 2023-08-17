<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['user_name']) && isset($_SESSION['role']) && $_SESSION['role'] == 'driver') {

include('../includes/header.php');
include('../includes/navbar_driver.php');
require '../db_conn.php';
?>

<?php
function calculateTankBalance($initialBalance, $kilometersDriven, $fuelEfficiency) {
    // Calculate fuel consumption
    $fuelConsumption = $kilometersDriven / $fuelEfficiency;

    // Subtract fuel consumption from initial balance
    $updatedBalance = $initialBalance - $fuelConsumption;

    // Return the updated tank balance
    return $updatedBalance;
}
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

    <div class="row">
        <div class="col-lg-4">
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Fuel Consumption</h5>
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve form inputs
            $initialBalance = $_POST['initialBalance'];
            $kilometersDriven = $_POST['kilometersDriven'];
            $fuelEfficiency = $_POST['fuelEfficiency'];

            // Calculate tank balance using the function
            $updatedBalance = calculateTankBalance($initialBalance, $kilometersDriven, $fuelEfficiency);

            // Calculate the percentage of tank balance remaining
            $percentageRemaining = ($updatedBalance / $initialBalance) * 100;

            // Display the updated tank balance with progress bar
            echo "<h6>Tank Balance: {$updatedBalance} liters</h6>";
            echo '<div class="progress">';
            echo '<div class="progress-bar" role="progressbar" style="width: ' . $percentageRemaining . '%" aria-valuenow="' . $percentageRemaining . '" aria-valuemin="0" aria-valuemax="100">' . $percentageRemaining . '%</div>';
            echo '</div>';
        }
        ?>
        <form method="POST" action="" >
        <div class="form-row mt-3">
            <div class="form-group mt-2 col-md-12">
                <input type="number" class="form-control" id="initialBalance" name="initialBalance" placeholder=" " required>
                <label for="initialBalance">Initial Tank Balance (liters)</label>
            </div>
            <div class="form-group mt-2 col-md-12">
                <input type="date" class="form-control" id="lastPurchaseDate" placeholder=" ">
                <label for="lastPurchaseDate" class="text-gray"> Last Date Purchased:</label>
            </div>
            <div class="form-group mt-2 col-md-12">
                <input type="number" class="form-control" id="kilometersDriven" name="kilometersDriven" placeholder=" " required>
                <label for="kilometersDriven">Kilometers Driven</label>
            </div>
            <div class="form-group mt-2 col-md-12">
                <input type="number" step="0.01" class="form-control" id="fuelEfficiency" name="fuelEfficiency" placeholder=" " required>
                <label for="fuelEfficiency">Fuel Efficiency (L/km) for Garbage Trucks</label>
            </div>
        </div>
    <button type="submit" class="btn btn-outline-info">Request Fuel Slip</button>
    </form>
     </div>
</div>


        </div>
        <div class="col-lg-8">

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
                                <h6 class="m-0 font-weight-bold text-info">List of Issued Gasoline</h6>
                                <!-- <a href="#add_truck" data-toggle="modal"
                                    class="btn btn-sm btn-info shadow-sm"><i
                                        class="fa fa-plus fa-sm text-white mr-1"></i>Add Garbage Truck</a> -->
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <!-- Issued Gasoline Table -->
                                <table id="issuedGasolineTable" class="display nowrap table table-bordered table-hover" style="width:100%;">
                                <thead class='thead-light text-gray-900'>
                                  <tr style="text-align:center">
                                    <th style="text-align: center;">No.</th>
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
                                    $driver_id = (isset($_SESSION['id']) && is_numeric($_SESSION['id'])) ? $_SESSION['id'] : 0;

                                    $query = "SELECT fuel_slips.*, drivers.firstName, drivers.middleName, drivers.lastName, garbage_trucks.plateNumber
                                              FROM fuel_slips
                                              LEFT JOIN drivers ON fuel_slips.driver_id = drivers.id
                                              LEFT JOIN garbage_trucks ON fuel_slips.truck_id = garbage_trucks.id
                                              WHERE fuel_slips.driver_id = $driver_id
                                              ORDER BY fuel_slips.dateCreated DESC";

                                    $query_run = mysqli_query($conn, $query);

                                    if (mysqli_num_rows($query_run) > 0) {
                                        foreach ($query_run as $row) {
                                            ?>
                                            <tr style="text-align:center">
                                                <td><?php echo $no; ?></td>
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
                                                    <?php
                                                    $status = $row['status']; // Assuming the $row['status'] contains the status value.
                                                    ?>
                                                <div class="row d-inline-flex">
                                                    <?php if ($status === 'Rejected' || $status === 'Issued') { ?>
                                                        <form action="crud_fuelslip.php" method="post">
                                                            <input type="hidden" name="fuel_slip_id" value="<?= $row['id']; ?>">
                                                            <input type="hidden" name="status" value="Accepted">
                                                            <button type="submit" name="submit" style="width: 35px;" class="btn btn-sm btn-outline-success" data-toggle="tooltip" title="Accept fuel slip for <?= $row['fuelType']; ?>!" data-placement="top"><i class="fa fa-check fw-fa" aria-hidden="true"></i></button>
                                                        </form>
                                                    <?php } elseif ($status === 'Accepted') { ?>
                                                        <form action="crud_fuelslip.php" method="post">
                                                            <input type="hidden" name="fuel_slip_id" value="<?= $row['id']; ?>">
                                                            <input type="hidden" name="status" value="Rejected">
                                                            <button type="submit" name="submit" style="width: 35px;" class="btn btn-sm btn-outline-danger" data-toggle="tooltip" title="Reject fuel slip for <?= $row['fuelType']; ?>!" data-placement="top"><i class="fa fa-times fw-fa" aria-hidden="true"></i></button>
                                                        </form>
                                                    <?php } elseif ($status === 'Cancelled' || $status === 'Used') { ?>
                                                        <button type="button" style="width: 35px;" class="btn btn-sm btn-outline-secondary" data-toggle="tooltip" title="Fuel slip is <?= $status === 'Used' ? 'Used' : 'Cancelled'; ?>" data-placement="top" disabled><i class="fa fa-ban fw-fa" aria-hidden="true"></i></button>
                                                    <?php } ?>
                                                    
                                                </div>
                                                </td>
                                                <td>
                                                    <div id="qrcode-container" style="display: none;"></div>

                                                    <?php if ($status === 'Accepted') { ?>
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
                                                    <?php } else { ?>
                                                        <!-- Disabled print button -->
                                                        <button type="button" disabled class="btn btn-sm btn-outline-secondary" style="width: 35px;" data-toggle="tooltip" title="Print button disabled because status is not Accepted!" data-placement="top">
                                                            <i class="fa fa-qrcode fw-fa" aria-hidden="true"></i>
                                                        </button>
                                                        <button type="button" disabled class="btn btn-sm btn-outline-secondary" style="width: 35px;" data-toggle="tooltip" title="Print button disabled because status is not Accepted!" data-placement="top">
                                                            <i class="fa fa-print fw-fa" aria-hidden="true"></i>
                                                        </button>
                                                    <?php } ?>
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
                                <h6 class="m-0 font-weight-bold text-info">List of purchased gasoline</h6>
                                <a href="#add_truck" data-toggle="modal"
                                    class="btn btn-sm btn-info shadow-sm"><i
                                        class="fa fa-plus fa-sm text-white mr-1"></i>Add Garbage Truck</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <!-- Purchased Gasoline Table -->
                                <table id="purchasedGasolineTable" class="display nowrap table table-bordered table-hover" style="width:100%;">
                                <thead class='thead-light text-gray-900'>
                                  <tr style="text-align:center">
                                    <th style="text-align: center;">No.</th>
                                    <th style="text-align: center;">Fuel Type</th>
                                    <th style="text-align: center;">Amount</th>
                                    <th style="text-align: center;">Date Created</th>
                                    <th class="no-export" width="12%" style="text-align: center;">Actions</th>
                                  </tr>
                                </thead>
                                <tfoot class='thead-light text-gray-700'>
                                  <tr style="text-align:center">
                                    <th style="text-align: center;">No.</th>
                                    <th style="text-align: center;">Fuel Type</th>
                                    <th style="text-align: center;">Amount</th>
                                    <th style="text-align: center;">Date Created</th>
                                    <th class="no-export" width="12%" style="text-align: center;">Actions</th>
                                  </tr>
                                </tfoot>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $driver_id = (isset($_SESSION['id']) && is_numeric($_SESSION['id'])) ? $_SESSION['id'] : 0;

                                    $query = "SELECT fuel_slips.*, drivers.firstName, drivers.middleName, drivers.lastName, garbage_trucks.plateNumber
                                              FROM fuel_slips
                                              LEFT JOIN drivers ON fuel_slips.driver_id = drivers.id
                                              LEFT JOIN garbage_trucks ON fuel_slips.truck_id = garbage_trucks.id
                                              WHERE fuel_slips.driver_id = $driver_id
                                              ORDER BY fuel_slips.dateCreated DESC";

                                    $query_run = mysqli_query($conn, $query);

                                    if (mysqli_num_rows($query_run) > 0) {
                                        foreach ($query_run as $row) {
                                            ?>
                                            <tr style="text-align:center">
                                                <td><?php echo $no; ?></td>
                                                <td><?= $row['fuelType'] ?: '-'; ?></td>
                                                <td><?= $row['fuelAmount'] ?: '-'; ?></td>
                                                <?php
                                                $dateCreated = $row['dateCreated'];
                                                $formattedDateCreated = !empty(trim($dateCreated)) ? date('m/d/Y h:i A', strtotime($dateCreated)) : '-';
                                                ?>
                                                <td><?= $formattedDateCreated; ?></td>
                                                <td>
                                                    <?php
                                                    $status = $row['status']; // Assuming the $row['status'] contains the status value.
                                                    ?>
                                                <div class="row d-inline-flex">
                                                    <?php if ($status === 'Rejected' || $status === 'Issued') { ?>
                                                        <form action="crud_fuelslip.php" method="post">
                                                            <input type="hidden" name="fuel_slip_id" value="<?= $row['id']; ?>">
                                                            <input type="hidden" name="status" value="Accepted">
                                                            <button type="submit" name="submit" style="width: 35px;" class="btn btn-sm btn-outline-success" data-toggle="tooltip" title="Accept fuel slip for <?= $row['fuelType']; ?>!" data-placement="top"><i class="fa fa-check fw-fa" aria-hidden="true"></i></button>
                                                        </form>
                                                    <?php } elseif ($status === 'Accepted') { ?>
                                                        <form action="crud_fuelslip.php" method="post">
                                                            <input type="hidden" name="fuel_slip_id" value="<?= $row['id']; ?>">
                                                            <input type="hidden" name="status" value="Rejected">
                                                            <button type="submit" name="submit" style="width: 35px;" class="btn btn-sm btn-outline-danger" data-toggle="tooltip" title="Reject fuel slip for <?= $row['fuelType']; ?>!" data-placement="top"><i class="fa fa-times fw-fa" aria-hidden="true"></i></button>
                                                        </form>
                                                    <?php } elseif ($status === 'Cancelled' || $status === 'Used') { ?>
                                                        <button type="button" style="width: 35px;" class="btn btn-sm btn-outline-secondary" data-toggle="tooltip" title="Fuel slip is <?= $status === 'Used' ? 'Used' : 'Cancelled'; ?>" data-placement="top" disabled><i class="fa fa-ban fw-fa" aria-hidden="true"></i></button>
                                                    <?php } ?>
                                                    
                                                </div>
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
                    <!-- DataTables End -->
                </div>
                <!-- Purchased end-->
                <!-- Used -->
                <div class="tab-pane fade" id="nav-used" role="tabpanel" aria-labelledby="nav-used-tab">
                    <!-- DataTables Start-->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="d-sm-flex align-items-center justify-content-between py-2">
                                <h6 class="m-0 font-weight-bold text-info">List of Used Gasoline</h6>
                                <a href="#add_truck" data-toggle="modal"
                                    class="btn btn-sm btn-info shadow-sm"><i
                                        class="fa fa-plus fa-sm text-white mr-1"></i>Add Garbage Truck</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <!-- Used Gasoline Table -->
                            <table id="usedGasolineTable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Date</th>
                                        <th>Vehicle</th>
                                        <th>Amount (Liters)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Populate with data -->
                                    <tr>
                                        <td>1</td>
                                        <td>2023-07-10</td>
                                        <td>Vehicle A</td>
                                        <td>20</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>2023-07-09</td>
                                        <td>Vehicle B</td>
                                        <td>30</td>
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
