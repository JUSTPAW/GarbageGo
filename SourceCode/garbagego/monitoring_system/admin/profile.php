<?php
session_start();
// Check if the necessary session variables are set and the user role is 'admin'
if (isset($_SESSION['id']) && isset($_SESSION['user_name']) && isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {

  // Regenerate the session ID
  session_regenerate_id();

  // Include the necessary files and establish database connection
  include('../includes/header.php');
  include('../includes/navbar_admin.php');
  require '../db_conn.php';

// Check if the user is logged in and session data exists
if (isset($_SESSION['user_data'])) {
    $userData = $_SESSION['user_data'];

    // Access individual fields from the user data
    $id = $userData['id'];
    $firstName = $userData['firstName'];
    $middleName = $userData['middleName'];
    $lastName = $userData['lastName'];
    $position = $userData['position'];
    $birthday = $userData['birthday'];
    $gender = $userData['gender'];
    $phone = $userData['phone'];
    $email = $userData['email'];
    $province = $userData['province'];
    $city = $userData['city'];
    $barangay = $userData['barangay'];
    $street = $userData['street'];
    $user_name = $userData['user_name'];
    $role = $userData['role'];
    $image = $userData['image'];
    $dateCreated = $userData['dateCreated'];

    // Display the data
    echo "ID: $id<br>";
    echo "First Name: $firstName<br>";
    echo "Middle Name: $middleName<br>";
    echo "Last Name: $lastName<br>";
    echo "Position: $position<br>";
    echo "Birthday: $birthday<br>";
    echo "Gender: $gender<br>";
    echo "Phone: $phone<br>";
    echo "Email: $email<br>";
    echo "Province: $province<br>";
    echo "City: $city<br>";
    echo "Barangay: $barangay<br>";
    echo "Street: $street<br>";
    echo "Username: $user_name<br>";
    echo "Role: $role<br>";
    echo "Image: $image<br>";
    echo "Date Created: $dateCreated<br>";
} else {
    echo "User data not found!";
}

} else {
    header("Location: ../login.php");
    exit();
}
?>
<?php
include('../includes/scripts.php');
include('../includes/footer.php');
?>