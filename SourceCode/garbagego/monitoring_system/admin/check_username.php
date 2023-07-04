<?php
require '../db_conn.php';

if (isset($_POST['username'])) {
    $username = $_POST['username'];

    // Check if the username already exists in staffs table
    $staffsQuery = "SELECT * FROM staffs WHERE user_name = '$username'";
    $staffsResult = mysqli_query($conn, $staffsQuery);

    // Check if the username already exists in drivers table
    $driversQuery = "SELECT * FROM drivers WHERE user_name = '$username'";
    $driversResult = mysqli_query($conn, $driversQuery);

    // Check if the username exists in either table
    $isAvailable = mysqli_num_rows($staffsResult) === 0 && mysqli_num_rows($driversResult) === 0;

    // Return the result as JSON
    echo json_encode(['available' => $isAvailable]);
}
?>
