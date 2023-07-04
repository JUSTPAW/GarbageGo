<?php
session_start();
require '../db_conn.php';

if (isset($_POST['add_account'])) {
    $firstName = $_POST['firstName'];
    $middleName = $_POST['middleName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $username = $_POST['uname'];
    $role = $_POST['role'];
    $password = $_POST['password'];
    $repassword = $_POST['re_password'];

    // Add any necessary validation and sanitization of the input values

    // Check if the username already exists
    $checkQuery = "SELECT * FROM staffs WHERE user_name = '$username'";
    $checkResult = mysqli_query($conn, $checkQuery);
    if (mysqli_num_rows($checkResult) > 0) {
        $_SESSION['message_danger'] = "Username already exists!";
        header("Location: accounts.php");
        exit();
    }

    // Validate the password
    $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&_#^+=(){}[\]|\\:;"\'<>,.~`_]).{8,}$/';
    if (!preg_match($pattern, $password)) {
        $_SESSION['message_danger'] = "Invalid password! Password must contain at least one lowercase letter, one uppercase letter, one digit, one special character, and be at least 8 characters long.";
        header("Location: accounts.php");
        exit();
    }

    // Check if the password and re-entered password match
    if ($password !== $repassword) {
        $_SESSION['message_danger'] = "Passwords do not match!";
        header("Location: accounts.php");
        exit();
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert the new account into the appropriate table based on the selected role
    if ($role === 'staff') {
        $insertQuery = "INSERT INTO staffs (firstName, middleName, lastName, email, phone, user_name, role, password)
                        VALUES ('$firstName', '$middleName', '$lastName', '$email', '$phone', '$username', '$role', '$hashedPassword')";
    } elseif ($role === 'driver') {
        $insertQuery = "INSERT INTO drivers (firstName, middleName, lastName, email, phone, user_name, role, password)
                        VALUES ('$firstName', '$middleName', '$lastName', '$email', '$phone', '$username', '$role', '$hashedPassword')";
    } else {
        $_SESSION['message_danger'] = "Invalid role selected!";
        header("Location: account.php");
        exit();
    }

    $insertResult = mysqli_query($conn, $insertQuery);

    if ($insertResult) {
        $_SESSION['message'] = "Account added successfully!";
        header("Location: accounts.php");
        exit();
    } else {
        $_SESSION['message_danger'] = "Failed to add account!";
        header("Location: accounts.php");
        exit();
    }
} else {
    header("Location: admin.php");
    exit();
}
?>
