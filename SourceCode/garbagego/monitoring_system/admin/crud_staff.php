<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['user_name']) && isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {

require '../db_conn.php';

    if (isset($_POST['delete_staff_id'])) {
        $crewId = $_POST['delete_staff_id'];
        $crewId = mysqli_real_escape_string($conn, $crewId);

        // Perform the necessary delete operation using the $crewId
        $deleteQuery = "DELETE FROM staffs WHERE id = $crewId";
        $deleteResult = mysqli_query($conn, $deleteQuery);

        if ($deleteResult) {
            $_SESSION['message'] = "Staffs deleted successfully.";
            header('Location: staffs.php');
            exit();
        } else {
            $_SESSION['message_danger'] = "Error deleting staffs.";
            header('Location: staffs.php');
            exit();
        }
    }

    // Add staff
    if (isset($_POST['add_staff'])) {
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

        // Perform the database insertion
        $query = "INSERT INTO staffs (firstName, middleName, lastName, position, birthday, gender, phone, email, province, city, barangay, street) 
                  VALUES ('$firstName', '$middleName', '$lastName', '$position', '$birthday', '$gender', '$phone', '$email', '$province', '$city', '$barangay', '$street')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            // Success message
            $_SESSION['message'] = "Staff added successfully.";
            header('Location: staffs.php');
            exit();
        } else {
            // Error message
            $_SESSION['message_danger'] = "Error occurred while adding the staff.";
            header('Location: staffs.php');
            exit();
        }
    }
    
// edit staff
    if (isset($_POST['edit_staff'])) {
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

        // Perform the database update
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
                    street='$street' 
                  WHERE id='$staffId'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            // Success message
            $_SESSION['message'] = "Staff updated successfully.";
            header('Location: staffs.php');
            exit();
        } else {
            // Error message
            $_SESSION['message_danger'] = "Failed to update staff.";
            header('Location: staffs.php');
            exit();
        }
    } else {
        // Redirect to the appropriate page if the form is not submitted
        header("Location: staffs.php");
        exit();
    }

} else {
header("Location: ../login.php");
exit();
}
?>
