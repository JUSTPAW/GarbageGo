<?php
session_start();

// Database configuration
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'garbagego';

// Convert tables to JSON file
function convertToJSON($tables) {
    $conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }
    
    $data = [];
    
    foreach ($tables as $table) {
        $sql = "SELECT * FROM $table";
        $result = $conn->query($sql);
    
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[$table][] = $row;
            }
        } else {
            $data[$table] = []; // Assign an empty array if the table has no data
        }
    }
    
    $jsonData = json_encode($data, JSON_PRETTY_PRINT);
    $file = 'users.json';
    file_put_contents($file, $jsonData);
    
    $conn->close();
    
    echo 'Conversion to JSON completed and saved to ' . $file;
}

// Convert tables to JSON
$tables = ['admins', 'staffs', 'drivers']; // Specify the table names
convertToJSON($tables);

// Function to authenticate the user and determine the role
function authenticate($user_name, $password) {
    $config = json_decode(file_get_contents('users.json'), true);
    
    if (isset($config['admins'], $config['staffs'], $config['drivers'])) {
        $users = array_merge($config['admins'], $config['staffs'], $config['drivers']);
        
        foreach ($users as $user) {
            if ($user['user_name'] === $user_name && $user['password'] === $password) {
                $_SESSION['role'] = $user['role']; // Set the role in the session
                return true;
            }
        }
    }
    
    return false;
}

// Process the login form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

    if (authenticate($user_name, $password)) {
        header('Location: dashboard.php'); // Redirect to the dashboard or home page
        exit();
    } else {
        $error = 'Invalid username or password';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <?php if (isset($error)) { ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php } ?>
    <form method="post" action="">
        <label>Username:</label>
        <input type="text" name="user_name" required><br>
        <label>Password:</label>
        <input type="password" name="password" required><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
