<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MENRO LIAN - GARBAGEGO</title>

    <!-- Favicon -->
    <link href="images/icon.jpg" rel="icon">
    <link href="images/icon.jpg" rel="apple-touch-icon">
    <link rel="icon" type="image/x-icon" href="images/favicon.jpg">
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.jpg"/>

    <!-- Custom fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles -->
    <link href="css/style2.css" rel="stylesheet">
    <link href="css/style1.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        .step-form .step:not(:first-of-type) {
            display: none;
        }
    </style>
</head>

<body id="page-top" class="step-form">
    <style type="text/css">
        body {
            background-image: url('images/1.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            min-height: 100vh;
            width: 100%;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.5) 50%, rgba(0, 0, 0, 0.5)), url(images/1.jpg);
            background-position: top;
            background-size: cover;
            position: relative;
        }

        .role-option {
            position: relative;
            display: inline-block;
            cursor: pointer;
            margin: 10px;
        }

        .role-option img:hover {
            border: 2px solid #026601;
        }

        .role-option input[type="radio"]:checked+img+.role-text {
            color: #026601;
            font-weight: bold;
        }

        .role-text {
            display: block;
            margin-top: 5px;
            font-size: 13px;
            color: #000000;
        }

        .role-option input[type="radio"]:checked+img {
            border: 0.5px solid #026601;
            animation: glowing 1s infinite;
        }

        @keyframes glowing {
            0% { box-shadow: 0 0 5px #026601; }
            50% { box-shadow: 0 0 10px #026601; }
            100% { box-shadow: 0 0 5px #026601; }
        }

        .step-map {
        background-color: #f8f9fc;
        padding: 15px;
        }

        .step-map .step-number {
            display: block;
            font-size: 20px;
            color: #999999;
        }

        .step-map .step-description {
            display: block;
            font-size: 12px;
            color: #555555;
        }

        .step-map .step-number.active + .step-description,
        .step-map .step-description.active {
            color: #026601;
            font-weight: bold;
        }

        .step-map .step-number:not(:last-of-type) {
            margin-bottom: 5px;
        }

        .step-map .step-number.active {
            color: #026601;
            font-weight: bold;
        }

        .step-map .step-number.active + .step-description,
        .step-map .step-description.active {
            color: #026601;
        }
        @media (max-width: 576px) {
            .step-map .step-number,
            .step-map .step-description {
                display: none;
            }
            
            .step-map .step-number.active + .step-description,
            .step-map .step-description.active {
                display: block;
            }
        }

        @media (max-width: 576px) {
          .form-group.text-center {
            display: flex;
            justify-content: center;
            align-items: center;
          }

          .role-option {
            margin: 0 7px;
          }
        }
    </style>

    <body id="page-top" class="step-form">

 <?php
// Check for error and success messages in the URL
if (isset($_GET['error'])) {
    $errorMessage = $_GET['error'];
    echo '<script>
            window.onload = function() {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "' . $errorMessage . '",
                    confirmButtonColor: "#d33",
                    confirmButtonText: "OK"
                });
            };
        </script>';
} else if (isset($_GET['success'])) {
    $successMessage = $_GET['success'];
    echo '<script>
            window.onload = function() {
                Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: "' . $successMessage . '",
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "OK"
                });
            };
        </script>';
}
?>
 <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-10 col-md-8 col-sm-12">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <!-- Close button -->
                                <a href="login.php" type="button" class="btn btn-lg btn-outline-default mt-2 mr-2" style="float: right;">
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                </a>
                                <div class="p-5">
                                    <div class="">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-lg-3 col-md-4 col-sm-4">   
                                                
                                                    <img src="images/icon.png" class="card-img-top img-fluid mx-auto d-block image-animated rounded" alt="..." style="width: auto; height: 70px;">
                                                </div>
                                                <div class="col-lg-9 col-md-8 col-sm-8 text-center">
                                                    
                                                     <h1 class="h4 text-gray-900 mt-2 d-none d-sm-block">MENRO Lian Employee Registration</h1>
                                                    <h1 class="h6 text-gray-900 mt-2 d-sm-none">Employee Registration</h1>
                                                    <h1 class="small text-gray-900">Please create your Account.</h1>
                                                </div>
                                            </div>
                                        </div>

                                            <div class="step-map mt-2 mb-2 mb-3">
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-sm-4 text-center">
                                                            <div class="d-flex flex-column align-items-center">
                                                                <span class="step-number">1</span>
                                                                <span class="step-description text text-gray-800 text-xs">Account Type Selection</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4 text-center">
                                                            <div class="d-flex flex-column align-items-center">
                                                                <span class="step-number">2</span>
                                                                <span class="step-description text text-gray-800 text-xs">Personal Information Input</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4 text-center">
                                                            <div class="d-flex flex-column align-items-center">
                                                                <span class="step-number">3</span>
                                                                <span class="step-description text text-gray-800 text-xs">Username & Password Setup</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <form class="user mt-2" action="signup_auth.php" method="post" id="stepForm">
                                                <!-- Step 1: Account Type -->
                                                <div class="step" id="step1">
                                                    <div class="form-group text-center">
                                                      <label class="role-option">
                                                        <input type="radio" id="staff" name="role" value="staff" style="opacity: 0; position: absolute; width: 1px; height: 1px; overflow: hidden;">
                                                        <img src="images/staff.png" class="img-fluid mx-auto d-block" alt="Staff" style="max-width: 100%; height: 100px;">
                                                        <span class="role-text">Staff</span>
                                                      </label>

                                                      <label class="role-option">
                                                        <input type="radio" id="driver" name="role" value="driver" style="opacity: 0; position: absolute; width: 1px; height: 1px; overflow: hidden;" required>
                                                        <img src="images/driver.png" class="img-fluid mx-auto d-block" alt="Driver" style="max-width: 100%; height: 100px;">
                                                        <span class="role-text">Driver</span>
                                                      </label>
                                                    </div>
                                                    <button type="button" class="btn btn-secondary btn-user btn-block next-step">Next</button>
                                                </div>

                                                <!-- Step 2: Personal Details -->
                                                <div class="step" id="step2">
                                                    <div class="form-group row">
                                                        <div class="col-sm-4">
                                                            <input type="text" name="firstName" class="form-control form-control-user mb-3" id="exampleInputFirstName" placeholder="First Name">
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <input type="text" name="middleName" class="form-control form-control-user mb-3" id="exampleInputMiddleName" placeholder="Middle Name">
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <input type="text" name="lastName" class="form-control form-control-user" id="exampleInputLastName" placeholder="Last Name">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="tel" name="phone" class="form-control form-control-user" id="exampleInputPhone" placeholder="Phone Number">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="email" name="email" class="form-control form-control-user mb-3" id="exampleInputEmail" placeholder="Email Address">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 mt-2">
                                                            <button type="button" class="btn btn-secondary btn-user btn-block prev-step">Previous</button>
                                                        </div>
                                                        <div class="col-md-6 mt-2">
                                                            <button type="button" class="btn btn-secondary btn-user btn-block next-step">Next</button>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Step 3: Create Password -->
                                                <div class="step" id="step3">
                                                    <div class="form-group">
                                                        <input type="text" id="user_name" name="user_name" class="form-control form-control-user" placeholder="Username" onkeyup="checkUsernameAvailability()">
                                                        <div id="username-message"></div>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="password" name="password" class="form-control form-control-user" id="password" placeholder="Password"
                                                        onkeyup="checkPasswordStrength()">
                                                       <div id="password-strength" class="password-strength"></div>
                                                       <div id="password-suggestions" class="password-suggestions"></div>

                                                    </div>
                                                    <div class="form-group">
                                                        <input type="password" name="confirm_password" class="form-control form-control-user" id="confirm_password" placeholder="Confirm Password" onkeyup="checkPasswordMatch()">
                                                       <div id="password-match-message" class="small"></div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 mt-2">
                                                            <button type="button" class="btn btn-secondary btn-user btn-block prev-step">Previous</button>
                                                        </div>
                                                        <div class="col-md-6 mt-2">
                                                            <button type="submit" class="btn btn-info btn-user btn-block">Sign Up</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>

                                            <hr>

                                            <div class="text-center">
                                                <span class="small text-gray-900">Already have an account?
                                                    <a class=" text-info" href="login.php">Login</a>
                                                </span><br>
                                                <a class="small text-info text-center" href="forgot_password.php">Forgot Password?</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-1.9.1.js"></script>

        <script>
            $(document).ready(function() {
                var currentStep = 1;
                var totalSteps = $('.step').length;

                $('.step:gt(0)').hide();
                updateStepNumber(currentStep);

                $('.next-step').on('click', function() {
                    var parentFieldset = $(this).parents('.step');
                    var nextFieldset = parentFieldset.next('.step');
                    parentFieldset.hide();
                    nextFieldset.show();
                    currentStep++;
                    updateStepNumber(currentStep);
                });

                $('.prev-step').on('click', function() {
                    var parentFieldset = $(this).parents('.step');
                    var previousFieldset = parentFieldset.prev('.step');
                    parentFieldset.hide();
                    previousFieldset.show();
                    currentStep--;
                    updateStepNumber(currentStep);
                });

                function updateStepNumber(currentStep) {
                    $('.step-number').removeClass('active');
                    $('.step-number').eq(currentStep - 1).addClass('active');
                }
            });
        </script>
        <!-- password strength -->
        <style>
          .password-strength {
            margin-top: 5px;
            font-size: 12px;
          }
          .weak {
            color: #dc3545; /* Bootstrap 4 danger color */
          }
          .medium {
            color: #ffc107; /* Bootstrap 4 warning color */
          }
          .strong {
            color: #28a745; /* Bootstrap 4 success color */
          }
          .password-suggestions {
            margin-top: 8px;
            font-size: 13px;
          }
        </style>
        <script>
          function checkPasswordStrength() {
            var password = document.getElementById("password").value;
            var passwordStrength = document.getElementById("password-strength");
            var passwordSuggestions = document.getElementById("password-suggestions");

            // Define the criteria for weak, medium, and strong passwords
            var weakRegex = /^.{0,5}$/; // Less than 6 characters
            var mediumRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{6,}$/; // At least 6 characters with lowercase, uppercase, and numeric characters
            var strongRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&_#^+=(){}[\]|\\:;"'<>,.~`]).{8,}$/;

            if (strongRegex.test(password)) {
              passwordStrength.textContent = "Strong password";
              passwordStrength.className = "password-strength strong";
              passwordSuggestions.innerHTML = ""; // Clear previous suggestions
            } else if (mediumRegex.test(password)) {
              passwordStrength.textContent = "Medium password";
              passwordStrength.className = "password-strength medium";
              passwordSuggestions.innerHTML = "<ul><li>Add special characters, uppercase, and lowercase letters</li></ul>";
            } else if (weakRegex.test(password)) {
              passwordStrength.textContent = "Weak password";
              passwordStrength.className = "password-strength weak";
              passwordSuggestions.innerHTML = "<ul><li>Make it longer, include numbers, uppercase and lowercase letters, and special characters</li></ul>";
            } else {
              passwordStrength.textContent = "Password is too short";
              passwordStrength.className = "password-strength";
              passwordSuggestions.innerHTML = "<ul><li>Make it at least 8 characters long, include uppercase and lowercase letters, numbers, and special characters</li></ul>";
            }
          }
        </script>
        <!-- Username Checker -->
        <script>
          function checkUsernameAvailability() {
            const username = document.getElementById('user_name').value;

            // Send an AJAX request to check_username.php
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'check_username.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
              if (xhr.readyState === 4 && xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                const messageElement = document.getElementById('username-message');
                if (response.available) {
                  // Username is available
                  messageElement.innerHTML = '<span class="small" style="color: #28a745; font-size: 12px;">Username is available</span>';
                } else {
                  // Username is already taken
                  messageElement.innerHTML = '<span class="small" style="color: #dc3545; font-size: 12px;">Username is already taken</span>';
                }
              }
            };
            xhr.send('username=' + encodeURIComponent(username));
          }
        </script>
        <!-- check if the passwords match -->
        <script>
          function checkPasswordMatch() {
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirm_password").value;
            var matchMessage = document.getElementById("password-match-message");

            if (password === confirmPassword) {
              matchMessage.innerHTML = "Passwords match";
              matchMessage.style.color = "#28a745"; // Green color for success
            } else {
              matchMessage.innerHTML = "Passwords do not match";
              matchMessage.style.color = "#dc3545"; // Red color for danger
            }
          }
        </script>
    </body>
</html>


