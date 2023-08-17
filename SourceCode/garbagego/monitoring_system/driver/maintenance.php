<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['user_name']) && isset($_SESSION['role']) && $_SESSION['role'] == 'driver') {

include('../includes/header.php');
include('../includes/navbar_driver.php');
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
                <li class="breadcrumb-item active text-gray-900" aria-current="page">Maintenance</li>
            </ol>
        </nav>
        <a href="" class="btn btn-sm btn-info shadow-sm mb-3"><i
                class="fas fa-download fa-sm text-white"></i> Generate Report</a>
    </div>

    <?php include('message.php'); ?>
    <?php include('message_danger.php'); ?>

    <div class="row">
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
                    <a class="nav-item nav-link active" id="nav-request-tab" data-toggle="tab" href="#nav-request"
                        role="tab" aria-controls="nav-request" aria-selected="true">Request for Repair/Servicing</a>
                    <a class="nav-item nav-link" id="nav-orderForm-tab" data-toggle="tab" href="#nav-orderForm"
                        role="tab" aria-controls="nav-orderForm" aria-selected="false">Maintenance Work Order Form</a>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <!-- Request for Repair/Servicing -->
                <div class="tab-pane fade show active" id="nav-request" role="tabpanel"
                    aria-labelledby="nav-request-tab">

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
                                <table id="RepairServicingTable" class="display nowrap table table-bordered table-hover">
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
                <!-- Request for Repair/Servicing end -->

                <!-- Maintenance Work Order Form -->
                <div class="tab-pane fade" id="nav-orderForm" role="tabpanel"
                    aria-labelledby="nav-orderForm-tab">

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
                                <table id="WorkOrderFormTable" class="display nowrap table table-bordered table-hover">
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
                <!-- Maintenance Work Order Form end-->
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
    $('#RepairServicingTable').DataTable({
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

    $('#WorkOrderFormTable').DataTable({
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
