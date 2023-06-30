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
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        <i class="fa fa-user-circle fa-1x text-gray-600 mr-1"></i>
        Crew Members
    </h1>
    <a href="row_report.php" class="btn btn-sm btn-info shadow-sm"><i
            class="fas fa-download fa-sm text-white"></i> Generate Report</a>
</div>

<?php include('message.php'); ?>
<?php include('message_danger.php'); ?>

<!-- DataTables Start-->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="d-sm-flex align-items-center justify-content-between py-2">
        <h6 class="m-0 font-weight-bold text-info">List of Crew Members</h6>
        <a href="appointments_create.php" class="btn btn-sm btn-info shadow-sm"><i
                class="fa fa-plus fa-sm text-white mr-1"></i>Add Crew Member</a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="example" class="display nowrap table-hover" style="width:100%">
                <thead class='thead-light text-gray-700'>
                    <tr style="text-align:center">
                        <!-- <th>ID</th> -->
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
                        <!-- <th>ID</th> -->
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
                $no=1;
                $query = "SELECT * FROM crew_members";
                $query_run = mysqli_query($conn, $query);

                if(mysqli_num_rows($query_run) > 0)
                {
                    foreach($query_run as $row)
                    {
                        ?>
                        <tr style="text-align:center">  
                            <!-- <td></td> -->
                            <td><?php echo $no; ?></td>
                            <td ><?= $row['firstName']; ?> <?= $row['middleName']; ?>. <?= $row['lastName']; ?></td>
                            <td ><?= $row['birthday']; ?></td>
                            <td ><?= $row['gender']; ?></td>
                            <td ><?= $row['phone']; ?></td>
                            <td ><?= $row['email']; ?></td>
                            <td ><?= $row['street']; ?> <?= $row['barangay']; ?> <?= $row['city']; ?> <?= $row['province']; ?></td>
                            <td>
                                        <a class="btn btn-sm btn-outline-success" href=".php?id=<?= $row['id']; ?>"
                                        data-toggle="tooltip" title="Edit appointment to Dr. <?= $row['lastName']; ?>!" data-placement="top">
                                        <i class="fa fa-edit fw-fa" aria-hidden="true"></i>
                                        <!-- Edit -->
                                        </a>


                                        <form action="code.php" method="POST" class="d-inline">
                                            <button type="submit" name="delete_appointment" value="<?=$row['id'];?>" class="btn btn-sm btn-outline-danger" onclick="msg()" 
                                            data-toggle="tooltip" title="Delete appointment to Dr. <?= $row['lastName']; ?>!" data-placement="top">
                                            <i class="fa fa-trash fw-fa" aria-hidden="true"></i>
                                            <!-- Delete -->
                                            </button>
                                            <script>
                                                function msg(){
                                                    var result = confirm ('Are you sure you want to delete this Appointments?');
                                                    if(result==false){
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
                }
                else
                {
                    echo "<h5> No Record Found </h5>";
                }
            ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- DataTables End-->

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<?php 
} else {
    header("Location: ../login.php");
    exit();
}
?>
<?php
include('../includes/scripts.php');
include('../includes/footer.php');
?>