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
                    <li class="breadcrumb-item active text-dark h5" aria-current="page">Office Staff Accounts</li>
                </ol>
            </nav>
            <a href="" class="btn btn-sm btn-info shadow-sm mb-3"><i class="fas fa-download fa-sm text-white"></i>Generate Report</a>
        </div>

        <?php include('message.php'); ?>
        <?php include('message_danger.php'); ?>

        <!-- Add Truck Modal -->
        <div class="modal fade" id="add_truck" tabindex="-1" role="dialog" aria-labelledby="addTruckModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-bold text-gray-800" id="addTruckModalLabel">Add New Office Staff Account</h5>
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

        <!-- Add Staff Account Modal -->
          <div class="modal fade" id="add_staff_acc" tabindex="-1" role="dialog" aria-labelledby="registrationModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title font-weight-bold text-gray-800" id="registrationModalLabel">Account Registration</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form>
                    <div class="form-row">
                      <div class="form-group col-md-4">
                        <label for="firstName" class="small text-info">First Name</label>
                        <input type="text" class="small form-control" id="firstName" placeholder="Enter your first name">
                      </div>
                      <div class="form-group col-md-4">
                        <label for="middleName" class="small text-info">Middle Name</label>
                        <input type="text" class="form-control" id="middleName" placeholder="Enter your middle name">
                      </div>
                      <div class="form-group col-md-4">
                        <label for="lastName" class="small text-info">Last Name</label>
                        <input type="text" class="form-control" id="lastName" placeholder="Enter your last name">
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="email" class="small text-info">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter your email address">
                      </div>
                      <div class="form-group col-md-6">
                        <label for="phone" class="small text-info">Phone</label>
                        <input type="text" class="form-control" id="phone" placeholder="Enter your phone number">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="userName" class="small text-info">Username</label>
                      <input type="text" class="form-control" id="userName" placeholder="Enter a username">
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-6">
                       <label for="password" class="small text-info">Password</label>
                       <input type="password" class="form-control" id="password" placeholder="Enter a password" onkeyup="checkPasswordStrength()">
                       <div id="password-strength" class="password-strength"></div>
                       <div id="password-suggestions" class="password-suggestions"></div>

                      </div>
                      <div class="form-group col-md-6">
                        <label for="repeatPassword" class="small text-info">Repeat Password</label>
                       <input type="password" class="form-control" id="repeatPassword" placeholder="Repeat your password">
                      </div>
                    </div>
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-info">Register</button>
                </div>
              </div>
            </div>
          </div>



        <!-- Edit Truck Modal -->
        <div class="modal fade" id="edit_truck" tabindex="-1" role="dialog" aria-labelledby="editTruckModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-bold text-gray-800" id="editTruckModalLabel">Edit ffice Staff Account</h5>
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
                        <h5 class="modal-title font-weight-bold text-gray-800" id="deleteTruckModalLabel">Delete Office Staff Accounts</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="delete_truck_form" action="crud.php" method="POST">
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
                    <h6 class="m-0 font-weight-bold text-info">List of Office Staff(s)</h6>
                    <a href="#add_staff_acc" data-toggle="modal" class="btn btn-sm btn-info shadow-sm"><i class="fa fa-plus fa-sm text-white mr-1"></i>Add
                     Staff Account</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="display nowrap table table-bordered table-hover" style="width:100%;">
                        <thead class='thead-light text-gray-900'>
                          <tr style="text-align:center">
                            <th style="text-align: center;">No.</th>
                            <th style="text-align: center;">Name</th>
                            <th style="text-align: center;">Username</th>
                            <th style="text-align: center;">Role</th>
                            <th style="text-align: center;">Date Created</th>
                            <th class="no-export" width="12%" style="text-align: center;">Actions</th>
                          </tr>
                        </thead>
                        <tfoot class='thead-light text-gray-700'>
                          <tr style="text-align:center">
                            <th style="text-align: center;">No.</th>
                            <th style="text-align: center;">Name</th>
                            <th style="text-align: center;">Username</th>
                            <th style="text-align: center;">Role</th>
                            <th style="text-align: center;">Date Created</th>
                            <th class="no-export" width="12%" style="text-align: center;">Actions</th>
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
                                        <td><?php echo $no; ?></td>
                                        <?php
                                        $firstName = $row['firstName'];
                                        $middleName = $row['middleName'];
                                        $lastName = $row['lastName'];

                                        $formattedName = ucwords($firstName) . ' ' . strtoupper(substr($middleName, 0, 1)) . '.' . ' ' . ucwords($lastName);
                                        ?>

                                        <td><?= $formattedName; ?></td>
                                        <td><?= $row['user_name']; ?></td>
                                        <td><?= $row['role']; ?></td>
                                        <td><?= $row['dateCreated']; ?></td>
                                        <td>
                                        <div class="dropdown">
                                          <button class="btn btn-sm btn-outline-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Actions
                                          </button>
                                          <div class="dropdown-menu text-info pr-0" aria-labelledby="dropdownMenuButton">
                                            <button class="dropdown-item edit-truck-btn" data-toggle="modal" data-target="#edit_truck" data-id="<?= $row['id']; ?>" data-brand="<?= $row['brand']; ?>" data-model="<?= $row['model']; ?>" data-capacity="<?= $row['capacity']; ?>" data-platenumber="<?= $row['plateNumber']; ?>" data-toggle="tooltip" title="Edit <?= $row['brand']; ?>!" data-placement="top">
                                              <i class="fa fa-edit fw-fa text-primary" aria-hidden="true"></i> Edit
                                            </button>
                                            <button class="dropdown-item delete-truck-btn" data-toggle="modal" data-target="#delete_truck" data-id="<?= $row['id']; ?>" data-brand="<?= $row['brand']; ?>" data-toggle="tooltip" title="Delete <?= $row['brand']; ?>!" data-placement="top">
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
            e.preventDefault(); // Prevent form submission
            var truckId = $('#delete_truck_id').val();

            $.post($(this).attr('action'), { delete_truck_id: truckId }, function(response) {
                location.reload(); // Reload the page after deletion
            });
        });
    });
</script>


<!-- password strength -->
<style>
  .password-strength {
    margin-top: 5px;
    font-size: 12px;
  }
  .weak {
    color: red;
  }
  .medium {
    color: orange;
  }
  .strong {
    color: green;
  }
  .password-suggestions {
    margin-top: 8px;
    font-size: 13px;
  }
</style>
<script>
  function checkPasswordStrength() {
    var password = document.getElementById("password").value;
    var passwordStrength = document.getElementById("password-strength");
    var passwordSuggestions = document.getElementById("password-suggestions");

    // Define the criteria for weak, medium, and strong passwords
    var weakRegex = /^.{0,5}$/; // Less than 6 characters
    var mediumRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{6,}$/; // At least 6 characters with lowercase, uppercase, and numeric characters
    var strongRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&_#^+=(){}[\]|\\:;"'<>,.~`]).{8,}$/;

    if (strongRegex.test(password)) {
      passwordStrength.textContent = "Strong password";
      passwordStrength.className = "password-strength strong";
      passwordSuggestions.innerHTML = ""; // Clear previous suggestions
    } else if (mediumRegex.test(password)) {
      passwordStrength.textContent = "Medium password";
      passwordStrength.className = "password-strength medium";
      passwordSuggestions.innerHTML = "<ul><li>Add special characters</li><li>Use both uppercase and lowercase letters</li></ul>";
    } else if (weakRegex.test(password)) {
      passwordStrength.textContent = "Weak password";
      passwordStrength.className = "password-strength weak";
      passwordSuggestions.innerHTML = "<ul><li>Make it longer</li><li>Include numbers</li><li>Add uppercase and lowercase letters</li><li>Add special characters</li></ul>";
    } else {
      passwordStrength.textContent = "Password is too short";
      passwordStrength.className = "password-strength";
      passwordSuggestions.innerHTML = "<ul><li>Make it at least 8 characters long</li><li>Include uppercase and lowercase letters</li><li>Add numbers and special characters</li></ul>";
    }
  }
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
