<?php
session_start();
include("db_conn.php");

if (isset($_POST['uname']) && isset($_POST['password'])) {

    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $uname = validate($_POST['uname']);
    $pass = validate($_POST['password']);

    if (empty($uname)) {
        header("Location: login.php?error=Username is required!");
        exit();
    } else if (empty($pass)) {
        header("Location: login.php?error=Password is required!");
        exit();
    } else {

        // hashing the password
        $pass = md5($pass);

        $sql = "SELECT id, firstName, middleName, lastName, position, birthday, gender, phone, email, province, city, barangay, street, user_name, password, role, image, dateCreated 
        FROM staffs 
        WHERE user_name='$uname' AND password='$pass' 
        UNION 
        SELECT id, firstName, middleName, lastName, position, birthday, gender, phone, email, province, city, barangay, street, user_name, password, role, image, dateCreated 
        FROM drivers 
        WHERE user_name='$uname' AND password='$pass'
        UNION 
        SELECT id, firstName, middleName, lastName, position, birthday, gender, phone, email, province, city, barangay, street, user_name, password, role, image, dateCreated 
        FROM admins 
        WHERE user_name='$uname' AND password='$pass'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            $role = $row['role'];

            // Check if the role is valid or allowed
            // You can add your own logic here to validate the role

            if ($role === 'staff') {
                $_SESSION['id'] = $row['id'];
                $_SESSION['user_name'] = $row['user_name'];
                $_SESSION['role'] = $role;
                $successMessage = "Welcome " . $row['firstName'] . " " . $row['lastName'] . "!";
                header("Location: staff/staff_dashboard.php?success=" . urlencode($successMessage));
                exit();
            } else if ($role === 'driver') {
                $_SESSION['id'] = $row['id'];
                $_SESSION['user_name'] = $row['user_name'];
                $_SESSION['role'] = $role;
                $successMessage = "Welcome " . $row['firstName'] . " " . $row['lastName'] . "!";
                header("Location: driver/driver_dashboard.php?success=" . urlencode($successMessage));
                exit();
            } else if ($role === 'admin') {
                $_SESSION['id'] = $row['id'];
                $_SESSION['user_name'] = $row['user_name'];
                $_SESSION['role'] = $role;
                $successMessage = "Welcome " . $row['firstName'] . " " . $row['lastName'] . "!";
                header("Location: admin/admin_dashboard.php?success=" . urlencode($successMessage));
                exit();
            } else {
                header("Location: login.php?error=Invalid role!");
                exit();
            }
        } else {
            header("Location: login.php?error=Incorrect username or password!");
            exit();
        }
    }
} else {
    header("Location: login.php?error");
    exit();
}
?>
