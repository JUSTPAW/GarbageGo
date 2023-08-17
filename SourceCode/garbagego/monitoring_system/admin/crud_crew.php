<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['user_name']) && isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {

require '../db_conn.php';

    if (isset($_POST['delete_crew_id'])) {
        $crewId = $_POST['delete_crew_id'];
        $crewId = mysqli_real_escape_string($conn, $crewId);

        // Perform the necessary delete operation using the $crewId
        $deleteQuery = "DELETE FROM crew_members WHERE id = $crewId";
        $deleteResult = mysqli_query($conn, $deleteQuery);

        if ($deleteResult) {
            $_SESSION['message'] = "Crew member deleted successfully.";
        } else {
            $_SESSION['message_danger'] = "Error deleting crew member.";
        }
    }

    // Add crew member
    if (isset($_POST['add_crew_member'])) {
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
        $checkQuery = "SELECT * FROM crew_members WHERE phone = '$phone'";
        $checkResult = mysqli_query($conn, $checkQuery);
        if (mysqli_num_rows($checkResult) > 0) {
            // Error message
            $_SESSION['message_danger'] = "Crew Member with phone number $phone already exists.";
            header('Location: crew_members.php');
            exit(); // Stop further execution
        }

        // Perform the database insertion
        $query = "INSERT INTO crew_members (firstName, middleName, lastName, position, birthday, gender, phone, email, province, city, barangay, street, staff_id) 
                  VALUES ('$firstName', '$middleName', '$lastName', '$position', '$birthday', '$gender', '$phone', '$email', '$province', '$city', '$barangay', '$street', '$staff_id')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            // Success message
            $_SESSION['message'] = "Crew Member added successfully.";
            header('Location: crew_members.php');
            exit();
        } else {
            // Error message
            $_SESSION['message_danger'] = "Error occurred while adding the crew member.";
            header('Location: crew_members.php');
            exit();
        }
    }
    
// edit crew member
    if (isset($_POST['edit_crew_member'])) {
        $crewId = $_POST['edit_crew_id'];
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
        $crewId = mysqli_real_escape_string($conn, $crewId);
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
        $checkQuery = "SELECT * FROM crew_members WHERE phone = '$phone' AND id != '$crewId'";
        $checkResult = mysqli_query($conn, $checkQuery);
        if (mysqli_num_rows($checkResult) > 0) {
            // Error message
            $_SESSION['message_danger'] = "Crew member with phone number $phone already exists.";
            header('Location: crew_members.php');
            exit(); // Stop further execution
        }

        // Perform the database update
        $query = "UPDATE crew_members SET 
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
                  WHERE id='$crewId'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            // Success message
            $_SESSION['message'] = "Crew member updated successfully.";
            header('Location: crew_members.php');
            exit();
        } else {
            // Error message
            $_SESSION['message_danger'] = "Failed to update crew member.";
            header('Location: crew_members.php');
            exit();
        }
    } else {
        // Redirect to the appropriate page if the form is not submitted
        header("Location: crew_members.php");
        exit();
    }


} else {
header("Location: ../admin_login.php");
exit();
}
?>
