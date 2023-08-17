<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['user_name']) && isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {

include('../includes/header.php');
include('../includes/navbar_admin.php');
require '../db_conn.php';

   if (isset($_POST['submit'])) {
    $id = $_SESSION['id'];

    // Getting the post values
    $ppic = $_FILES["image"]["name"];
    $oldppic = $_POST['oldpic'];
    $oldprofilepic = "../uploads" . "/" . $oldppic;

    // Get the image extension
    $extension = strtolower(substr($ppic, -4)); // Convert extension to lowercase

    // Allowed extensions
    $allowed_extensions = array(".jpg", ".jpeg", ".png", ".gif");

    if (!in_array($extension, $allowed_extensions)) {
        $_SESSION['message_danger'] = "Invalid format. Only jpg / jpeg / png / gif format allowed";
    } else {
        // Rename the image file
        $imgnewfile = md5($ppic . time()) . $extension;

        // Code for moving image into directory
        move_uploaded_file($_FILES["image"]["tmp_name"], "../uploads/" . $imgnewfile);

        // Query for data insertion
        $query = mysqli_query($conn, "UPDATE admins SET image='$imgnewfile' WHERE id='$id'");

        if ($query) {
            // Delete old pic
            unlink($oldprofilepic);
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Profile Picture updated cuccessfully',
                    showConfirmButton: false,
                    timer: 2000,
                    customClass: {
                        popup: 'my-sweetalert',
                    }
                });

                setTimeout(function() {
                    document.location = 'profile.php';
                }, 2000); // Delay the redirect by 2000 milliseconds (2 seconds)
              </script>";
        } else {
            $_SESSION['message_danger'] = "Something Went Wrong. Please try again";
        }
    }
}
?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
<!--         <div class="d-sm-flex align-items-center justify-content-between mb-1 mt-1">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0">
                    <li class="breadcrumb-item"><a href="admin_dashboard.php" class="text-secondary"
                        style="color: #026601; text-decoration: none;">Dashboard</a></li>
                    <li class="breadcrumb-item active text-gray-900" aria-current="page">Garbage Trucks</li>
                </ol>
            </nav>
        </div>
 -->
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

        <!-- change profile picture modal -->
        <div class="modal fade" id="change_image" tabindex="-1" role="dialog" aria-labelledby="selectTruckModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-bold text-gray-800" id="selectTruckModalLabel">Change Profile Picture</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" enctype="multipart/form-data" id="imageForm">
                            <?php
                            $id = $_SESSION['id'];
                            $ret = mysqli_query($conn, "SELECT * FROM admins WHERE id='$id'");
                            while ($row = mysqli_fetch_array($ret)) {
                                $profile_picture = empty($row['image']) ? "../images/user.png" : "../uploads/" . $row['image'];
                            ?>
                            <input type="hidden" name="oldpic" value="<?php echo $row['image']; ?>">
                            <div class="form-group text-center">
                                <img id="previewImage" src="<?= $profile_picture ?>" alt="Profile Picture" class="rounded-circle" width="300">
                            </div>
                            <div class="form-group px-4">
                                <div class="form-group mt-2 col-md-12">
                                    <input type="file" id="image" name="image" class="form-control" id="customFile" placeholder=" " onchange="previewFile()" required>
                                    <span style="color:red; font-size:12px;">Only jpg / jpeg / png / gif format allowed.</span>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-info btn-md" name="submit">Update</button>
                                </div>
                            </div>
                        </form> <!-- Closing form tag -->
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Account -->
        <div class="modal fade" id="edit_account" tabindex="-1" role="dialog" aria-labelledby="editadminModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-gray-800" id="editadminModalLabel">Edit Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="crud_account.php" method="POST">
                  <div class="form-row">
                    <div class="form-group mt-2 col-md-4">
                      <input type="text" class="form-control" id="edit_firstName" name="edit_firstName" placeholder=" " required>
                      <label for="edit_firstName" class="text-gray">First Name</label>
                    </div>
                    <div class="form-group mt-2 col-md-4">
                      <input type="text" class="form-control" id="edit_middleName" name="edit_middleName" placeholder=" ">
                      <label for="edit_middleName" class="text-gray">Middle Name</label>
                    </div>
                    <div class="form-group mt-2 col-md-4">
                      <input type="text" class="form-control" id="edit_lastName" name="edit_lastName" placeholder=" " required>
                      <label for="edit_lastName" class="text-gray">Last Name</label>
                    </div>
                  </div>

                  <input type="hidden" class="form-control" id="edit_position" name="edit_position" value="admin">

                  <div class="form-row">
                    <div class="form-group mt-2 col-md-4">
                      <input type="date" class="form-control" id="edit_birthday" name="edit_birthday" placeholder=" " required>
                      <label for="edit_birthday" class="text-gray">Date Of Birth</label>
                    </div>
                    <div class="form-group mt-2 col-md-4">
                        <select class="form-control" id="edit_gender" name="edit_gender" required>
                            <option value=""> </option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        <label for="edit_gender" class="text-gray">Gender</label>
                    </div>
                    <div class="form-group mt-2 col-md-4">
                      <input type="number" class="form-control" id="edit_phone" name="edit_phone" placeholder=" " required>
                      <label for="edit_phone" class="text-gray">Contact Number</label>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group mt-2 col-md-12">
                      <input type="email" class="form-control" id="edit_email" name="edit_email" placeholder=" ">
                      <label for="edit_email" class="text-gray">Email</label>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group mt-2 col-md-3">
                      <input type="text" class="form-control" id="edit_province" name="edit_province" placeholder=" " required>
                      <label for="edit_province" class="text-gray">Province</label>
                    </div>
                    <div class="form-group mt-2 col-md-3">
                      <input type="text" class="form-control" id="edit_city" name="edit_city" placeholder=" " required>
                      <label for="edit_city" class="text-gray">City/Municipality</label>
                    </div>
                    <div class="form-group mt-2 col-md-3">   
                      <input type="text" class="form-control" id="edit_barangay" name="edit_barangay" placeholder=" " required>
                      <label for="edit_barangay" class="text-gray">Barangay</label>
                    </div>
                    <div class="form-group mt-2 col-md-3">
                      <input type="text" class="form-control" id="edit_street" name="edit_street" placeholder=" ">
                      <label for="edit_street" class="text-gray">Street/Sitio</label>
                    </div>
                  </div>
                   <div class="form-row">
                    <div class="form-group mt-2 col-md-12">
                      <input type="text" class="form-control" id="edit_username" name="edit_username" placeholder=" " onkeyup="checkUsernameAvailability()">
                      <label for="edit_username" class="text-gray">Username</label>
                    </div>
                  </div>
                  <div id="username-message"></div required>
                  <input type="hidden" id="edit_admin_id" name="edit_admin_id">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="edit_account" class="btn btn-info">Update</button>
              </form>
              </div>
            </div>
          </div>
        </div>

        <!-- Change Password-->
        <div class="modal fade" id="edit_password" tabindex="-1" role="dialog" aria-labelledby="changePasswordrModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-gray-800" id="changePasswordrModalLabel">Change Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="crud_cp.php" method="POST">
                  <div class="form-row">
                    <div class="form-group mt-2 col-md-12">
                      <input type="password" class="form-control" id="current_password" name="current_password" placeholder=" " required>
                      <label for="current_password" class="text-gray">Current Password</label>
                    </div>
                  </div>
                  <div class="form-row">
                      <div class="form-group mt-2 col-md-12 mb-2">
                          <input type="password" class="form-control" id="new_password" name="new_password" placeholder=" " required onkeyup="checkPasswordStrength()">
                          <label for="new_password" class="text-gray">New Password</label>
                      </div>
                  </div>
                  <div id="password-strength" class="password-strength ml-5"></div>
                  <div id="password-suggestions" class="password-suggestions"></div>

                  <div class="form-row">
                    <div class="form-group mt-2 col-md-12 mb-2">
                      <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder=" " required onkeyup="checkPasswordMatch()">
                      <label for="confirm_password" class="text-gray">Confirm Password</label>
                    </div>
                  </div>
                  <div id="password-match-message" class="small"></div>
                  <br>
                  <span class="text text-gray-800 text-sm">Please note that you will need to log in again after changing your password.</span> 
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="edit_account" class="btn btn-info">Update</button>
              </form>
              </div>
            </div>
          </div>
        </div>

        <!-- Delete admin Member Modal -->
        <div class="modal fade" id="delete_account" tabindex="-1" role="dialog" aria-labelledby="deleteadminModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-bold text-gray-800" id="deleteadminModalLabel">Delete Account</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="delete_admin_form" action="crud_admin.php" method="POST">
                      <div class="modal-body">
                        <span class="text-danger font-weight-bold">Warning! </span><span>Deleting the admin <span class="text-info font-weight-bold" id="delete_admin_fullname"></span> will result in the loss of associated data and cannot be undone. Proceed with caution.</p>
                    </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" id="confirm_delete_btn" class="btn btn-danger">Delete</button>
                            <input type="hidden" id="delete_admin_id" name="delete_admin_id">
                        </div>
                    </form>
                </div>
            </div>
        </div>

<?php
$user_name = $_SESSION['user_name'];
$sql = "SELECT * FROM admins WHERE user_name = '$user_name'";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);
?>
    <div class="row gutters-sm">

        <div class="col-lg-4 col-md-12 col-sm-12 mb-3">
            <div class="card shadow">
                <div class="card-body">
                    <div class="d-flex flex-column align-items-center text-center">
                        <?php
                            if (!isset($row['image']) || empty($row['image'])) {
                                $profile_picture = "../images/user.png";
                            } else {
                                $profile_picture = "../uploads/" . $row['image'];
                            }
                        ?>
                        <div style="position: relative;">
                            <img src="<?= $profile_picture ?>" alt="Profile Picture" class="rounded-circle" width="180">
                            <a href="#change_image" data-toggle="modal" class="btn-circle btn-secondary" style="position: absolute; bottom: 0; right: 0;">
                                <i class="fa fa-camera"></i>
                            </a>
                        </div>
                        <div class="mt-3">
                            <h4 class="text-gray-900"><?= $row['firstName'] . ' ' . $row['lastName']; ?></h4>
                            <p class="text-gray-800 mb-1"><?= $row['position']; ?></p>
                            <p class="text-muted font-size-sm"><?= $row['barangay'] . ', ' . $row['city'] . ', ' . $row['province']; ?></p>
                        </div>

                        <div class="row justify-content-between">
                          <div class="col-auto col-sm-auto" style="margin-right: -5px;">
                           
                            <button class="btn btn-md btn-secondary edit-account-btn" data-toggle="modal" 
                              data-target="#edit_account" 
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
                              data-user_name="<?= $row['user_name']; ?>"  
                              data-toggle="tooltip" 
                              title="Edit <?= $row['firstName']; ?> <?= $row['lastName']; ?>!" 
                              data-placement="top">
                                <i class="fa fa-edit fw-fa" aria-hidden="true"></i> Edit Profile
                            </button>
                           
                          </div>
                          <div class="col-auto col-sm-auto" style="margin-left: -5px;">
                            <div class="dropdown no-arrow mb-4">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-ellipsis-h"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">
                                    <a class="dropdown-item" data-toggle="modal" data-target="#edit_password" href="#" data-toggle="tooltip" 
                                        title="Click to change your password" 
                                        data-placement="top"><i class="text-primary fa fa-key mr-2"></i> Change Password</a>
                                    <a class="dropdown-item" href="#"><i class="text-warning fa fa-cog mr-2"></i> Manage Account</a>
                                    <a class="dropdown-item delete-account-btn" data-toggle="modal" 
                                      data-target="#delete_account" 
                                      data-id="<?= $row['id']; ?>" 
                                      data-firstName="<?= $row['firstName']; ?>"
                                      data-lastName="<?= $row['lastName']; ?>"
                                      data-middleName="<?= $row['middleName']; ?>" 
                                      data-toggle="tooltip" 
                                      title="Delete your account!" 
                                      data-placement="top">
                                          <i class="text-danger fa fa-trash mr-2"></i> Delete Account
                                      </a>
                                </div>
                            </div>

                          </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        <div class="col-lg-8 col-md-12 col-sm-12">
            <div class="card shadow mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="text-gray-800 mb-0">Full Name</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <?= $row['firstName'] . ' ' . $row['lastName']; ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="text-gray-800 mb-0">Birthday</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <?= date('M d, Y', strtotime($row['birthday'])); ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="text-gray-800 mb-0">Age</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <?php
                            $birthdate = new DateTime($row['birthday']);
                            $currentDate = new DateTime();
                            $age = $currentDate->diff($birthdate)->y;
                            echo $age . ' years';
                            ?>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="text-gray-800  mb-0">Phone</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <?= $row['phone']; ?></p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="text-gray-800  mb-0">Email</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                           <?= $row['email']; ?></p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="text-gray-800 mb-0">Address</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <?= $row['barangay'] . ', ' . $row['city'] . ', ' . $row['province']; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <?php
            } else {
    // No user found with the given user_name
    echo "User not found";
}
?>
  </div>
</div>
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
<script src="https://code.jquery.com/jquery-1.9.1.js"></script>
<script>
  function checkUsernameAvailability() {
    const username = document.getElementById('edit_username').value;
    const xhr = new XMLHttpRequest();
    
    xhr.open('POST', '../check_username.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        const response = JSON.parse(xhr.responseText);
        const messageElement = document.getElementById('username-message');
        
        const successColor = '#28a745';
        const errorColor = '#dc3545';
        
        const message = response.available ?
          `<span class="small" style="color: ${successColor}; font-size: 12px;">Username is available.</span>` :
          `<span class="small" style="color: ${errorColor}; font-size: 12px;">Username is already taken.</span>`;
          
        const infoText = '<br><span class="text text-gray-800 text-sm">Please note that you will need to log in again after changing your username.</span>';
        
        messageElement.innerHTML = `${message} ${infoText}`;
      }
    };
    
    xhr.send('username=' + encodeURIComponent(username));
  }
</script>

<script>
  function checkPasswordStrength() {
    var password = document.getElementById("new_password").value;
    console.log("Password: " + password);
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
<script>
  function checkPasswordMatch() {
    var password = document.getElementById("new_password").value;
    var confirmPassword = document.getElementById("confirm_password").value;
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
<script>
function previewFile() {
    const preview = document.getElementById('previewImage');
    const fileInput = document.getElementById('image');
    const file = fileInput.files[0];
    const reader = new FileReader();

    reader.onload = function (e) {
        preview.src = e.target.result;
    };

    reader.readAsDataURL(file);
}
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- edit truck function -->
<script>
  $(document).ready(function() {
    $('.edit-account-btn').click(function() {
      var admin_id = $(this).data('id');
      var firstName = $(this).data('firstname');
      var middleName = $(this).data('middlename');
      var lastName = $(this).data('lastname');
      var position = $(this).data('position');
      var birthday = $(this).data('birthday');
      var gender = $(this).data('gender');
      var phone = $(this).data('phone');
      var email = $(this).data('email');
      var province = $(this).data('province');
      var city = $(this).data('city');
      var barangay = $(this).data('barangay');
      var street = $(this).data('street');
      var user_name = $(this).data('user_name');

      $('#edit_admin_id').val(admin_id);
      $('#edit_firstName').val(firstName);
      $('#edit_middleName').val(middleName);
      $('#edit_lastName').val(lastName);
      $('#edit_position').val(position);
      $('#edit_birthday').val(birthday);
      $('#edit_gender').val(gender);
      $('#edit_phone').val(phone);
      $('#edit_email').val(email);
      $('#edit_province').val(province);
      $('#edit_city').val(city);
      $('#edit_barangay').val(barangay);
      $('#edit_street').val(street);
      $('#edit_username').val(user_name);
    });
  });
</script>
<!-- delete truck function -->
<script>
    $(document).ready(function() {
        $('.delete-admin-btn').click(function() {
            var adminId = $(this).data('id');
            var firstName = $(this).data('firstname');
            var middleName = $(this).data('middlename');
            var lastName = $(this).data('lastname');
           
            $('#delete_admin_id').val(adminId);
            $('#delete_admin_fullname').text(firstName + ' ' + middleName + ' ' + lastName);
        });

        $('#delete_admin_form').submit(function(e) {
            e.preventDefault();
            var adminId = $('#delete_admin_id').val();
            $.ajax({
                type: "POST",
                url: "crud_admin.php", // Adjust this URL to the correct PHP file for admin deletions
                data: {
                    delete_admin_id: adminId
                },
                success: function(response) {
                    console.log("Delete response:", response);

                    // Hide the deleted row from the table
                    $('#row_' + adminId).hide();

                    // Show a success message with SweetAlert2 toast
                    Swal.fire({
                        icon: 'success',
                        title: 'Deleted!',
                        text: 'The admin has been deleted successfully.',
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
        <!-- End of Page Content -->
    <?php
    include('../includes/scripts.php');
    include('../includes/footer.php');
} else {
    header("Location: ../login.php");
    exit();
}
?>