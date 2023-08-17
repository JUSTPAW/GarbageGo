<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['user_name']) && isset($_SESSION['role']) && $_SESSION['role'] == 'driver') {

    require '../db_conn.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
        $fuel_slip_id = (isset($_POST['fuel_slip_id']) && is_numeric($_POST['fuel_slip_id'])) ? $_POST['fuel_slip_id'] : 0;
        $status = $_POST['status']; // Assuming 'accepted' or 'rejected' are the only possible values.

        // Perform any additional validation if necessary.

        // Update the status in the database.
        $query = "UPDATE fuel_slips SET status = '$status' WHERE id = '$fuel_slip_id'";

        if (mysqli_connect_errno()) {
            // Connection failed.
            $_SESSION['message_danger'] = "Failed to connect to the database: " . mysqli_connect_error();
            header('Location: fuels.php');
            exit();
        } else {
            if (mysqli_query($conn, $query)) {
                $_SESSION['message'] = "Status updated successfully.";
                header('Location: fuels.php');
                exit();
            } else {
                $_SESSION['message'] = "Error updating status: " . mysqli_error($conn);
                header('Location: fuels.php');
                exit();
            }
        }
    }

} else {
    // Redirect to the login page if not logged in or don't have the 'staff' role.
    header("Location: ../login.php");
    exit();
}
?>
