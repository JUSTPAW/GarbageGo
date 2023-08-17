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

            if ($role === 'staff' || $role === 'driver' || $role === 'admin') {
                // Add all values to the session
                $_SESSION['id'] = $row['id'];
                $_SESSION['firstName'] = $row['firstName'];
                $_SESSION['middleName'] = $row['middleName'];
                $_SESSION['lastName'] = $row['lastName'];
                $_SESSION['position'] = $row['position'];
                $_SESSION['birthday'] = $row['birthday'];
                $_SESSION['gender'] = $row['gender'];
                $_SESSION['phone'] = $row['phone'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['province'] = $row['province'];
                $_SESSION['city'] = $row['city'];
                $_SESSION['barangay'] = $row['barangay'];
                $_SESSION['street'] = $row['street'];
                $_SESSION['user_name'] = $row['user_name'];
                $_SESSION['role'] = $role;
                $_SESSION['image'] = $row['image'];
                $_SESSION['dateCreated'] = $row['dateCreated'];

                $successMessage = "Welcome " . $row['firstName'] . " " . $row['lastName'] . "!";
                if ($role === 'staff') {
                    header("Location: staff/staff_dashboard.php?success=" . urlencode($successMessage));
                } else if ($role === 'driver') {
                    header("Location: driver/driver_dashboard.php?success=" . urlencode($successMessage));
                } else if ($role === 'admin') {
                    header("Location: admin/admin_dashboard.php?success=" . urlencode($successMessage));
                }
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
