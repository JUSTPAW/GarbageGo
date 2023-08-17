<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name']) && isset($_SESSION['role']) && $_SESSION['role'] == 'staff') {
    require '../db_conn.php';

    if (isset($_POST['edit_account'])) {
        $staffId = $_POST['edit_staff_id'];
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
        $user_name = $_POST['edit_username'];

        // Escape special characters in variables
        $staffId = mysqli_real_escape_string($conn, $staffId);
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
        $user_name = mysqli_real_escape_string($conn, $user_name);

        // Check if user_name is changed
        if ($_SESSION['user_name'] !== $user_name) {
            // New username is different, so check if it's already in use
            $sql_username_check = "SELECT user_name FROM staffs WHERE user_name='$user_name' UNION SELECT user_name FROM staffs WHERE user_name='$user_name'";
            $result_username_check = mysqli_query($conn, $sql_username_check);

            if (mysqli_num_rows($result_username_check) > 0) {
                // New username is already in use
                $_SESSION['message_danger'] = "Username is already taken.";
                header('Location: profile.php');
                exit();
            }
        }

        // Perform the database update (regardless of whether the username is changed)
        $query = "UPDATE staffs SET 
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
                    street='$street', 
                    user_name='$user_name' 
                  WHERE id='$staffId'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            // Success message
            $_SESSION['message'] = "Profile updated successfully.";

            if ($_SESSION['user_name'] !== $user_name) {
                // If the username was updated, redirect to login.php
                header("Location: ../login.php?success=Username updated successfully! Please log in with your new username.");
                exit();
            } else {
                // If the username was not updated, redirect to profile.php
                header("Location: profile.php");
                exit();
            }
        } else {
            // Error message
            $_SESSION['message_danger'] = "Failed to update profile.";
            header('Location: profile.php');
            exit();
        }
    } else {
        // Redirect to the appropriate page if the form is not submitted
        header("Location: profile.php");
        exit();
    }
} else {
    header("Location: ../login.php");
    exit();
}
?>
