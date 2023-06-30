<?php
session_start();
include("db_conn.php");

if (isset($_POST['uname']) && isset($_POST['password']) && isset($_POST['role'])) {

    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $uname = validate($_POST['uname']);
    $pass = validate($_POST['password']);
    $role = validate($_POST['role']);

    if (empty($uname)) {
        header("Location: login.php?error=Username is required!");
        exit();
    } else if (empty($pass)) {
        header("Location: login.php?error=Password is required!");
        exit();
    } else {

        // hashing the password
        $pass = md5($pass);

        $sql = "SELECT * FROM admins WHERE user_name='$uname' AND password='$pass'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row['role'] === $role) {
                $_SESSION['user_name'] = $row['user_name'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['id'] = $row['id'];
                $_SESSION['role'] = $row['role'];

                // Perform role-specific actions
                if ($role === 'admin') {
                    header("Location: admin/admin.php");
                    exit();
                } else if ($role === 'staff') {
                    header("Location: staff/staff.php");
                    exit();
                } else if ($role === 'driver') {
                    header("Location: driver/driver.php");
                    exit();
                } else {
                    header("Location: login.php?error=Invalid role!");
                    exit();
                }
            } else {
                header("Location: login.php?error=Incorrect username, password, or role!");
                exit();
            }
        } else {
            header("Location: login.php?error=Incorrect username, password, or role!");
            exit();
        }
    }
} else {
    header("Location: login.php?error");
    exit();
}
?>
