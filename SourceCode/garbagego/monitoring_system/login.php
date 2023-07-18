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

</head>
<body id="page-top" >
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

    </style>
    
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
            <div class="col-xl-5 col-lg-5 col-md-8 col-sm-12">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <!-- Close button -->
                                <a href="../index.php" type="button" class="btn btn-lg btn-outline-default mt-2 mr-2" style="float: right;">
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                </a>
                                <div class="p-5">
                                    <div class="">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-12 col-sm-12">   
                                                
                                                    <img src="images/icon.png" class="card-img-top img-fluid mx-auto d-block image-animated rounded" alt="..." style="width: auto; height: 70px;">
                                                </div>
                                                <div class="col-lg-8 col-md-12 col-sm-12">
                                                    
                                                    <h1 class="h4 text-gray-900 mt-2">Welcome back</h1>
                                                    <h1 class="small text-gray-900">Please login to your Account.</h1>
                                                </div>
                                            </div>
                                        </div>
                                        <form class="user" action="login_auth.php" method="post" id="login-form">
                                            <div class="form-group mt-3">
                                                <input type="text" name="uname" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Username">
                                            </div>

                                            <div class="form-group">
                                                <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                                            </div>
                                            <div class="form-group">
                                                <!-- Remember Me checkbox -->
                                                <div class="form-group">
                                                    <!-- Remember Me checkbox -->
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="remember_me" id="rememberMe">
                                                        <label class="form-check-label" for="rememberMe">
                                                            Remember Me
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <button type="submit" class="btn btn-info btn-user btn-block mt-2">Login</button>
                                        </form>
                                        <hr>
                                        <div class="text-center">
                                            <span class="small text-gray-900">Don't have an Account? 
                                        <a class=" text-info" href="signup.php">Sign Up</a></span><br>
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

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts -->
    <script src="js/sb-admin-2.min.js"></script>

    <script src="https://code.jquery.com/jquery-1.9.1.js"></script>

</body>

<!-- Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

</body>

</html>

