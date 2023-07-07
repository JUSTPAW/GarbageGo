<?php
// Start session and include database connection file
session_start();
include "db_conn.php";

// Validate and sanitize input data
function validate($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Check if all required fields are set
if (
    isset($_POST['user_name']) &&
    isset($_POST['password']) &&
    isset($_POST['firstName']) &&
    isset($_POST['lastName']) &&
    isset($_POST['middleName']) &&
    isset($_POST['phone']) &&
    isset($_POST['email']) &&
    isset($_POST['confirm_password']) &&
    isset($_POST['role'])
) {
    // Get input data and validate/sanitize it
    $uname = validate($_POST['user_name']);
    $pass = validate($_POST['password']);
    $re_pass = validate($_POST['confirm_password']);
    $firstName = validate($_POST['firstName']);
    $lastName = validate($_POST['lastName']);
    $middleName = validate($_POST['middleName']);
    $phone = validate($_POST['phone']);
    $email = validate($_POST['email']);
    $role = validate($_POST['role']);

    // Set up a user_data string for error messages
    $user_data = 'uname=' . $uname . '&firstName=' . $firstName . '&lastName=' . $lastName . '&middleName=' . $middleName;

    // Check for missing input data and redirect with error message if necessary
    if (empty($firstName)) {
        header("Location: signup.php?error=First Name is required&$user_data");
        exit();
    } else if (empty($middleName)) {
        header("Location: signup.php?error=Middle Initial is required&$user_data");
        exit();
    } else if (empty($lastName)) {
        header("Location: signup.php?error=Last Name is required&$user_data");
        exit();
    } else if (empty($uname)) {
        header("Location: signup.php?error=User Name is required&$user_data");
        exit();
    } else if (empty($pass)) {
        header("Location: signup.php?error=Password is required&$user_data");
        exit();
    } else if (empty($re_pass)) {
        header("Location: signup.php?error=Re Password is required&$user_data");
        exit();
    } else if ($pass !== $re_pass) {
        header("Location: signup.php?error=The confirmation password does not match&$user_data");
        exit();
    } else if (
        !preg_match('/[A-Z]/', $pass) ||
        !preg_match('/[a-z]/', $pass) ||
        !preg_match('/[0-9]/', $pass) ||
        !preg_match('/[_\-#]/', $pass) ||
        strlen($pass) < 8
    ) {
        // Check password strength and redirect with error message if necessary
        header("Location: signup.php?error=Password should be at least 8 characters in length and should include at least one uppercase letter, one number, one special character.&$user_data");
        exit();
    } else {
        // Hash the password and sanitize the remaining input data
        $pass = md5($pass);
        $phone = mysqli_real_escape_string($conn, $phone);
        $email = mysqli_real_escape_string($conn, $email);

        // Check if the entered personal details match any existing employee in staffs or drivers table
        $sql_check = "SELECT * FROM staffs WHERE firstname='$firstName' AND lastname='$lastName' AND middlename='$middleName' AND phone='$phone' UNION SELECT * FROM drivers WHERE firstname='$firstName' AND lastname='$lastName' AND middlename='$middleName' AND phone='$phone'";
        $result_check = mysqli_query($conn, $sql_check);

        if (mysqli_num_rows($result_check) > 0) {
            // Personal details match an existing employee
            // Update the username, password, and role

            // Update data based on the selected role
            if ($role === 'staff') {
                $sql_update = "UPDATE staffs SET user_name='$uname', password='$pass', role='$role', email='$email' 
                        WHERE firstname='$firstName' AND lastname='$lastName' AND middlename='$middleName' AND phone='$phone'";

            } else if ($role === 'driver') {
                $sql_update = "UPDATE drivers SET user_name='$uname', password='$pass', role='$role', email='$email' 
                        WHERE firstname='$firstName' AND lastname='$lastName' AND middlename='$middleName' AND phone='$phone'";
            } else {
                header("Location: signup.php?error=Invalid role selected.&$user_data");
                exit();
            }

            $result_update = mysqli_query($conn, $sql_update);
            if ($result_update) {
                header("Location: login.php?success=Your account has been created successfully");
                exit();
            } else {
                header("Location: signup.php?error=Unknown error occurred&$user_data");
                exit();
            }
        } else {
            // Personal details don't match any registered employee
            header("Location: signup.php?error=The personal details don't match any registered employee.&$user_data");
            exit();
        }
    }
} else {
    header("Location: signup.php");
    exit();
}
?>
