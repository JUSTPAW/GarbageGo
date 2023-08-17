<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['user_name']) && isset($_SESSION['role']) && $_SESSION['role'] == 'staff') {

require '../db_conn.php';

if (isset($_POST['delete_slip_id'])) {
    $slipId = $_POST['delete_slip_id'];
    // Validate and sanitize the input to prevent SQL injection
    $slipId = mysqli_real_escape_string($conn, $slipId);

    // Perform the necessary delete operation using the $slipId
    $deleteQuery = "DELETE FROM fuel_slips WHERE id = $slipId";
    $deleteResult = mysqli_query($conn, $deleteQuery);

    if ($deleteResult) {
        $_SESSION['message'] = "Fuel slip deleted successfully.";
        header('Location: fuels.php');
        exit();
    } else {
        $_SESSION['message_danger'] = "Error deleting fuel slip.";
        header('Location: fuels.php');
        exit();
    }
}


if (isset($_POST['add_slip'])) {
    $driver_id = $_POST['driver_id'];
    $staff_id = $_POST['staff_id'];
    $truck_id = $_POST['truck_id'];
    $vehicle = $_POST['vehicle'];
    $fuelType = $_POST['fuelType'];
    $fuelAmount = $_POST['fuelAmount'];
    $status = $_POST['status'];

    // Escape special characters in variables
    $driver_id = mysqli_real_escape_string($conn, $driver_id);
    $staff_id = mysqli_real_escape_string($conn, $staff_id);
    $truck_id = mysqli_real_escape_string($conn, $truck_id);
    $vehicle = mysqli_real_escape_string($conn, $vehicle);
    $fuelType = mysqli_real_escape_string($conn, $fuelType);
    $fuelAmount = mysqli_real_escape_string($conn, $fuelAmount);
    $status = mysqli_real_escape_string($conn, $status);

    $status = 'Issued';

    // Fetch the garbage truck ID based on the provided driver_id
    $garbage_truck_query = "SELECT id FROM garbage_trucks WHERE driver_id = '$driver_id'";
    $garbage_truck_result = mysqli_query($conn, $garbage_truck_query);
    if ($garbage_truck_result && mysqli_num_rows($garbage_truck_result) > 0) {
        $garbage_truck_row = mysqli_fetch_assoc($garbage_truck_result);
        $garbage_truck_id = $garbage_truck_row['id'];

        // Perform the database insertion with the garbage_truck_id
        $query = "INSERT INTO fuel_slips (driver_id, staff_id, truck_id, vehicle, fuelType, fuelAmount, status) 
                  VALUES ('$driver_id', '$staff_id', '$garbage_truck_id', '$vehicle', '$fuelType', '$fuelAmount', '$status')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            // Success message
            $_SESSION['message'] = "Fuel slip added successfully.";
            header('Location: fuels.php');
        } else {
            // Error message
            $_SESSION['message_danger'] = "Error occurred while adding the fuel slip.";
            header('Location: fuels.php');
        }
    } else {
        // Error message if no garbage truck found for the given driver_id
        $_SESSION['message_danger'] = "No garbage truck found for the provided driver.";
        header('Location: fuels.php');
    }
}

// Issued, Used, Cancelled, Rejected

if (isset($_POST['edit_slip'])) {
    $slipId = $_POST['edit_slip_id'];
    $driver_id = $_POST['edit_driver_id'];
    $staff_id = $_POST['edit_staff_id'];
    $truck_id = $_POST['edit_truck_id'];
    $vehicle = $_POST['edit_vehicle'];
    $fuelType = $_POST['edit_fuelType'];
    $fuelAmount = $_POST['edit_fuelAmount'];
    $status = $_POST['edit_status'];

    // Escape special characters in variables
    $slipId = mysqli_real_escape_string($conn, $slipId);
    $driver_id = mysqli_real_escape_string($conn, $driver_id);
    $staff_id = mysqli_real_escape_string($conn, $staff_id);
    $truck_id = mysqli_real_escape_string($conn, $truck_id);
    $vehicle = mysqli_real_escape_string($conn, $vehicle);
    $fuelType = mysqli_real_escape_string($conn, $fuelType);
    $fuelAmount = mysqli_real_escape_string($conn, $fuelAmount);
    $status = mysqli_real_escape_string($conn, $status);

    // Assuming the garbage_trucks table has a column named "driver_id" to store the driver's ID
    $garbage_truck_query = "SELECT id FROM garbage_trucks WHERE driver_id = '$driver_id'";
    $garbage_truck_result = mysqli_query($conn, $garbage_truck_query);

    if ($garbage_truck_result && mysqli_num_rows($garbage_truck_result) > 0) {
        $garbage_truck_row = mysqli_fetch_assoc($garbage_truck_result);
        $garbage_truck_id = $garbage_truck_row['id'];

        // Perform the database update
        $query = "UPDATE fuel_slips SET 
                    driver_id='$driver_id', 
                    staff_id='$staff_id', 
                    truck_id='$garbage_truck_id', 
                    vehicle='$vehicle', 
                    fuelType='$fuelType', 
                    fuelAmount='$fuelAmount', 
                    status='$status' 
                  WHERE id='$slipId'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            // Success message
            $_SESSION['message'] = "Fuel slip updated successfully.";
            header('Location: fuels.php');
            exit();
        } else {
            // Error message
            $_SESSION['message_danger'] = "Failed to update fuel slip.";
            header('Location: fuels.php');
            exit();
        }
    } else {
        // The driver_id doesn't exist in the garbage_trucks table
        $_SESSION['message_danger'] = "No assigned truck. The driver currently has no associated garbage trucks.";
        header('Location: fuels.php');
        exit();
    }
} else {
    // Redirect to the appropriate page if the form is not submitted
    header("Location: fuels.php");
    exit();
}

} else {
header("Location: ../login.php");
exit();
}
?>
