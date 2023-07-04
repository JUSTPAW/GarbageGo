<!-- <!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Get Value from Textarea in jQuery</title>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script>
    $(document).ready(function(){
        $("button").click(function(){
            alert("Success");
            $("textarea").select();
            document.execCommand('copy');
        });
        
    });
</script>
</head>
<body>
    <textarea id="comment" rows="5" cols="50"></textarea>
    <p><button type="button">Get Value</button></p>
    <p><strong>Note:</strong> Type something in the textarea and click the button to see the result.</p>
</body>
</html>    -->

<!-- <!DOCTYPE html>
<html>
<head>
<style>
.grey{
background-color:grey;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
<input id="item_price" class="grey" value="100.00" disabled="disabled" />
<br>
<br>
<input type="button" id="Button" value="disable/enable" />
<script>
$(document).ready(function(){
$("#Button").click(function() {
$("#item_price").attr('disabled', !$("#item_price").attr('disabled'));
$("#item_price").removeClass("grey");
});
});
</script>
</body>
</html>
         -->



<!-- <!Doctype html>
<html>
<body>
    <head>
        <style>
            #frmCheckPassword {
                border-top: #F0F0F0 2px solid;
                background: #808080;
                padding: 10px;
            }

            .demoInputBox {
                padding: 7px;
                border: #F0F0F0 1px solid;
                border-radius: 4px;
            }

            #password-strength-status {
                padding: 5px 10px;
                color: #FFFFFF;
                border-radius: 4px;
                margin-top: 5px;
            }

            .medium-password {
                background-color: #b7d60a;
                border: #BBB418 1px solid;
            }

            .weak-password {
                background-color: #ce1d14;
                border: #AA4502 1px solid;
            }

            .strong-password {
                background-color: #12CC1A;
                border: #0FA015 1px solid;
            }
        </style>
    </head>
    <div name="frmCheckPassword" id="frmCheckPassword">
        <label>Password:</label>
        <input type="password" name="password" id="password" class="demoInputBox" onKeyUp="checkPasswordStrength();" />
        <div id="password-strength-status"></div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
        function checkPasswordStrength() {
            var number = /([0-9])/;
            var alphabets = /([a-zA-Z])/;
            var special_characters = /([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/;
            if ($('#password').val().length < 6) {
                $('#password-strength-status').removeClass();
                $('#password-strength-status').addClass('weak-password');
                $('#password-strength-status').html("Weak (should be atleast 6 characters.)");
            } else {
                if ($('#password').val().match(number) && $('#password').val().match(alphabets) && $('#password').val().match(special_characters)) {
                    $('#password-strength-status').removeClass();
                    $('#password-strength-status').addClass('strong-password');
                    $('#password-strength-status').html("Strong");
                } else {
                    $('#password-strength-status').removeClass();
                    $('#password-strength-status').addClass('medium-password');
                    $('#password-strength-status').html("Medium (should include alphabets, numbers and special characters.)");
                }
            }
        }
    </script>
</body>
</html> -->


<?php
session_start();
require '../db_conn.php';

// // Add garbage truck
//     if (isset($_POST['add_truck'])) {
//         $brand = $_POST['brand'];
//         $model = $_POST['model'];
//         $capacity = $_POST['capacity'];
//         $plateNumber = $_POST['plateNumber'];

//         // Perform the database insertion
//         $query = "INSERT INTO garbage_trucks (brand, model, capacity, plateNumber) VALUES ('$brand', '$model', '$capacity', '$plateNumber')";
//         $result = mysqli_query($conn, $query);

//         if ($result) {
//             // Success message
//             $_SESSION['message'] = "Garbage truck added successfully.";
//             header('Location: garbage_trucks.php');
//         } else {
//             // Error message
//             $_SESSION['message_danger'] = "Error occurred while adding the garbage truck.";
//             header('Location: garbage_trucks.php');
//         }
//     } else {
//         // Invalid access, redirect to the dashboard
//         header('Location: garbage_trucks.php');
//     }
// // Edit rarbage truck
//    if (isset($_POST['edit_truck'])) {
//         $truck_id = $_POST['edit_truck_id'];
//         $brand = $_POST['edit_brand'];
//         $model = $_POST['edit_model'];
//         $capacity = $_POST['edit_capacity']; // Fix the variable name here
//         $plateNumber = $_POST['edit_plateNumber'];

//         // Perform the database update
//         $query = "UPDATE garbage_trucks SET brand='$brand', model='$model', capacity='$capacity', plateNumber='$plateNumber' WHERE id='$truck_id'";
//         $result = mysqli_query($conn, $query);

//         if ($result) {
//             // Success message
//             $_SESSION['message'] = "Garbage truck updated successfully.";
//             header('Location: garbage_trucks.php');
//         } else {
//             // Error message
//             $_SESSION['message_danger'] = "Failed to update garbage truck.";
//             header('Location: garbage_trucks.php');
//         }
//     } else {
//         // Redirect to the appropriate page if the form is not submitted
//         header("Location: garbage_trucks.php");
//         exit();
//     }
// // Delete garbage truck
//     if (isset($_POST['delete_truck_id'])) {
//         $truckId = $_POST['delete_truck_id'];

//         // Perform the necessary delete operation using the $truckId
//         $deleteQuery = "DELETE FROM garbage_trucks WHERE id = $truckId";
//         $deleteResult = mysqli_query($conn, $deleteQuery);

//         if ($deleteResult) {
//             $_SESSION['message'] = "Garbage truck deleted successfully.";
//             header('Location: garbage_trucks.php');
//             exit();
//         } else {
//             $_SESSION['message_danger'] = "Error deleting garbage truck.";
//             header('Location: garbage_trucks.php');
//             exit();
//         }
//     }

//     // Delete Account
//     if (isset($_POST['delete_truck_id'])) {
//         $truckId = $_POST['delete_truck_id'];

//         // Perform the necessary delete operation using the $truckId
//         $deleteQuery = "DELETE FROM garbage_trucks WHERE id = $truckId";
//         $deleteResult = mysqli_query($conn, $deleteQuery);

//         if ($deleteResult) {
//             $_SESSION['message'] = "Garbage truck deleted successfully.";
//             header('Location: garbage_trucks.php');
//             exit();
//         } else {
//             $_SESSION['message_danger'] = "Error deleting garbage truck.";
//             header('Location: garbage_trucks.php');
//             exit();
//         }
//     }

        // // Add Crew Members
    if (isset($_POST['add_crew'])) {
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

        // Perform the database insertion
        $query = "INSERT INTO crew_members (firstName, middleName, lastName, position, birthday, gender, phone, email, province, city,barangay,street) 
                 VALUES ('$firstName', '$middleName', '$lastName', '$position', '$birthday', '$gender', '$phone', '$email', '$province', '$city', '$barangay', '$street')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            // Success message
            $_SESSION['message'] = "Crew Member added successfully.";
            header('Location: crew_members.php');
        } else {
            // Error message
            $_SESSION['message_danger'] = "Error occurred while adding the crew member.";
            header('Location: crew_members.php');
        }
    }


// firstName   middleName  lastName    position    birthday    gender  phone   email   province    city    barangay    street




?>




    


