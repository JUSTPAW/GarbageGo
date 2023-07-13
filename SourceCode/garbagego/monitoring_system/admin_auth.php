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

        $sql = "SELECT * FROM admins WHERE user_name='$uname' AND password='$pass' AND role='$role'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['id'] = $row['id'];
            $_SESSION['user_name'] = $row['user_name'];
            $_SESSION['role'] = $row['role'];

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

            header("Location: admin_login.php?success_message=Login successful.");
            exit();
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
