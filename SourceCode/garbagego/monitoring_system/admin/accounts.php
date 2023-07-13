<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['user_name']) && isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
    // Regenerate the session ID
    session_regenerate_id(true);

    // Include the necessary files and establish database connection
    include('../includes/header.php');
    include('../includes/navbar_admin.php');
    require '../db_conn.php';
?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-1 mt-1">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent p-0">
                <li class="breadcrumb-item"><a href="admin_dashboard.php" class="text-secondary" style="color: #026601; text-decoration: none;">Dashboard</a></li>
                <li class="breadcrumb-item active text-gray-900" aria-current="page">Accounts</li>
            </ol>
        </nav>
        <a href="" class="btn btn-sm btn-info shadow-sm mb-3"><i class="fas fa-download fa-sm text-white"></i> Generate Report</a>
    </div>

        <?php include('message.php'); ?>
        <?php include('message_danger.php'); ?>

        <!-- Add Account Modal -->
        <div class="modal fade" id="add_account" tabindex="-1" role="dialog" aria-labelledby="registrationModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-bold text-gray-800" id="registrationModalLabel">Add New Account</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <form action="signup.php" method="POST">           
                    <div class="form-row">
                      <div class="form-group col-md-4">
                        <label for="firstName" class="small text-info">First Name</label>
                        <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Enter first name" required>
                      </div>
                      <div class="form-group col-md-4">
                        <label for="middleName" class="small text-info">Middle Name</label>
                        <input type="text" class="form-control" id="middleName" name="middleName" placeholder="Enter first name" required>
                      </div>
                      <div class="form-group col-md-4">
                        <label for="lastName" class="small text-info">Last Name</label>
                        <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Enter first name" required>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-7">
                        <label for="email" class="small text-info">Email</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Enter email" required>
                      </div>
                      <div class="form-group col-md-5">
                        <label for="phone" class="small text-info">Phone</label>
                        <input type="number" class="form-control" id="phone" name="phone" placeholder="Enter phone" required>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-8">
                        <label for="uname" class="small text-info">Username</label>
                        <input type="text" class="form-control" id="uname" name="uname" placeholder="Enter username" required onkeyup="checkUsernameAvailability()">
                        <div id="username-message"></div>
                      </div>
                      <div class="form-group col-md-4">
                        <label for="role" class="small text-info">Role</label>
                        <select class="form-control" id="role" name="role" required>
                          <option value="" selected disabled>Select role</option>
                          <option value="staff">Staff</option>
                          <option value="driver">Driver</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-6">
                       <label for="password" class="small text-info">Password</label>
                       <input type="password" class="form-control" id="password" name="password" placeholder="Enter a password" onkeyup="checkPasswordStrength()">
                       <div id="password-strength" class="password-strength"></div>
                       <div id="password-suggestions" class="password-suggestions"></div>

                      </div>
                      <div class="form-group col-md-6">
                        <label for="re_password" class="small text-info">Repeat Password</label>
                       <input type="password" class="form-control" id="re_password" name="re_password" placeholder="Enter password again" required onkeyup="checkPasswordMatch()">
                       <div id="password-match-message" class="small"></div>
                      </div>
                    </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="add_account" class="btn btn-info">Save changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- View Account Modal -->
        <div class="modal fade" id="edit_account" tabindex="-1" role="dialog" aria-labelledby="editAccountModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-bold text-gray-800" id="editAccountModalLabel">View Account Informations</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="crud.php" method="POST">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="edit_firstName" class="small text-info">First Name</label>
                                    <input type="text" class="form-control" id="edit_firstName" name="edit_firstName" placeholder="Enter first name" readonly>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="edit_middleName" class="small text-info">Middle Name</label>
                                    <input type="text" class="form-control" id="edit_middleName" name="edit_middleName" placeholder="Enter middle name" readonly>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="edit_lastName" class="small text-info">Last Name</label>
                                    <input type="text" class="form-control" id="edit_lastName" name="edit_lastName" placeholder="Enter last name" readonly>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="edit_email" class="small text-info">Email</label>
                                    <input type="email" class="form-control" id="edit_email" name="edit_email" placeholder="Enter email" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="edit_phone" class="small text-info">Phone</label>
                                    <input type="text" class="form-control" id="edit_phone" name="edit_phone" placeholder="Enter phone" readonly>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="edit_username" class="small text-info">Username</label>
                                    <input type="text" class="form-control" id="edit_username" name="edit_username" placeholder="Enter username" required readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="edit_role" class="small text-info">Role</label>
                                    <input type="text" class="form-control" id="edit_role" name="edit_role" placeholder="Enter username" required readonly>
                                </div>
<!--                                 <div class="form-group col-md-6">
                                    <label for="edit_role" class="small text-info">Role</label>
                                    <select class="form-control" id="edit_role" name="edit_role" readonly>
                                        <option value="" selected disabled>Select role</option>
                                        <option value="staff">Staff</option>
                                        <option value="driver">Driver</option>
                                    </select>
                                </div> -->
                            </div>
                           <!--  <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="edit_password" class="small text-info">Password</label>
                                    <input type="password" class="form-control" id="edit_password" name="edit_password" placeholder="Enter password">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="edit_repassword" class="small text-info">Re-enter Password</label>
                                    <input type="password" class="form-control" id="edit_repassword" name="edit_repassword" placeholder="Re-enter password">
                                </div>
                            </div> -->
                            <input type="hidden" id="edit_account_id" name="edit_account_id">
                        </form>
                    </div>
                    <!-- <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="edit_account" class="btn btn-info">Save changes</button>

                    </div> -->
                </div>
            </div>
        </div>

        <!-- Delete Account Modal -->
        <div class="modal fade" id="delete_account" tabindex="-1" role="dialog" aria-labelledby="deleteTruckModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-bold text-gray-800" id="deleteTruckModalLabel">Delete Accounts</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="delete_truck_form" action="crud.php" method="POST">
                        <div class="modal-body">
                            <p>Are you sure you want to delete <span class="text-info font-weight-bold mx-auto" id="delete_account_brand"></span> account?</p>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" id="confirm_delete_btn" class="btn btn-danger">Delete</button>
                            <input type="hidden" id="delete_account_id" name="delete_account_id">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- DataTables Start-->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-sm-flex align-items-center justify-content-between py-2">
                    <h6 class="m-0 font-weight-bold text-info">List of Account(s)</h6>
                    <a href="#add_account" data-toggle="modal" class="btn btn-sm btn-info shadow-sm"><i class="fa fa-plus fa-sm text-white mr-1"></i>Add Account</a>
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
                            $query = "SELECT *, 'staff' AS type
                                    FROM staffs
                                    WHERE user_name IS NOT NULL AND user_name <> '' AND password IS NOT NULL AND password <> '' AND role IS NOT NULL AND role <> ''
                                    UNION
                                    SELECT *, 'driver' AS type
                                    FROM drivers
                                    WHERE user_name IS NOT NULL AND user_name <> '' AND password IS NOT NULL AND password <> '' AND role IS NOT NULL AND role <> '';
                                    ";
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
                                        <?php
                                        $role = $row['role'];
                                        $color = ($role == 'staff') ? 'primary' : 'danger';
                                        ?>
                                        <td>
                                            <span class="badge bg-<?php echo $color; ?> text-white">
                                                <?php echo ucwords($role); ?>
                                            </span>
                                        </td>
                                        <td><?= date('m/d/Y h:i A', strtotime($row['dateCreated'])); ?></td>
                                        <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Actions
                                            </button>
                                            <div class="dropdown-menu text-info pr-0" aria-labelledby="dropdownMenuButton">
                                                <button class="dropdown-item edit-account-btn" data-toggle="modal" data-target="#edit_account" 
                                                data-id="<?= $row['id']; ?>" 
                                                data-firstname="<?= $row['firstName']; ?>" 
                                                data-middlename="<?= $row['middleName']; ?>" 
                                                data-lastname="<?= $row['lastName']; ?>" 
                                                data-email="<?= $row['email']; ?>" 
                                                data-phone="<?= $row['phone']; ?>" 
                                                data-username="<?= $row['user_name']; ?>" 
                                                data-role="<?= $row['role']; ?>" 
                                                data-toggle="tooltip" 
                                                title="View <?= $row['user_name']; ?>'s Account!"  
                                                data-placement="top">
                                                    <i class="fa fa-eye fw-fa text-warning" aria-hidden="true"></i> View
                                                </button>
                                                <button class="dropdown-item delete-account-btn" 
                                                data-toggle="modal" 
                                                data-target="#delete_account" 
                                                data-id="<?= $row['id']; ?>" 
                                                data-username="<?= $row['user_name']; ?>" 
                                                data-toggle="tooltip" 
                                                title="Delete <?= $row['user_name']; ?>'s Account!" 
                                                data-placement="top">
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
<!-- edit account function -->
<script>
    $(document).ready(function() {
        $('.edit-account-btn').click(function() {
            var accountId = $(this).data('id');
            var firstName = $(this).data('firstname');
            var middleName = $(this).data('middlename');
            var lastName = $(this).data('lastname');
            var email = $(this).data('email');
            var phone = $(this).data('phone');
            var username = $(this).data('username');
            var role = $(this).data('role');

            $('#edit_account_id').val(accountId);
            $('#edit_firstName').val(firstName);
            $('#edit_middleName').val(middleName);
            $('#edit_lastName').val(lastName);
            $('#edit_email').val(email);
            $('#edit_phone').val(phone);
            $('#edit_username').val(username);
            $('#edit_role').val(role);
        });
    });
</script>
<!-- delete account function -->
<script>
    $(document).ready(function() {
        $('.delete-truck-btn').click(function() {
            var truckId = $(this).data('id');
            var brand = $(this).data('brand');
            
            $('#delete_account_id').val(truckId);
            $('#delete_account_brand').text(brand);
        });

        $('#delete_truck_form').submit(function(e) {
            e.preventDefault(); // Prevent form submission
            var truckId = $('#delete_account_id').val();

            $.post($(this).attr('action'), { delete_account_id: truckId }, function(response) {
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
    color: #dc3545; /* Bootstrap 4 danger color */
  }
  .medium {
    color: #ffc107; /* Bootstrap 4 warning color */
  }
  .strong {
    color: #28a745; /* Bootstrap 4 success color */
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
      passwordSuggestions.innerHTML = "<ul><li>Add special characters, uppercase, and lowercase letters</li></ul>";
    } else if (weakRegex.test(password)) {
      passwordStrength.textContent = "Weak password";
      passwordStrength.className = "password-strength weak";
      passwordSuggestions.innerHTML = "<ul><li>Make it longer, include numbers, uppercase and lowercase letters, and special characters</li></ul>";
    } else {
      passwordStrength.textContent = "Password is too short";
      passwordStrength.className = "password-strength";
      passwordSuggestions.innerHTML = "<ul><li>Make it at least 8 characters long, include uppercase and lowercase letters, numbers, and special characters</li></ul>";
    }
  }
</script>
<!-- Username Checker -->
<script>
  function checkUsernameAvailability() {
    const username = document.getElementById('uname').value;

    // Send an AJAX request to check_username.php
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'check_username.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
        const response = JSON.parse(xhr.responseText);
        const messageElement = document.getElementById('username-message');
        if (response.available) {
          // Username is available
          messageElement.innerHTML = '<span class="small" style="color: #28a745; font-size: 12px;">Username is available</span>';
        } else {
          // Username is already taken
          messageElement.innerHTML = '<span class="small" style="color: #dc3545; font-size: 12px;">Username is already taken</span>';
        }
      }
    };
    xhr.send('username=' + encodeURIComponent(username));
  }
</script>
<!-- check if the passwords match -->
<script>
  function checkPasswordMatch() {
    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("re_password").value;
    var matchMessage = document.getElementById("password-match-message");

    if (password === confirmPassword) {
      matchMessage.innerHTML = "Passwords match";
      matchMessage.style.color = "#28a745"; // Green color for success
    } else {
      matchMessage.innerHTML = "Passwords do not match";
      matchMessage.style.color = "#dc3545"; // Red color for danger
    }
  }
</script>


<?php
    // Include the necessary files and establish database connection
    include('../includes/footer.php');
    include('../includes/scripts.php');
} else {
    header("Location: ../admin_login.php");
    exit();
}
?>
