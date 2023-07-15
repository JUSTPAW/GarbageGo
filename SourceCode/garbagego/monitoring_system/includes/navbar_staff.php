<?php
require '../db_conn.php';
?>
<!-- Sidebar -->
<ul class="navbar-nav bg-info sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="staff_dashboard.php">
    <div class="mb-1 mr-1">
       <img src="../images/icon.jpg" class="card-img-top img-fluid mx-auto d-block image-animated rounded" alt="..." style="max-width: 100%; height: 40px;">
    </div>
    <div class="sidebar-brand-text text-white">
        MENRO LIAN
        <br>
        <sup>GARBAGEGO</sup>
       
    </div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="staff_dashboard.php">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Main Menu
    
</div>

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Employees"
        aria-expanded="true" aria-controls="Employees">
        <i class="fas fa-fw fa-users"></i>
        <span>Employees</span>
    </a>
    <div id="Employees" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Employees:</h6>
            <a class="collapse-item" href="drivers.php">Drivers</a>
            <a class="collapse-item" href="crew_members.php">Crew Members</a>
        </div>
    </div>
</li>
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Collections"
        aria-expanded="true" aria-controls="Collections">
        <i class="fas fa-fw fa-trash"></i>
        <span>Waste Collections</span>
    </a>
    <div id="Collections" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Waste Collections</h6>
            <a class="collapse-item" href="map.php">Map</a>
            <a class="collapse-item" href="schedule.php">Schedule</a>
            <a class="collapse-item" href="locations.php">Locations</a>
        </div>
    </div>
</li>
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Trucks"
        aria-expanded="true" aria-controls="Trucks">
        <i class="fas fa-fw fa-truck"></i>
        <span>Vehicles</span>
    </a>
    <div id="Trucks" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Vehicles</h6>
            <a class="collapse-item" href="garbage_trucks.php">Garbage Trucks</a>
            <a class="collapse-item" href="fuels.php">Fuel</a>
            <a class="collapse-item" href="maintenance.php">Maintenance</a>
        </div>
    </div>
</li>
<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

</li>
<!-- Heading -->
<div class="sidebar-heading">
    Others
</div>

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Documents"
        aria-expanded="true" aria-controls="Documents">
        <i class="fas fa-fw fa-file"></i>
        <span>Documents</span>
    </a>
    <div id="Documents" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Documents:</h6>
            <a class="collapse-item text-truncate" href="trip_ticket.php" data-toggle="tooltip" data-placement="top" title="Driver Trip Ticket">Driver Trip Ticket</a>
            <a class="collapse-item text-truncate" href="monitoring_report.php" data-toggle="tooltip" data-placement="top" title="Waste Collection Monitoring Report">Waste Collection Monitoring Report</a>
            <a class="collapse-item text-truncate" href="crew_members.php" data-toggle="tooltip" data-placement="top" title="Maintenance Work Order Form">Maintenance Work Order Form</a>
            <a class="collapse-item text-truncate" href="crew_members.php" data-toggle="tooltip" data-placement="top" title="Request For Repair/Servicing">Request For Repair/Servicing</a>
        </div>
    </div>
</li>
<!-- Nav Messages - Tables -->
<li class="nav-item">
    <a class="nav-link" href="chats.php">
        <i class="fas fa-fw fa-folder"></i>
        <span>Reports</span></a>
</li>


<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

<!-- Sidebar Message -->
<!-- <div class="sidebar-card d-none d-lg-flex">
    <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="...">
    <p class="text-center mb-2"><strong>Have some questions?</strong> </p>
    <a class="btn btn-secondary btn-sm" href="../index.html">Go to Homepage!</a>
</div> -->

</ul>
<!-- End of Sidebar -->

<!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-arrow-up fa-1x"></i>
    </a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-info" href="../../index.php">Logout</a>
                </div>
            </div>
        </div>
    </div>  

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column" >

<!-- Main Content -->
<div id="content">
    <!-- Topbar -->
    <nav class="navbar navbar-expand navbar-light bg-gray-200 topbar mb-4 static-top shadow  text-white">

        <!-- Sidebar Toggle (Topbar) -->
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars text-info"></i>
        </button>

  
        <!-- Topbar Search -->
        <form
            class="d-none d-sm-inline-block form-inline mr-auto ml-md-2 my-2 my-md-0 w-25 navbar-search">
            <div class="input-group">
                <input type="text" class="form-control bg-light border-0 small" id="search" onchange= "openPage()"
                 placeholder="Search on page..." aria-label="Search" aria-describedby="basic-addon2">
                
                <script>
                  function openPage(){
                    var x = document.getElementById("search").value.toLowerCase();

                    if (x === "due date"){
                      window.open("due_date.php");
                    }
                    if (x === "appointments"){
                      window.open("appointments.php");
                    }
                    if (x === "create appointments"){
                      window.open("appointments_create.php");
                    }
                    if (x === "select doctor"){
                      window.open("doctor_select.php");
                    }
                    if (x === "medical records"){
                      window.open("medical_records.php");
                    }
                  }
                </script>

                    <div class="input-group-append">
                    <button class="btn btn-info" type="button">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
        </form>

        <!-- Topbar Navbar -->
        <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
                <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-search fa-fw text-gray-600"></i>
                </a>
                <!-- Dropdown - Search -->
                <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                    aria-labelledby="searchDropdown">
                    <form class="form-inline mr-auto w-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small"
                                placeholder="Search for..." aria-label="Search"
                                aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-info" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </li>

            

<!-- Nav Item - Messages -->
<li class="nav-item dropdown no-arrow mx-1">
    <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
        data-toggle="tooltip" title="Click to view messages!" data-placement="top">
        <i class="fas fa-bell fa-fw text-gray-600"></i>
        <!-- Counter - Messages -->
<span class="badge badge-danger badge-counter" id="message-counter"> 
0
</span>
    </a>

    <!-- Dropdown - Messages -->
    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
        aria-labelledby="messagesDropdown">
        <h6 class="dropdown-header bg-info border-info">
            Messages
        </h6>


        <a class="dropdown-item d-flex align-items-center" href="chats.php?id=<?= $mes['id']; ?>" 
            data-toggle="tooltip" title="Click to view this message!" data-placement="top">
            <div class="dropdown-list-item mr-2">
                <!-- <img class="rounded-circle" src="img/signup.jpg"
                    alt="..."> -->
                
            </div>
            <div class="font-weight-bold">
                <div class="text-truncate"></div>
                <div class="small text-gray-500 text-truncate">
</div>
            </div>
        </a>

        <a class="dropdown-item text-center small text-gray-600" href="chats.php">Read More Messages</a>
        
    </div>
</li>






            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

            <span class="mr-2 mt-2 d-none d-lg-inline text-info small text-uppercase">
                <?php
                require '../db_conn.php';
                $user_name = mysqli_real_escape_string($conn, $_SESSION['user_name']); // sanitize the input
                $sql = "SELECT firstName, middlename, lastName, image FROM staffs WHERE user_name = '$user_name'";
                $result = mysqli_query($conn, $sql); // execute the query

                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $firstName = $row['firstName'];
                    $middleName = $row['middlename']; // Corrected column name
                    $lastName = $row['lastName'];
                    $formattedName = ($firstName) . ' ' . strtoupper(substr($middleName, 0, 1)) . '.' . ' ' . ($lastName);
                    echo $formattedName;
                } else {
                    echo "User not found";
                }
                ?>
            </span>

                <?php
                    if (isset($row['image']) && !empty($row['image'])) {
                        $profile_picture = "../uploads/" . $row['image'];
                    } else {
                        $profile_picture = "../images/admin.png";
                    }
                ?>
                <img src="<?= $profile_picture ?>" alt="Profile Picture" class="img-profile rounded-circle">
            </a>


                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                    aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="profile.php">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        Profile 
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="../logout.php" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout
                    </a>
   
                </div>
            </li>

        </ul>

    </nav>
    <!-- End of Topbar -->


    