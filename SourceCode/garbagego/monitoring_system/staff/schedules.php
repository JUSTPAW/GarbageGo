<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['user_name']) && isset($_SESSION['role']) && $_SESSION['role'] == 'staff') {

include('../includes/header.php');
include('../includes/navbar_staff.php');
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
                    right: 'month,agendaWeek,agendaDay,list'
                },
                defaultDate: moment().format('YYYY-MM-DD'),

                events: function(start, end, timezone, callback) {
                    var events = [];

                    // Calculate the start and end of the current week
                    var startDate = moment().startOf('week').format('YYYY-MM-DD');
                    var endDate = moment().endOf('week').format('YYYY-MM-DD');

                    // Generate events dynamically for the current week
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
                    <li class="breadcrumb-item"><a href="staff_dashboard.php" class="text-secondary" style="color: #026601; text-decoration: none;">Dashboard</a></li>
                    <li class="breadcrumb-item"><span class="text-gray-700">Waste Collections</span></li>
                    <li class="breadcrumb-item active text-gray-900" aria-current="page">Schedules</li>
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

        <div class="row">
            <div class="col-md-4">
                <!-- DataTables Start-->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-sm-flex align-items-center justify-content-between py-2">
                    <h6 class="m-0 font-weight-bold text-info">Garbage Collection Schedule</h6>
                </div>
            </div>
            <div class="card-body">
               <form action="save_schedule.php" method="POST" id="schedule-form">
                    <div class="form-row mt-2">
                    <input type="hidden" name="id" value="">
                    <div class="form-group col-md-12 mt-2">
                        <select class="form-control" id="day_of_week" name="day_of_week" required>
                            <option value=""></option>
                            <option value="Monday">Monday</option>
                            <option value="Tuesday">Tuesday</option>
                            <option value="Wednesday">Wednesday</option>
                            <option value="Thursday">Thursday</option>
                            <option value="Friday">Friday</option>
                            <option value="Saturday">Saturday</option>
                            <option value="Sunday">Sunday</option>
                        </select>
                        <label for="day_of_week" class="text-gray">Day</label>
                    </div>
                    <div class="form-group mt-2 col-md-12">
                        <select class="form-control" id="location_id" name="location_id" required>
                            <option value=""></option>
                            <?php
                            // Fetch driver data from the "drivers" table
                            $query_loc = "SELECT * FROM locations";
                            $query_run_loc = mysqli_query($conn, $query_loc);

                            if (mysqli_num_rows($query_run_loc) > 0) {
                                foreach ($query_run_loc as $driver) {
                                   
                                    echo '<option value="' . $driver['id'] . '">' . $driver['location'] . '</option>';
                                }
                            }
                            ?>
                        </select>
                        <label for="location_id" class="text-gray">Location</label>
                    </div>
                    <div class="form-group mt-2 col-md-12">
                        <select class="form-control" id="driver_id" name="driver_id" required>
                            <option value=""></option>
                            <?php
                            // Fetch driver data from the "drivers" table
                            $query_drivers = "SELECT * FROM drivers";
                            $query_run_drivers = mysqli_query($conn, $query_drivers);

                            if (mysqli_num_rows($query_run_drivers) > 0) {
                                foreach ($query_run_drivers as $driver) {
                                    $fullName = $driver['firstName'] . ' ';
                                    if (!empty($driver['middleName'])) {
                                        $fullName .= substr($driver['middleName'], 0, 1) . '. ';
                                    }
                                    $fullName .= $driver['lastName'];

                                    echo '<option value="' . $driver['id'] . '">' . $fullName . '</option>';
                                }
                            }
                            ?>
                        </select>
                        <label for="driver_id" class="text-gray">Driver</label>
                    </div>
                </div>
                    <div class="form-footer">
                        <div class="">
                            <button class="btn btn-primary btn-md rounded-0" type="submit" form="schedule-form">Save</button>
                            <button class="btn btn-secondary border btn-md rounded-0" type="reset" form="schedule-form">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
            </div>
            <div class="col-md-8">
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
