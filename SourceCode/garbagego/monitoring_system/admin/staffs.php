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
                    <li class="breadcrumb-item"><a href="admin.php" class="text-info h5">Dashboard</a></li>
                    <li class="breadcrumb-item active text-dark h5" aria-current="page">Office Staffs</li>
                </ol>
            </nav>
            <a href="" class="btn btn-sm btn-info shadow-sm mb-3"><i class="fas fa-download fa-sm text-white"></i> Generate Report</a>
        </div>


        <?php include('message.php'); ?>
        <?php include('message_danger.php'); ?>

        <!-- DataTables Start-->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-sm-flex align-items-center justify-content-between py-2">
                    <h6 class="m-0 font-weight-bold text-info">List of Office Staffs</h6>
                    <a href="#addnew" data-toggle="modal" class="btn btn-sm btn-info shadow-sm"><i class="fa fa-plus fa-sm text-white mr-1"></i>Add Staff</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="display nowrap table table-bordered table-hover" style="width:100%">
                        <thead class='thead-light text-gray-700'>
                            <tr style="text-align:center">
                                <th>No.</th>
                                <th>Name</th>
                                <th>Birthday</th>
                                <th>Gender</th>
                                <th>Phone Number</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th class="no-export" width="12%">Options</th>
                            </tr>
                        </thead>
                        <tfoot class='thead-light text-gray-700'>
                            <tr style="text-align:center">
                                <th>No.</th>
                                <th>Name</th>
                                <th>Birthday</th>
                                <th>Gender</th>
                                <th>Phone Number</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th class="no-export" width="12%">Options</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                            $no = 1;
                            $query = "SELECT * FROM staffs";
                            $query_run = mysqli_query($conn, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                foreach ($query_run as $row) {
                                    ?>
                                    <tr style="text-align:center">
                                        <td><?php echo $no + 1; ?></td>
                                        <td><?= $row['firstName']; ?> <?= $row['middleName']; ?>. <?= $row['lastName']; ?></td>
                                        <td><?= $row['birthday']; ?></td>
                                        <td><?= $row['gender']; ?></td>
                                        <td><?= $row['phone']; ?></td>
                                        <td><?= $row['email']; ?></td>
                                        <td><?= $row['street']; ?> <?= $row['barangay']; ?> <?= $row['city']; ?> <?= $row['province']; ?></td>
                                        <td>
                                            <a class="btn btn-sm btn-outline-success" href=".php?id=<?= $row['id']; ?>" data-toggle="tooltip" title="Edit appointment to Dr. <?= $row['lastName']; ?>!" data-placement="top">
                                                <i class="fa fa-edit fw-fa" aria-hidden="true"></i>
                                            </a>
                                            <form action="code.php" method="POST" class="d-inline">
                                                <button type="submit" name="delete_appointment" value="<?= $row['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="msg()" data-toggle="tooltip" title="Delete appointment to Dr. <?= $row['lastName']; ?>!" data-placement="top">
                                                    <i class="fa fa-trash fw-fa" aria-hidden="true"></i>
                                                </button>
                                                <script>
                                                    function msg() {
                                                        var result = confirm('Are you sure you want to delete this Appointments?');
                                                        if (result == false) {
                                                            event.preventDefault();
                                                        }
                                                    }
                                                </script>
                                            </form>
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

        <div class="modal fade" id="addnew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel">Add Office Staff</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <form method="POST" action="add.php">
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label for="firstName" class="small text-info">First Name</label>
                                        <input type="text" class="form-control" id="firstName" placeholder="Enter first name">
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="middleName" class="small text-info">Middle Name</label>
                                        <input type="text" class="form-control" id="middleName" placeholder="Enter middle name">
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="lastName" class="small text-info">Last Name</label>
                                        <input type="text" class="form-control" id="lastName" placeholder="Enter last name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label for="position" class="small text-info">Position</label>
                                        <input type="text" class="form-control" id="position" placeholder="Enter position">
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="birthday" class="small text-info">Birthday</label>
                                        <input type="date" class="form-control" id="birthday">
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="gender" class="small text-info">Gender</label>
                                        <select class="form-control" id="gender">
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label for="phone" class="small text-info">Phone</label>
                                        <input type="tel" class="form-control" id="phone" placeholder="Enter phone number">
                                    </div>
                                    <div class="col-sm-8">
                                        <label for="email" class="small text-info">Email</label>
                                        <input type="email" class="form-control" id="email" placeholder="Enter email">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-3">
                                        <label for="province" class="small text-info">Province</label>
                                        <input type="text" class="form-control" id="province" placeholder="Enter province">
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="city" class="small text-info">City</label>
                                        <input type="text" class="form-control" id="city" placeholder="Enter city">
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="barangay" class="small text-info">Barangay</label>
                                        <input type="text" class="form-control" id="barangay" placeholder="Enter barangay">
                                    </div>
                                    <div class="col-sm-3">
                                        <label for="street" class="small text-info">Street</label>
                                        <input type="text" class="form-control" id="street" placeholder="Enter street">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="image" class="small text-info">Image</label>
                                    <input type="file" class="form-control-file" id="image">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" name="add" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this user?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-danger">Yes, Delete</button>
            </div>
        </div>
    </div>
</div>

<!-- End of Page Content -->
<?php
include('../includes/scripts.php');
include('../includes/footer.php');
} else {
header("Location: ../index.php");
exit();
}
?>
