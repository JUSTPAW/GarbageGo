<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['user_name']) && isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {

    require '../db_conn.php';

    if (isset($_POST['delete_driver_id'])) {
        $driverId = $_POST['delete_driver_id'];
        $driverId = mysqli_real_escape_string($conn, $driverId);

        // Perform the necessary delete operation using the $driverId
        $deleteQuery = "DELETE FROM drivers WHERE id = $driverId";
        $deleteResult = mysqli_query($conn, $deleteQuery);

        if ($deleteResult) {
            $_SESSION['message'] = "Driver deleted successfully.";
            header('Location: drivers.php');
            exit();
        } else {
            $_SESSION['message_danger'] = "Error deleting driver.";
            header('Location: drivers.php');
            exit();
        }
    }

    // Add Driver member
    if (isset($_POST['add_driver'])) {
        // Retrieve form data
        $firstName = $_POST['firstName'];
        $middleName = $_POST['middleName'];
        $lastName = $_POST['lastName'];
        $position = $_POST['position'];
        $birthday = $_POST['birthday'];
        $gender = $_POST['gender'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $province = $_POST['province'];
        $city = $_POST['city'];
        $barangay = $_POST['barangay'];
        $street = $_POST['street'];
        $staff_id = $_POST['staff_id'];

        // Escape special characters in variables
        $firstName = mysqli_real_escape_string($conn, $firstName);
        $middleName = mysqli_real_escape_string($conn, $middleName);
        $lastName = mysqli_real_escape_string($conn, $lastName);
        $position = mysqli_real_escape_string($conn, $position);
        $birthday = mysqli_real_escape_string($conn, $birthday);
        $gender = mysqli_real_escape_string($conn, $gender);
        $phone = mysqli_real_escape_string($conn, $phone);
        $email = mysqli_real_escape_string($conn, $email);
        $province = mysqli_real_escape_string($conn, $province);
        $city = mysqli_real_escape_string($conn, $city);
        $barangay = mysqli_real_escape_string($conn, $barangay);
        $street = mysqli_real_escape_string($conn, $street);
        $staff_id = mysqli_real_escape_string($conn, $staff_id);

        // Check if the plate number already exists
        $checkQuery = "SELECT * FROM drivers WHERE phone = '$phone'";
        $checkResult = mysqli_query($conn, $checkQuery);
        if (mysqli_num_rows($checkResult) > 0) {
            // Error message
            $_SESSION['message_danger'] = "Driver with phone number $phone already exists.";
            header('Location: drivers.php');
            exit(); // Stop further execution
        }

        // Perform the database insertion
        $query = "INSERT INTO drivers (firstName, middleName, lastName, position, birthday, gender, phone, email, province, city, barangay, street, staff_id) 
                  VALUES ('$firstName', '$middleName', '$lastName', '$position', '$birthday', '$gender', '$phone', '$email', '$province', '$city', '$barangay', '$street', '$staff_id')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            // Success message
            $_SESSION['message'] = "Driver added successfully.";
            header('Location: drivers.php');
            exit();
        } else {
            // Error message
            $_SESSION['message_danger'] = "Error occurred while adding the driver.";
            header('Location: drivers.php');
            exit();
        }
    }
    
// edit Driver
    if (isset($_POST['edit_driver'])) {
        $driverId = $_POST['edit_driver_id'];
        $firstName = $_POST['edit_firstName'];
        $middleName = $_POST['edit_middleName'];
        $lastName = $_POST['edit_lastName'];
        $position = $_POST['edit_position'];
        $birthday = $_POST['edit_birthday'];
        $gender = $_POST['edit_gender'];
        $phone = $_POST['edit_phone'];
        $email = $_POST['edit_email'];
        $province = $_POST['edit_province'];
        $city = $_POST['edit_city'];
        $barangay = $_POST['edit_barangay'];
        $street = $_POST['edit_street'];

        // Escape special characters in variables
        $driverId = mysqli_real_escape_string($conn, $driverId);
        $firstName = mysqli_real_escape_string($conn, $firstName);
        $middleName = mysqli_real_escape_string($conn, $middleName);
        $lastName = mysqli_real_escape_string($conn, $lastName);
        $position = mysqli_real_escape_string($conn, $position);
        $birthday = mysqli_real_escape_string($conn, $birthday);
        $gender = mysqli_real_escape_string($conn, $gender);
        $phone = mysqli_real_escape_string($conn, $phone);
        $email = mysqli_real_escape_string($conn, $email);
        $province = mysqli_real_escape_string($conn, $province);
        $city = mysqli_real_escape_string($conn, $city);
        $barangay = mysqli_real_escape_string($conn, $barangay);
        $street = mysqli_real_escape_string($conn, $street);

        // Check if the updated plate number already exists for a different truck
        $checkQuery = "SELECT * FROM drivers WHERE phone = '$phone' AND id != '$driverId'";
        $checkResult = mysqli_query($conn, $checkQuery);
        if (mysqli_num_rows($checkResult) > 0) {
            // Error message
            $_SESSION['message_danger'] = "Driver with phone number $phone already exists.";
            header('Location: drivers.php');
            exit(); // Stop further execution
        }

        // Perform the database update
        $query = "UPDATE drivers SET 
                    firstName='$firstName', 
                    middleName='$middleName', 
                    lastName='$lastName', 
                    position='$position', 
                    birthday='$birthday', 
                    gender='$gender', 
                    phone='$phone', 
                    email='$email', 
                    province='$province', 
                    city='$city', 
                    barangay='$barangay', 
                    street='$street' 
                  WHERE id='$driverId'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            // Success message
            $_SESSION['message'] = "Driver updated successfully.";
            header('Location: drivers.php');
            exit();
        } else {
            // Error message
            $_SESSION['message_danger'] = "Failed to update driver.";
            header('Location: drivers.php');
            exit();
        }
    } else {
        // Redirect to the appropriate page if the form is not submitted
        header("Location: drivers.php");
        exit();
    }

} else {
header("Location: ../login.php");
exit();
}
?>
