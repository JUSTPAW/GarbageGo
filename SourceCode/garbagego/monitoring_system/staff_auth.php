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
        header("Location: admin_login.php?error=Username is required!");
        exit();
    } else if (empty($pass)) {
        header("Location: admin_login.php?error=Password is required!");
        exit();
    } else {

        // hashing the password
        $pass = md5($pass);

        $sql = "SELECT * FROM admins WHERE user_name='$uname' AND password='$pass'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row['role'] === $role) {
                $_SESSION['user_data'] = $row; // Store all data in session

                // Remember Me functionality
                if (isset($_POST['remember_me']) && $_POST['remember_me'] === 'on') {
                    // Set a cookie to store the username for 30 days
                    setcookie("remembered_user", $uname, time() + (30 * 24 * 60 * 60));
                } else {
                    // If the Remember Me checkbox is unchecked, remove the stored cookie if it exists
                    if (isset($_COOKIE['remembered_user'])) {
                        setcookie("remembered_user", "", time() - 3600);
                    }
                }

                // Perform role-specific actions
                if ($role === 'staff') {
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
                header("Location: admin_login.php?error=Incorrect username, password, or role!");
                exit();
            }
        } else {
            header("Location: admin_login.php?error=Incorrect username, password, or role!");
            exit();
        }
    }
} else {
    header("Location: admin_login.php?error");
    exit();
}
?>
