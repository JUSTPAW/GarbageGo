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
                <ol class="breadcrumb bg-transparent p-0">
                    <li class="breadcrumb-item"><a href="admin_dashboard.php" class="text-secondary" style="color: #026601; text-decoration: none;">Dashboard</a></li>
                    <li class="breadcrumb-item"><span class="text-gray-700">Waste Collections</span></li>
                    <li class="breadcrumb-item active text-gray-900" aria-current="page">Locations</li>
                </ol>
            </nav>
            <a href="" class="btn btn-sm btn-info shadow-sm mb-3"><i class="fas fa-download fa-sm text-white"></i> Generate Report</a>
        </div>

        <?php include('message.php'); ?>
        <?php include('message_danger.php'); ?>

        <!-- Add Driver Member Modal -->
        <div class="modal fade" id="add_driver" tabindex="-1" role="dialog" aria-labelledby="addDriverModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-bold text-gray-800" id="addDriverModalLabel">Add New Driver</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="crud_driver.php" method="POST">
                            <div class="form-row">
                                <div class="form-group mt-2 col-md-4">
                                    <input type="text" class="form-control" id="firstName" name="firstName" placeholder=" " required>
                                    <label for="firstName" class="text-gray">First Name</label>
                                </div>
                                <div class="form-group mt-2 col-md-4">
                                    <input type="text" class="form-control" id="middleName" name="middleName" placeholder=" ">
                                    <label for="middleName" class="text-gray">Middle Name</label>
                                </div>
                                <div class="form-group mt-2 col-md-4">
                                    <input type="text" class="form-control" id="lastName" name="lastName" placeholder=" " required>
                                    <label for="lastName" class="text-gray">Last Name</label>
                                </div>
                            </div>

                            <input type="hidden" class="form-control" id="position" name="position" value="Driver">

                            <div class="form-row">
                                <div class="form-group mt-2 col-md-4">
                                    <input type="date" class="form-control" id="birthday" name="birthday" placeholder=" " required>
                                    <label for="birthday" class="text-gray">Date Of Birth</label>
                                </div>
                                <div class="form-group mt-2 col-md-4">
                                    <select class="form-control" id="gender" name="gender" required>
                                        <option value=""> </option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                    <label for="gender" class="text-gray">Gender</label>
                                </div>
                                <div class="form-group mt-2 col-md-4">
                                    <input type="number" class="form-control" id="phone" name="phone" placeholder=" " required>
                                    <label for="phone" class="text-gray">Contact Number</label>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group mt-2 col-md-12">
                                    <input type="email" class="form-control" id="email" name="email" placeholder=" ">
                                    <label for="email" class="text-gray">Email</label>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group mt-2 col-md-3">
                                    <input type="text" class="form-control" id="province" name="province" placeholder=" " required>
                                    <label for="province" class="text-gray">Province</label>
                                </div>
                                <div class="form-group mt-2 col-md-3">
                                    <input type="text" class="form-control" id="city" name="city" placeholder=" " required>
                                    <label for="city" class="text-gray">City/Municipality</label>
                                </div>
                                <div class="form-group mt-2 col-md-3">   
                                    <input type="text" class="form-control" id="barangay" name="barangay" placeholder=" " required>
                                    <label for="barangay" class="text-gray">Barangay</label>
                                </div>
                                <div class="form-group mt-2 col-md-3">
                                    <input type="text" class="form-control" id="street" name="street" placeholder=" ">
                                    <label for="street" class="text-gray">Street/Sitio</label>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="add_driver" class="btn btn-info">Save</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Driver Member -->
        <div class="modal fade" id="edit_driver" tabindex="-1" role="dialog" aria-labelledby="editDriverModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title font-weight-bold text-gray-800" id="editDriverModalLabel">Edit Driver</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form action="crud_driver.php" method="POST">
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

                  <input type="hidden" class="form-control" id="edit_position" name="edit_position" value="Driver">

                  <div class="form-row">
                    <div class="form-group mt-2 col-md-4">
                      <input type="date" class="form-control" id="edit_birthday" name="edit_birthday" placeholder=" " required>
                      <label for="edit_birthday" class="text-gray">Date Of Birth</label>
                    </div>
                    <div class="form-group mt-2 col-md-4">
                      <select class="form-control" id="edit_gender" name="edit_gender" required>
                        <option value="">Select gender</option>
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
                  <input type="hidden" id="edit_driver_id" name="edit_driver_id">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="edit_driver" class="btn btn-info">Update</button>
              </form>
              </div>
            </div>
          </div>
        </div>

        <!-- Delete Driver Member Modal -->
        <div class="modal fade" id="delete_driver" tabindex="-1" role="dialog" aria-labelledby="deleteDriverModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title font-weight-bold text-gray-800" id="deleteDriverModalLabel">Delete Driver</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="delete_driver_form" action="crud_driver.php" method="POST">
                      <div class="modal-body">
                        <span class="text-danger font-weight-bold">Warning! </span><span>Deleting the driver <span class="text-info font-weight-bold" id="delete_driver_fullname"></span> will result in the loss of associated data and cannot be undone. Proceed with caution.</p>
                    </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" id="confirm_delete_btn" class="btn btn-danger">Delete</button>
                            <input type="hidden" id="delete_driver_id" name="delete_driver_id">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- DataTables Start-->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-sm-flex align-items-center justify-content-between py-2">
                    <h6 class="m-0 font-weight-bold text-info">List of Driver(s)</h6>
                    <a href="#add_driver" data-toggle="modal" class="btn btn-sm btn-info shadow-sm"><i class="fa fa-plus fa-sm text-white mr-1"></i>Add Driver</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="display nowrap table table-bordered table-hover" style="width:100%;">
                        <thead class='thead-light text-gray-900'>
                          <tr style="text-align:center">
                            <th style="text-align: center;">No.</th>
                            <th style="text-align: center;">Location</th>
                            <th style="text-align: center;">Latitude</th>
                            <th style="text-align: center;">Longitude</th>
                            <th class="no-export" width="12%" style="text-align: center;">Actions</th>
                          </tr>
                        </thead>
                        <tfoot class='thead-light text-gray-700'>
                          <tr style="text-align:center">
                            <th style="text-align: center;">No.</th>
                            <th style="text-align: center;">Location</th>
                            <th style="text-align: center;">Latitude</th>
                            <th style="text-align: center;">Longitude</th>
                            <th class="no-export" width="12%" style="text-align: center;">Actions</th>
                          </tr>
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
                                        <td><?php echo $no; ?></td>
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
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- edit truck function -->
<script>
  $(document).ready(function() {
    $('.edit-driver-btn').click(function() {
      var driver_id = $(this).data('id');
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

      $('#edit_driver_id').val(driver_id);
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
    });
  });
</script>
<!-- delete truck function -->
<script>
    $(document).ready(function() {
        $('.delete-driver-btn').click(function() {
            var driverId = $(this).data('id');
            var firstName = $(this).data('firstname');
            var middleName = $(this).data('middlename');
            var lastName = $(this).data('lastname');
           
            $('#delete_driver_id').val(driverId);
            $('#delete_driver_fullname').text(firstName + ' ' + middleName + ' ' + lastName);
        });

        $('#delete_driver_form').submit(function(e) {
            e.preventDefault();
            var driverId = $('#delete_driver_id').val();
            $.ajax({
                type: "POST",
                url: "crud_driver.php",
                data: {
                    delete_driver_id: driverId
                },
                success: function(response) {
                    // Reload the page to see the message
                    location.reload();
                }
            });
        });
    });
</script>

<?php
include('../includes/footer.php');
include('../includes/scripts.php');
} else {
header("Location: ../login.php");
exit();
}
?>
