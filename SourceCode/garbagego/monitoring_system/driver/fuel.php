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

    <?php include('message.php'); ?>
    <?php include('message_danger.php'); ?>

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


</script>

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
                                <a href="#add_truck" data-toggle="modal"
                                    class="btn btn-sm btn-info shadow-sm"><i
                                        class="fa fa-plus fa-sm text-white mr-1"></i>Add Garbage Truck</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <!-- Issued Gasoline Table -->
                                <table id="issuedGasolineTable" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Date</th>
                                            <th>Driver</th>
                                            <th>Amount (Liters)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Populate with data -->
                                        <tr>
                                            <td>1</td>
                                            <td>2023-07-10</td>
                                            <td>John Doe</td>
                                            <td>50</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>2023-07-09</td>
                                            <td>Jane Smith</td>
                                            <td>40</td>
                                        </tr>
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
                                <table id="purchasedGasolineTable" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Date</th>
                                            <th>Supplier</th>
                                            <th>Amount (Liters)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Populate with data -->
                                        <tr>
                                            <td>1</td>
                                            <td>2023-07-08</td>
                                            <td>ABC Supplier</td>
                                            <td>1000</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>2023-07-05</td>
                                            <td>XYZ Supplier</td>
                                            <td>800</td>
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

<!-- End of Page Content -->
<?php
include('../includes/scripts.php');
include('../includes/footer.php');
} else {
    header("Location: ../login.php");
    exit();
}
?>
