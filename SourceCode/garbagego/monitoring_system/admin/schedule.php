<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['user_name']) && isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {

include('../includes/header.php');
include('../includes/navbar_admin.php');
require '../db_conn.php';
?>

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>

<style>
    .fc-title {
        color: #000; /* Set the text color to black */
    }
</style>
<script>
    $(document).ready(function() {
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            defaultDate: moment().format('YYYY-MM-DD'),

            events: function(start, end, timezone, callback) {
                var events = [];

                // Get the selected start and end dates
                var startDate = moment(start).format('YYYY-MM-DD');
                var endDate = moment(end).format('YYYY-MM-DD');

                // Generate events dynamically based on the selected dates
                var currentDate = moment(startDate);
                while (currentDate.isSameOrBefore(endDate)) {
                    var dayOfWeek = currentDate.format('dddd');
                    var event = {
                        title: '', // Empty title
                        start: currentDate.format('YYYY-MM-DD'),
                        day: dayOfWeek,
                        location: 'Main Street', // Location instead of title
                        driver: 'John Doe'
                    };
                    events.push(event);
                    currentDate.add(1, 'day');
                }

                callback(events);
            },
            eventRender: function(event, element) {
                // Customize event rendering
                element.css('background-color', getColor(event.day));
                element.find('.fc-title').text(event.location); // Display location

                // Example: Display day, location, and driver as tooltip
                var tooltip = "Day: " + event.day + "<br>" +
                              "Location: " + event.location + "<br>" +
                              "Driver: " + event.driver;
                element.attr('title', tooltip);
            }
        });

        // Function to assign pastel colors to each day
        function getColor(day) {
            switch (day) {
                case 'Monday':
                    return '#FFC8C8'; // Light Red
                case 'Tuesday':
                    return '#C8FFC8'; // Light Green
                case 'Wednesday':
                    return '#C8C8FF'; // Light Blue
                case 'Thursday':
                    return '#FFFFC8'; // Light Yellow
                case 'Friday':
                    return '#FFC8FF'; // Light Magenta
                case 'Saturday':
                    return '#C8FFFF'; // Light Cyan
                case 'Sunday':
                    return '#FFD8A5'; // Light Orange
                default:
                    return '#EEEEEE'; // Light Grey (fallback)
            }
        }
    });
</script>

<!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-1 mt-1">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0">
                    <li class="breadcrumb-item"><a href="admin_dashboard.php" class="text-secondary" style="color: #026601; text-decoration: none;">Dashboard</a></li>
                    <li class="breadcrumb-item"><span class="text-gray-700">Waste Collections</span></li>
                    <li class="breadcrumb-item active text-gray-900" aria-current="page">Schedules</li>
                </ol>
            </nav>
            <a href="" class="btn btn-sm btn-info shadow-sm mb-3"><i class="fas fa-download fa-sm text-white"></i> Generate Report</a>
        </div>

        <?php include('message.php'); ?>
        <?php include('message_danger.php'); ?>

        <div class="row">
            <div class="col-md-6">
                <!-- DataTables Start-->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-sm-flex align-items-center justify-content-between py-2">
                    <h6 class="m-0 font-weight-bold text-info">Garbage Collection Schedule</h6>
                    <a href="#add_driver" data-toggle="modal" class="btn btn-sm btn-info shadow-sm"><i class="fa fa-plus fa-sm text-white mr-1"></i>Add Schedule</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="display nowrap table table-bordered table-hover" style="width:100%;">
                        <thead class='thead-light text-gray-900'>
                          <tr style="text-align:center">
                            <th style="text-align: center;">Day</th>
                            <th style="text-align: center;">Location</th>
                            <th style="text-align: center;">Driver</th>
                            <th class="no-export" width="12%" style="text-align: center;">Actions</th>
                          </tr>
                        </thead>
                        <tfoot class='thead-light text-gray-700'>
                          <tr style="text-align:center">
                            <th style="text-align: center;">Day</th>
                            <th style="text-align: center;">Location</th>
                            <th style="text-align: center;">Driver</th>
                            <th class="no-export" width="12%" style="text-align: center;">Actions</th>                          </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            $no = 1;
                            $query = "SELECT * FROM drivers";
                            $query_run = mysqli_query($conn, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                foreach ($query_run as $row) {
                                    ?>
                                    <tr style="text-align:center">
                                        <td><?= $row['gender'] ?: '-'; ?></td>
                                        <td><?= $row['phone'] ?: '-'; ?></td>
                                        <td><?= $row['email'] ?: '-'; ?></td>
                                        <td>
                                        <div class="dropdown">
                                          <button class="btn btn-sm btn-outline-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Actions
                                          </button>
                                          <div class="dropdown-menu text-info pr-0" aria-labelledby="dropdownMenuButton">
                                            <button class="dropdown-item edit-driver-btn" data-toggle="modal" 
                                            data-target="#edit_driver" 
                                            data-id="<?= $row['id']; ?>" 
                                            data-firstName="<?= $row['firstName']; ?>" 
                                            data-lastName="<?= $row['lastName']; ?>" 
                                            data-middleName="<?= $row['middleName']; ?>" 
                                            data-position="<?= $row['position']; ?>" 
                                            data-birthday="<?= $row['birthday']; ?>" 
                                            data-gender="<?= $row['gender']; ?>" 
                                            data-phone="<?= $row['phone']; ?>" 
                                            data-email="<?= $row['email']; ?>" 
                                            data-province="<?= $row['province']; ?>" 
                                            data-city="<?= $row['city']; ?>" 
                                            data-barangay="<?= $row['barangay']; ?>" 
                                            data-street="<?= $row['street']; ?>" 
                                            data-toggle="tooltip" 
                                            title="Edit <?= $row['firstName']; ?> <?= $row['lastName']; ?>!" 
                                            data-placement="top">
                                              <i class="fa fa-edit fw-fa text-primary" aria-hidden="true"></i> Edit
                                            </button>

                                            <button class="dropdown-item delete-driver-btn" data-toggle="modal" 
                                            data-target="#delete_driver" 
                                            data-id="<?= $row['id']; ?>" 
                                            data-firstName="<?= $row['firstName']; ?>"
                                            data-lastName="<?= $row['lastName']; ?>"
                                            data-middleName="<?= $row['middleName']; ?>" 
                                            data-toggle="tooltip" 
                                            title="Delete <?= $row['firstName']; ?> <?= $row['lastName']; ?>!" 
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
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body text-dark">
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>

<?php
include('../includes/footer.php');
include('../includes/scripts.php');
} else {
header("Location: ../login.php");
exit();
}
?>

