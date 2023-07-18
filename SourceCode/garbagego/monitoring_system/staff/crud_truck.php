<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['user_name']) && isset($_SESSION['role']) && $_SESSION['role'] == 'staff') {

require '../db_conn.php';

    if (isset($_POST['delete_truck_id'])) {
        $truckId = $_POST['delete_truck_id'];
        $truckId = mysqli_real_escape_string($conn, $truckId);

        // Perform the necessary delete operation using the $truckId
        $deleteQuery = "DELETE FROM garbage_trucks WHERE id = $truckId";
        $deleteResult = mysqli_query($conn, $deleteQuery);

        if ($deleteResult) {
            $_SESSION['message'] = "Garbage truck deleted successfully.";
            header('Location: garbage_trucks.php');
            exit();
        } else {
            $_SESSION['message_danger'] = "Error deleting garbage truck.";
            header('Location: garbage_trucks.php');
            exit();
        }
    }

    if (isset($_POST['add_truck'])) {
        $brand = $_POST['brand'];
        $model = $_POST['model'];
        $capacity = $_POST['capacity'];
        $plateNumber = $_POST['plateNumber'];

        // Escape special characters in variables
        $brand = mysqli_real_escape_string($conn, $brand);
        $model = mysqli_real_escape_string($conn, $model);
        $capacity = mysqli_real_escape_string($conn, $capacity);
        $plateNumber = mysqli_real_escape_string($conn, $plateNumber);

        // Perform the database insertion
        $query = "INSERT INTO garbage_trucks (brand, model, capacity, plateNumber) VALUES ('$brand', '$model', '$capacity', '$plateNumber')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            // Success message
            $_SESSION['message'] = "Garbage truck added successfully.";
            header('Location: garbage_trucks.php');
        } else {
            // Error message
            $_SESSION['message_danger'] = "Error occurred while adding the garbage truck.";
            header('Location: garbage_trucks.php');
        }
    }
    

    if (isset($_POST['edit_truck'])) {
        $truck_id = $_POST['edit_truck_id'];
        $brand = $_POST['edit_brand'];
        $model = $_POST['edit_model'];
        $capacity = $_POST['edit_capacity'];
        $plateNumber = $_POST['edit_plateNumber'];

        // Escape special characters in variables
        $truck_id = mysqli_real_escape_string($conn, $truck_id);
        $brand = mysqli_real_escape_string($conn, $brand);
        $model = mysqli_real_escape_string($conn, $model);
        $capacity = mysqli_real_escape_string($conn, $capacity);
        $plateNumber = mysqli_real_escape_string($conn, $plateNumber);

        // Perform the database update
        $query = "UPDATE garbage_trucks SET brand='$brand', model='$model', capacity='$capacity', plateNumber='$plateNumber' WHERE id='$truck_id'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            // Success message
            $_SESSION['message'] = "Garbage truck updated successfully.";
            header('Location: garbage_trucks.php');
        } else {
            // Error message
            $_SESSION['message_danger'] = "Failed to update garbage truck.";
            header('Location: garbage_trucks.php');
        }
    } else {
        // Redirect to the appropriate page if the form is not submitted
        header("Location: garbage_trucks.php");
        exit();
    }


} else {
header("Location: ../admin_login.php");
exit();
}
?>
