<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['user_name']) && isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {

require '../db_conn.php';

    if (isset($_POST['delete_location_id'])) {
        $locationId = $_POST['delete_location_id'];
        $locationId = mysqli_real_escape_string($conn, $locationId);

        // Perform the necessary delete operation using the $truckId
        $deleteQuery = "DELETE FROM locations WHERE id = $locationId";
        $deleteResult = mysqli_query($conn, $deleteQuery);

        if ($deleteResult) {
            $_SESSION['message'] = "Locations deleted successfully.";
            header('Location: locations.php');
            exit();
        } else {
            $_SESSION['message_danger'] = "Error deleting location.";
            header('Location: locations.php');
            exit();
        }
    }

    // Add location
    if (isset($_POST['add_location'])) {
        // Retrieve form data
        $location = $_POST['location'];
        $latitude = $_POST['latitude'];
        $longitude = $_POST['longitude'];
       
        // Escape special characters in variables
        $location = mysqli_real_escape_string($conn, $location);
        $latitude = mysqli_real_escape_string($conn, $latitude);
        $longitude = mysqli_real_escape_string($conn, $longitude);

        // Perform the database insertion
        $query = "INSERT INTO locations (location, latitude, longitude) 
                  VALUES ('$location', '$latitude', '$longitude')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            // Success message
            $_SESSION['message'] = "Location added successfully.";
            header('Location: locations.php');
            exit();
        } else {
            // Error message
            $_SESSION['message_danger'] = "Error occurred while adding the location.";
            header('Location: locations.php');
            exit();
        }
    }
    
    // edit crew member
    if (isset($_POST['edit_loc'])) {
    $location_id = $_POST['edit_location_id'];
    $location = $_POST['edit_location'];

    // Escape special characters in variables
    $location_id = mysqli_real_escape_string($conn, $location_id);
    $location = mysqli_real_escape_string($conn, $location);

    // Check if the updated plate number already exists for a different truck
    $checkQuery = "SELECT * FROM locations WHERE location = '$location' AND id != '$location_id'";
    $checkResult = mysqli_query($conn, $checkQuery);
    if (mysqli_num_rows($checkResult) > 0) {
        // Error message
        $_SESSION['message_danger'] = "$location is already added";
        header('Location: locations.php');
        exit(); // Stop further execution
    }

    // Perform the database update
    $query = "UPDATE locations SET location='$location' WHERE id='$location_id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Success message
        $_SESSION['message'] = "Garbage truck updated successfully.";
        header('Location: locations.php');
    } else {
        // Error message
        $_SESSION['message_danger'] = "Failed to update garbage truck.";
        header('Location: locations.php');
    }
} else {
    // Redirect to the appropriate page if the form is not submitted
    header("Location: locations.php");
    exit();
}



} else {
header("Location: ../login.php");
exit();
}
?>
